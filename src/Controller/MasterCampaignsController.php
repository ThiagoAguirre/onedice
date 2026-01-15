<?php
declare(strict_types=1);

namespace App\Controller;

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
        $systems = $this->MasterCampaigns->Systems->find('list', limit: 200)->all();
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
        $systems = $this->MasterCampaigns->Systems->find('list', limit: 200)->all();
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
