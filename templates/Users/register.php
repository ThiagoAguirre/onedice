<?php
/** @var \App\View\AppView $this */
/** @var \App\Model\Entity\User $user */
?>
<div class="users form">
    <h1>Register</h1>
    <?= $this->Flash->render() ?>
    <?= $this->Form->create($user) ?>
    <?= $this->Form->control('username', ['label' => 'Username']) ?>
    <?= $this->Form->control('email', ['label' => 'Email']) ?>
    <?= $this->Form->control('password', ['label' => 'Password']) ?>
    <?= $this->Form->control('password_confirm', ['type' => 'password', 'label' => 'Confirm Password']) ?>
    <?= $this->Form->button(__('Register')) ?>
    <?= $this->Form->end() ?>
    <p>
        <?= $this->Html->link(__('Back to login'), ['action' => 'login']) ?>
    </p>
</div>

<?php
// Load webroot/js/register.js via script block fetched in layout
echo $this->Html->script('register', ['block' => true]);
?>