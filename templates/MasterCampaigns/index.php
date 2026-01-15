<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\MasterCampaign> $masterCampaigns
 */
?>
<div class="masterCampaigns index content">
    <?= $this->Html->link(__('New Master Campaign'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Master Campaigns') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('master_user_id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('cover_image') ?></th>
                    <th><?= $this->Paginator->sort('is_public') ?></th>
                    <th><?= $this->Paginator->sort('max_players') ?></th>
                    <th><?= $this->Paginator->sort('start_date') ?></th>
                    <th><?= $this->Paginator->sort('invite_code') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('system_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($masterCampaigns as $masterCampaign): ?>
                <tr>
                    <td><?= $this->Number->format($masterCampaign->id) ?></td>
                    <td><?= $masterCampaign->hasValue('master_user') ? $this->Html->link($masterCampaign->master_user->username, ['controller' => 'Users', 'action' => 'view', $masterCampaign->master_user->id]) : '' ?></td>
                    <td><?= h($masterCampaign->name) ?></td>
                    <td><?= h($masterCampaign->cover_image) ?></td>
                    <td><?= h($masterCampaign->is_public) ?></td>
                    <td><?= $this->Number->format($masterCampaign->max_players) ?></td>
                    <td><?= h($masterCampaign->start_date) ?></td>
                    <td><?= h($masterCampaign->invite_code) ?></td>
                    <td><?= h($masterCampaign->status) ?></td>
                    <td><?= h($masterCampaign->created) ?></td>
                    <td><?= h($masterCampaign->modified) ?></td>
                    <td><?= $masterCampaign->hasValue('system') ? $this->Html->link($masterCampaign->system->slug, ['controller' => 'Systems', 'action' => 'view', $masterCampaign->system->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $masterCampaign->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $masterCampaign->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $masterCampaign->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $masterCampaign->id),
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