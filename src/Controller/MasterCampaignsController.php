<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\I18n;

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
        if ($this->request->is('post')) {
            $masterCampaign = $this->MasterCampaigns->patchEntity($masterCampaign, $this->request->getData());
            if ($this->MasterCampaigns->save($masterCampaign)) {
                $this->Flash->success(__('The master campaign has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The master campaign could not be saved. Please, try again.'));
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
            $masterCampaign = $this->MasterCampaigns->patchEntity($masterCampaign, $this->request->getData());
            if ($this->MasterCampaigns->save($masterCampaign)) {
                $this->Flash->success(__('The master campaign has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The master campaign could not be saved. Please, try again.'));
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
