<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\I18n;
use Cake\Utility\Text;
use Psr\Http\Message\UploadedFileInterface;

/**
 * MasterCampaigns Controller
 *
 * @property \App\Model\Table\MasterCampaignsTable $MasterCampaigns
 */
class MasterCampaignsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->MasterCampaigns->find()
            ->contain(['MasterUsers', 'Systems']);
        $masterCampaigns = $this->paginate($query);

        $this->set(compact('masterCampaigns'));
    }

    /**
     * View method
     *
     * @param string|null $id Master Campaign id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $masterCampaign = $this->MasterCampaigns->get($id, contain: ['MasterUsers', 'Systems']);
        $this->set(compact('masterCampaign'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $masterCampaign = $this->MasterCampaigns->newEmptyEntity();
        // Prefill a generated invite code so it appears on the form (non-editable)
        try {
            $masterCampaign->invite_code = $this->MasterCampaigns->generateInviteCode();
        } catch (\Exception $e) {
            // If generation fails, leave empty — table beforeSave will still attempt to set one
        }
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $uploadedFile = $data['cover_image_file'] ?? null;
            unset($data['cover_image_file'], $data['master_user_id'], $data['cover_image']);

            $masterCampaign = $this->MasterCampaigns->patchEntity($masterCampaign, $data);

            $user = $this->getUser();
            $userId = null;
            if ($user !== null) {
                $userId = $user->id ?? null;
                if ($userId === null && method_exists($user, 'getIdentifier')) {
                    $userId = $user->getIdentifier();
                }
            }

            $uploadError = null;
            $savedFilePath = null;
            if ($userId === null) {
                $uploadError = __('You must be logged in to create a campaign.');
            } elseif ($uploadedFile instanceof UploadedFileInterface && $uploadedFile->getError() !== UPLOAD_ERR_NO_FILE) {
                if ($uploadedFile->getError() !== UPLOAD_ERR_OK) {
                    $uploadError = __('The cover image upload failed.');
                } else {
                    $allowedTypes = [
                        'image/jpeg' => 'jpg',
                        'image/png' => 'png',
                        'image/webp' => 'webp',
                    ];
                    $mimeType = strtolower((string)$uploadedFile->getClientMediaType());
                    $stream = $uploadedFile->getStream();
                    $streamUri = $stream->getMetadata('uri');
                    if (class_exists(\finfo::class) && is_string($streamUri) && is_file($streamUri)) {
                        $finfo = new \finfo(FILEINFO_MIME_TYPE);
                        $detected = $finfo->file($streamUri);
                        if (is_string($detected)) {
                            $mimeType = strtolower($detected);
                        }
                    }

                    if (!isset($allowedTypes[$mimeType])) {
                        $uploadError = __('The cover image must be a JPG, PNG, or WEBP file.');
                    } else {
                        $uploadsDir = WWW_ROOT . 'uploads' . DS . 'campaigns' . DS;
                        if (!is_dir($uploadsDir) && !mkdir($uploadsDir, 0755, true) && !is_dir($uploadsDir)) {
                            $uploadError = __('Unable to create the uploads directory.');
                        } else {
                            $filename = Text::uuid() . '.' . $allowedTypes[$mimeType];
                            $relativePath = 'uploads/campaigns/' . $filename;
                            $targetPath = $uploadsDir . $filename;

                            try {
                                $uploadedFile->moveTo($targetPath);
                                $masterCampaign->cover_image = $relativePath;
                                $savedFilePath = $targetPath;
                            } catch (\RuntimeException $e) {
                                $uploadError = __('Unable to save the cover image.');
                            }
                        }
                    }
                }
            }

            if ($uploadError === null) {
                $masterCampaign->master_user_id = $userId;
            }

            if ($uploadError === null && $this->MasterCampaigns->save($masterCampaign)) {
                $this->Flash->success(__('The master campaign has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            if ($uploadError !== null) {
                if ($savedFilePath && is_file($savedFilePath)) {
                    @unlink($savedFilePath);
                }
                $this->Flash->error($uploadError);
            } else {
                if ($savedFilePath && is_file($savedFilePath)) {
                    @unlink($savedFilePath);
                }
                $this->Flash->error(__('The master campaign could not be saved. Please, try again.'));
            }
        }
        $masterUsers = $this->MasterCampaigns->MasterUsers->find('list', limit: 200)->all();
        $systemTranslations = $this->getTableLocator()->get('SystemTranslations');
        $locale = (string)I18n::getLocale();
        $prefix = strtolower(substr($locale, 0, 2));
        $map = [
            'pt' => 'pt_BR',
            'en' => 'en_US',
            'es' => 'es_ES',
        ];
        $dbLocale = $map[$prefix] ?? $locale;
        $systems = $systemTranslations->find(
            'list',
            keyField: 'system_id',
            valueField: 'name',
        )
            ->where(['locale' => $dbLocale])
            ->order(['name' => 'ASC'])
            ->limit(200)
            ->toArray();
        $this->set(compact('masterCampaign', 'masterUsers', 'systems'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Master Campaign id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $masterCampaign = $this->MasterCampaigns->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $uploadedFile = $data['cover_image_file'] ?? null;
            unset($data['cover_image_file']);

            $oldCover = $masterCampaign->cover_image;

            $masterCampaign = $this->MasterCampaigns->patchEntity($masterCampaign, $data);

            $uploadError = null;
            $savedFilePath = null;
            $shouldDeleteOld = false;

            if ($uploadedFile instanceof UploadedFileInterface && $uploadedFile->getError() !== UPLOAD_ERR_NO_FILE) {
                if ($uploadedFile->getError() !== UPLOAD_ERR_OK) {
                    $uploadError = __('The cover image upload failed.');
                } else {
                    $allowedTypes = [
                        'image/jpeg' => 'jpg',
                        'image/png' => 'png',
                        'image/webp' => 'webp',
                    ];
                    $mimeType = strtolower((string)$uploadedFile->getClientMediaType());
                    $stream = $uploadedFile->getStream();
                    $streamUri = $stream->getMetadata('uri');
                    if (class_exists(\finfo::class) && is_string($streamUri) && is_file($streamUri)) {
                        $finfo = new \finfo(FILEINFO_MIME_TYPE);
                        $detected = $finfo->file($streamUri);
                        if (is_string($detected)) {
                            $mimeType = strtolower($detected);
                        }
                    }

                    if (!isset($allowedTypes[$mimeType])) {
                        $uploadError = __('The cover image must be a JPG, PNG, or WEBP file.');
                    } else {
                        $uploadsDir = WWW_ROOT . 'uploads' . DS . 'campaigns' . DS;
                        if (!is_dir($uploadsDir) && !mkdir($uploadsDir, 0755, true) && !is_dir($uploadsDir)) {
                            $uploadError = __('Unable to create the uploads directory.');
                        } else {
                            $filename = Text::uuid() . '.' . $allowedTypes[$mimeType];
                            $relativePath = 'uploads/campaigns/' . $filename;
                            $targetPath = $uploadsDir . $filename;

                            try {
                                $uploadedFile->moveTo($targetPath);
                                $masterCampaign->cover_image = $relativePath;
                                $savedFilePath = $targetPath;
                                $shouldDeleteOld = !empty($oldCover);
                            } catch (\RuntimeException $e) {
                                $uploadError = __('Unable to save the cover image.');
                            }
                        }
                    }
                }
            }

            if ($uploadError === null && $this->MasterCampaigns->save($masterCampaign)) {
                if ($shouldDeleteOld && $oldCover) {
                    $oldPath = WWW_ROOT . str_replace('/', DS, $oldCover);
                    if (is_file($oldPath)) {
                        @unlink($oldPath);
                    }
                }

                $this->Flash->success(__('The master campaign has been saved.'));

                return $this->redirect(['action' => 'index']);
            }

            if ($uploadError !== null) {
                if ($savedFilePath && is_file($savedFilePath)) {
                    @unlink($savedFilePath);
                }
                $this->Flash->error($uploadError);
            } else {
                if ($savedFilePath && is_file($savedFilePath)) {
                    @unlink($savedFilePath);
                }
                $this->Flash->error(__('The master campaign could not be saved. Please, try again.'));
            }
        }
        $masterUsers = $this->MasterCampaigns->MasterUsers->find('list', limit: 200)->all();
        $systemTranslations = $this->getTableLocator()->get('SystemTranslations');
        $locale = (string)I18n::getLocale();
        $prefix = strtolower(substr($locale, 0, 2));
        $map = [
            'pt' => 'pt_BR',
            'en' => 'en_US',
            'es' => 'es_ES',
        ];
        $dbLocale = $map[$prefix] ?? $locale;
        $systems = $systemTranslations->find('list', [
            'keyField' => 'system_id',
            'valueField' => 'name',
        ])
            ->where(['locale' => $dbLocale])
            ->order(['name' => 'ASC'])
            ->limit(200)
            ->toArray();
        $this->set(compact('masterCampaign', 'masterUsers', 'systems'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Master Campaign id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $masterCampaign = $this->MasterCampaigns->get($id);
        if ($this->MasterCampaigns->delete($masterCampaign)) {
            $this->Flash->success(__('The master campaign has been deleted.'));
        } else {
            $this->Flash->error(__('The master campaign could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
