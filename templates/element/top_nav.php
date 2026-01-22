<?php
/**
 * Top navigation element
 * @var \App\View\AppView $this
 */
?>
<nav class="top-nav" style="position:fixed;top:0;left:0;right:0;z-index:2000;width:100%;">
    <div class="top-nav-title">
        <a href="<?= $this->Url->build('/') ?>"><span>Cake</span>PHP</a>
    </div>
    <div class="top-nav-links">
        <a target="_blank" rel="noopener" href="https://book.cakephp.org/5/">Documentation</a>
        <a target="_blank" rel="noopener" href="https://api.cakephp.org/">API</a>
    </div>
</nav>

<?= $this->Html->css('cake') ?>
