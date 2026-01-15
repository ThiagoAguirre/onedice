<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MasterCampaign $masterCampaign
 * @var string[]|\Cake\Collection\CollectionInterface $masterUsers
 * @var string[]|\Cake\Collection\CollectionInterface $systems
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $masterCampaign->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $masterCampaign->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Master Campaigns'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="masterCampaigns form content">
            <?= $this->Form->create($masterCampaign) ?>
            <fieldset>
                <legend><?= __('Edit Master Campaign') ?></legend>
                <?php
                    echo $this->Form->control('master_user_id', ['options' => $masterUsers]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('description');
                    echo $this->Form->control('cover_image');
                    echo $this->Form->control('is_public');
                    echo $this->Form->control('max_players');
                    echo $this->Form->control('start_date', ['empty' => true]);
                    echo $this->Form->control('invite_code');
                    echo $this->Form->control('status');
                    echo $this->Form->control('system_id', ['options' => $systems, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
