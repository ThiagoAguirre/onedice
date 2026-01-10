<?php
/**
 * @var \App\View\AppView $this
 */
$locale = \Cake\I18n\I18n::getLocale();
$title = $this->fetch('title');
?>
<!DOCTYPE html>
<html lang="<?= h(str_replace('_', '-', (string)$locale)) ?>">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= h($title ?: 'DiceRPG') ?></title>
    <?= $this->Html->meta('icon') ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <?= $this->Html->css('auth') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="auth-body">
    <div class="auth-shell">
        <div class="auth-orb auth-orb--one" aria-hidden="true"></div>
        <div class="auth-orb auth-orb--two" aria-hidden="true"></div>
        <div class="auth-orb auth-orb--three" aria-hidden="true"></div>

        <?= $this->element('lang_switcher') ?>

        <main class="auth-main">
            <?= $this->fetch('content') ?>
        </main>
    </div>
    <?= $this->Html->script('auth', ['defer' => true]) ?>
</body>
</html>
