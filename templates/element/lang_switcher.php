<?php
/**
 * @var \App\View\AppView $this
 * @var string|null $currentLang
 */

use Cake\I18n\I18n;

$locale = $currentLang ?? I18n::getLocale();
$normalized = strtolower(str_replace('_', '-', (string)$locale));
$options = [
    ['lang' => 'pt-BR', 'label' => __('PT'), 'name' => __('Portuguese'), 'flag' => 'flag--br'],
    ['lang' => 'en', 'label' => __('EN'), 'name' => __('English'), 'flag' => 'flag--us'],
    ['lang' => 'es', 'label' => __('ES'), 'name' => __('Espanol'), 'flag' => 'flag--es'],
];
$active = $options[0];
foreach ($options as $option) {
    if (str_starts_with($normalized, strtolower($option['lang']))) {
        $active = $option;
        break;
    }
}
$panelId = 'lang-panel';
?>
<div class="lang-switcher" data-lang-switcher data-lang-current="<?= h($active['lang']) ?>">
    <button
        class="lang-switcher__toggle"
        type="button"
        data-lang-toggle
        aria-haspopup="true"
        aria-expanded="false"
        aria-controls="<?= h($panelId) ?>"
    >
        <span class="lang-switcher__flag flag <?= h($active['flag']) ?>" data-active-flag aria-hidden="true"></span>
        <span class="lang-switcher__label" data-active-label><?= h($active['label']) ?></span>
        <span class="lang-switcher__chevron" aria-hidden="true"></span>
    </button>

    <div class="lang-switcher__panel" id="<?= h($panelId) ?>" data-lang-panel role="menu" aria-hidden="true">
        <?php foreach ($options as $option): ?>
            <button
                type="button"
                class="lang-switcher__option<?= $option['lang'] === $active['lang'] ? ' is-active' : '' ?>"
                data-lang-option
                data-lang="<?= h($option['lang']) ?>"
                data-label="<?= h($option['label']) ?>"
                data-flag="<?= h($option['flag']) ?>"
                role="menuitem"
            >
                <span class="lang-switcher__flag flag <?= h($option['flag']) ?>" aria-hidden="true"></span>
                <span class="lang-switcher__name"><?= h($option['name']) ?></span>
                <span class="lang-switcher__short"><?= h($option['label']) ?></span>
            </button>
        <?php endforeach; ?>
    </div>
</div>
