<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CampaignPlayer $campaignPlayer
 * @var string[]|\Cake\Collection\CollectionInterface $campaigns
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $campaignPlayer->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $campaignPlayer->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Campaign Players'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="campaignPlayers form content">
            <?= $this->Form->create($campaignPlayer) ?>
            <fieldset>
                <legend><?= __('Edit Campaign Player') ?></legend>
                <?php
                    echo $this->Form->control('campaign_id', ['options' => $campaigns]);
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('status');
                    echo $this->Form->control('invited_at');
                    echo $this->Form->control('responded_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
