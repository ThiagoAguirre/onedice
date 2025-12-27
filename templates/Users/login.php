<?php
/** @var \App\View\AppView $this */
?>
<div class="users form">
    <h1>Login</h1>
    <?= $this->Flash->render() ?>
    <?= $this->Form->create(null) ?>
    <?= $this->Form->control('email', ['label' => 'Email']) ?>
    <?= $this->Form->control('password', ['label' => 'Password']) ?>
    <?= $this->Form->button(__('Login')) ?>
    <?= $this->Form->end() ?>
    <p>
        <?= $this->Html->link(__('Create an account'), ['action' => 'register']) ?>
    </p>
</div>
