<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CampaignPlayer $campaignPlayer
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Campaign Player'), ['action' => 'edit', $campaignPlayer->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Campaign Player'), ['action' => 'delete', $campaignPlayer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $campaignPlayer->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Campaign Players'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Campaign Player'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="campaignPlayers view content">
            <h3><?= h($campaignPlayer->status) ?></h3>
            <table>
                <tr>
                    <th><?= __('Campaign') ?></th>
                    <td><?= $campaignPlayer->hasValue('campaign') ? $this->Html->link($campaignPlayer->campaign->name, ['controller' => 'MasterCampaigns', 'action' => 'view', $campaignPlayer->campaign->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $campaignPlayer->hasValue('user') ? $this->Html->link($campaignPlayer->user->username, ['controller' => 'Users', 'action' => 'view', $campaignPlayer->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($campaignPlayer->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($campaignPlayer->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Invited At') ?></th>
                    <td><?= h($campaignPlayer->invited_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Responded At') ?></th>
                    <td><?= h($campaignPlayer->responded_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($campaignPlayer->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($campaignPlayer->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>