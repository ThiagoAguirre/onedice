<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\CampaignPlayer> $campaignPlayers
 */
?>
<div class="campaignPlayers index content">
    <?= $this->Html->link(__('New Campaign Player'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Campaign Players') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('campaign_id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('invited_at') ?></th>
                    <th><?= $this->Paginator->sort('responded_at') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($campaignPlayers as $campaignPlayer): ?>
                <tr>
                    <td><?= $this->Number->format($campaignPlayer->id) ?></td>
                    <td><?= $campaignPlayer->hasValue('campaign') ? $this->Html->link($campaignPlayer->campaign->name, ['controller' => 'MasterCampaigns', 'action' => 'view', $campaignPlayer->campaign->id]) : '' ?></td>
                    <td><?= $campaignPlayer->hasValue('user') ? $this->Html->link($campaignPlayer->user->username, ['controller' => 'Users', 'action' => 'view', $campaignPlayer->user->id]) : '' ?></td>
                    <td><?= h($campaignPlayer->status) ?></td>
                    <td><?= h($campaignPlayer->invited_at) ?></td>
                    <td><?= h($campaignPlayer->responded_at) ?></td>
                    <td><?= h($campaignPlayer->created) ?></td>
                    <td><?= h($campaignPlayer->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $campaignPlayer->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $campaignPlayer->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $campaignPlayer->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $campaignPlayer->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>