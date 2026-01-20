<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MasterCampaign $masterCampaign
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Master Campaign'), ['action' => 'edit', $masterCampaign->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Master Campaign'), ['action' => 'delete', $masterCampaign->id], ['confirm' => __('Are you sure you want to delete # {0}?', $masterCampaign->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Master Campaigns'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Master Campaign'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="masterCampaigns view content">
            <h3><?= h($masterCampaign->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Master User') ?></th>
                    <td><?= $masterCampaign->hasValue('master_user') ? $this->Html->link($masterCampaign->master_user->username, ['controller' => 'Users', 'action' => 'view', $masterCampaign->master_user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($masterCampaign->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cover Image') ?></th>
                    <td>
                        <?php if (!empty($masterCampaign->cover_image)) : ?>
                            <?= $this->Html->image($masterCampaign->cover_image, [
                                'alt' => $masterCampaign->name,
                                'style' => 'max-width: 300px; height: auto;',
                            ]) ?>
                            <div><?= h($masterCampaign->cover_image) ?></div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Invite Code') ?></th>
                    <td><?= h($masterCampaign->invite_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($masterCampaign->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('System') ?></th>
                    <td><?= $masterCampaign->hasValue('system') ? $this->Html->link($masterCampaign->system->slug, ['controller' => 'Systems', 'action' => 'view', $masterCampaign->system->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($masterCampaign->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Max Players') ?></th>
                    <td><?= $this->Number->format($masterCampaign->max_players) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Date') ?></th>
                    <td><?= h($masterCampaign->start_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($masterCampaign->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($masterCampaign->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Public') ?></th>
                    <td><?= $masterCampaign->is_public ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($masterCampaign->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
