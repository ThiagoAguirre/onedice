<?php
/**
 * @var \App\View\AppView $this
 * @var string|null $image
 * @var string|null $title
 * @var string|null $subtitle
 * @var string|null $tag
 * @var array<int, string>|null $items
 * @var string|null $alt
 */

$image = $image ?? 'login.png';
$title = $title ?? __('Your quest continues');
$subtitle = $subtitle ?? __('Keep your party, rolls, and notes in sync.');
$tag = $tag ?? __('Quest log');
$items = $items ?? [
    __('Track party progress in one place'),
    __('Save character sheets and artifacts'),
    __('Stay ready for the next roll'),
];
$alt = $alt ?? __('Adventure illustration');

$imagePath = trim((string)$image, '/');
if (str_starts_with($imagePath, 'img/')) {
    $imagePath = substr($imagePath, 4);
}
$diskPath = WWW_ROOT . 'img' . DS . str_replace(['/', '\\'], DS, $imagePath);
$hasImage = is_file($diskPath);
?>
<section class="auth-side" data-animate="panel" style="--delay: 0.15s">
    <div class="auth-side__media">
        <?php if ($hasImage): ?>
            <?= $this->Html->image($imagePath, ['class' => 'auth-side__image', 'alt' => $alt]) ?>
        <?php else: ?>
            <div class="auth-side__fallback" aria-hidden="true"></div>
        <?php endif; ?>
        <div class="auth-side__overlay" aria-hidden="true"></div>
    </div>
    <div class="auth-side__content">
        <span class="auth-side__tag"><?= h($tag) ?></span>
        <h2><?= h($title) ?></h2>
        <p><?= h($subtitle) ?></p>
        <ul class="auth-side__list">
            <?php foreach ($items as $item): ?>
                <li><?= h($item) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
