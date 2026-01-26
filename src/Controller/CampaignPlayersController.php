<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CampaignPlayers Controller
 *
 * @property \App\Model\Table\CampaignPlayersTable $CampaignPlayers
 */
class CampaignPlayersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->CampaignPlayers->find()
            ->contain(['Campaigns', 'Users']);
        $campaignPlayers = $this->paginate($query);

        $this->set(compact('campaignPlayers'));
    }

    /**
     * View method
     *
     * @param string|null $id Campaign Player id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $campaignPlayer = $this->CampaignPlayers->get($id, contain: ['Campaigns', 'Users']);
        $this->set(compact('campaignPlayer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $campaignPlayer = $this->CampaignPlayers->newEmptyEntity();
        if ($this->request->is('post')) {
            $campaignPlayer = $this->CampaignPlayers->patchEntity($campaignPlayer, $this->request->getData());
            if ($this->CampaignPlayers->save($campaignPlayer)) {
                $this->Flash->success(__('The campaign player has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The campaign player could not be saved. Please, try again.'));
        }
        $campaigns = $this->CampaignPlayers->Campaigns->find('list', limit: 200)->all();
        $users = $this->CampaignPlayers->Users->find('list', limit: 200)->all();
        $this->set(compact('campaignPlayer', 'campaigns', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Campaign Player id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $campaignPlayer = $this->CampaignPlayers->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $campaignPlayer = $this->CampaignPlayers->patchEntity($campaignPlayer, $this->request->getData());
            if ($this->CampaignPlayers->save($campaignPlayer)) {
                $this->Flash->success(__('The campaign player has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The campaign player could not be saved. Please, try again.'));
        }
        $campaigns = $this->CampaignPlayers->Campaigns->find('list', limit: 200)->all();
        $users = $this->CampaignPlayers->Users->find('list', limit: 200)->all();
        $this->set(compact('campaignPlayer', 'campaigns', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Campaign Player id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $campaignPlayer = $this->CampaignPlayers->get($id);
        if ($this->CampaignPlayers->delete($campaignPlayer)) {
            $this->Flash->success(__('The campaign player has been deleted.'));
        } else {
            $this->Flash->error(__('The campaign player could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Invite method
     *
     * Handles a POST request with `invite_code` to request participation
     * in a campaign. Creates a `campaign_players` record with status 'pending'.
     */
    public function invite()
    {
        $this->request->allowMethod(['post']);

        $code = trim((string)($this->request->getData('invite_code') ?? $this->request->getData('invite') ?? ''));
        if ($code === '') {
            $this->Flash->error(__('Código de convite inválido.'));
            return $this->redirect($this->referer());
        }

        $user = $this->getUser();
        if (!$user) {
            $this->Flash->error(__('Você precisa estar logado para entrar em uma campanha.'));
            return $this->redirect($this->referer());
        }

        $campaignsTable = $this->getTableLocator()->get('MasterCampaigns');
        $campaign = $campaignsTable->find()
            ->select(['id', 'master_user_id'])
            ->where(['invite_code' => $code])
            ->first();

        if (!$campaign) {
            $this->Flash->error(__('Código de convite inválido ou campanha não encontrada.'));
            return $this->redirect($this->referer());
        }

        if ((int)$campaign->master_user_id === (int)$user->id) {
            $this->Flash->error(__('Você não pode entrar em uma campanha que você criou.'));
            return $this->redirect($this->referer());
        }

        $existing = $this->CampaignPlayers->find()
            ->where([
                'campaign_id' => $campaign->id,
                'user_id' => $user->id,
            ])
            ->first();
        if ($existing) {
            $this->Flash->error(__('Você já solicitou participação nesta campanha. Aguarde aprovação.'));
            return $this->redirect($this->referer());
        }

        $entity = $this->CampaignPlayers->newEntity([
            'campaign_id' => $campaign->id,
            'user_id' => $user->id,
            'status' => 'pending',
            'invited_at' => date('Y-m-d H:i:s'),
        ]);

        if ($this->CampaignPlayers->save($entity)) {
            $this->Flash->success(__('Solicitação enviada! Aguarde o mestre aceitar sua participação.'));
        } else {
            $this->Flash->error(__('Não foi possível enviar sua solicitação. Tente novamente.'));
        }

        return $this->redirect($this->referer());
    }
}
