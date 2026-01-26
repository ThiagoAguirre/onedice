<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\MasterCampaign> $masterCampaigns
 * @var iterable<\App\Model\Entity\CampaignPlayer> $playerCampaigns
 */

$this->assign('title', 'Minhas Campanhas');

echo $this->Html->script('https://unpkg.com/lucide@latest', ['block' => true]);
echo $this->Html->scriptBlock('document.addEventListener("DOMContentLoaded", function(){ if (window.lucide) { lucide.createIcons(); } });', ['block' => true]);
echo $this->Html->css('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap', ['block' => true]);
echo $this->Html->css('teste', ['block' => true]);

$normalizeList = static function ($value): array {
    if (is_iterable($value)) {
        return is_array($value) ? array_values($value) : array_values(iterator_to_array($value));
    }

    return [];
};

$masterList = $normalizeList($masterCampaigns ?? []);
$playerEntries = $normalizeList($playerCampaigns ?? []);

$normalizeStatus = static function ($value): string {
    $status = strtolower((string)$value);
    $map = [
        'ativo' => 'live',
        'ativa' => 'live',
        'active' => 'live',
        'rascunho' => 'draft',
        'pausada' => 'paused',
        'pausado' => 'paused',
        'encerrada' => 'ended',
        'encerrado' => 'ended',
    ];

    return $map[$status] ?? $status;
};

$statusMeta = [
    'live' => ['label' => 'Ativa', 'color' => '#1B9D63', 'bg' => '#E6F5EC'],
    'draft' => ['label' => 'Rascunho', 'color' => '#8C6B2A', 'bg' => '#FFF3DF'],
    'paused' => ['label' => 'Pausada', 'color' => '#8C5416', 'bg' => '#FFEFE2'],
    'ended' => ['label' => 'Encerrada', 'color' => '#5F6470', 'bg' => '#EEF0F4'],
];

$playerStatusMeta = [
    'pending' => ['label' => 'Pendente', 'color' => '#8C5416', 'bg' => '#FFF3DF'],
    'approved' => ['label' => 'Aprovado', 'color' => '#1B9D63', 'bg' => '#E6F5EC'],
    'accepted' => ['label' => 'Aprovado', 'color' => '#1B9D63', 'bg' => '#E6F5EC'],
    'active' => ['label' => 'Ativo', 'color' => '#1B9D63', 'bg' => '#E6F5EC'],
    'rejected' => ['label' => 'Recusado', 'color' => '#5F6470', 'bg' => '#EEF0F4'],
    'declined' => ['label' => 'Recusado', 'color' => '#5F6470', 'bg' => '#EEF0F4'],
];

$currentPlayers = static function ($campaign): int {
    $candidates = [
        'current_players',
        'players_count',
        'player_count',
        'players',
    ];

    foreach ($candidates as $prop) {
        $value = $campaign->{$prop} ?? null;
        if ($value === null) {
            continue;
        }
        if (is_numeric($value)) {
            return (int)$value;
        }
        if (is_iterable($value)) {
            return count(is_array($value) ? $value : iterator_to_array($value));
        }
    }

    return 0;
};

$pluralize = static function (int $count, string $singular, string $plural): string {
    return $count === 1 ? $singular : $plural;
};

$masterCount = count($masterList);
$playerCount = count($playerEntries);
?>

<div class="master-shell">
    <div class="master-header">
        <div>
            <div class="header-eyebrow">
                <i data-lucide="layers" class="w-4 h-4"></i>
                <span>Minha lista</span>
            </div>
            <div class="header-title">Minhas Campanhas</div>
        </div>
        <div>
            <?= $this->Html->link('<i data-lucide="plus" class="w-4 h-4"></i><span>Nova Campanha</span>', ['action' => 'add'], ['escape' => false, 'class' => 'primary-btn']) ?>
        </div>
    </div>

    <section class="section-block">
        <div class="section-head">
            <div class="section-title">
                <span class="section-icon section-icon--master">
                    <i data-lucide="crown" class="w-5 h-5"></i>
                </span>
                <div>
                    <h2>Campanhas como Mestre</h2>
                    <p><?= $masterCount ?> <?= $pluralize($masterCount, 'campanha', 'campanhas') ?></p>
                </div>
            </div>
        </div>

        <div class="campaign-grid">
            <?php if ($masterCount > 0): ?>
                <?php foreach ($masterList as $campaign):
                    $cover = null;
                    if (!empty($campaign->cover_image)) {
                        $cover = $this->Url->build('/' . ltrim((string)$campaign->cover_image, '/'));
                    }
                    $initial = strtoupper(mb_substr((string)($campaign->name ?? 'C'), 0, 1));
                    $systemName = $campaign->hasValue('system') ? ($campaign->system->name ?? $campaign->system->slug ?? null) : null;
                    $normalized = $normalizeStatus($campaign->status ?? '');
                    $statusConf = $statusMeta[$normalized] ?? ['label' => ucfirst($campaign->status ?? 'Status'), 'color' => '#5F6470', 'bg' => '#EEF0F4'];
                    $startLabel = '';
                    if (!empty($campaign->start_date)) {
                        if (method_exists($campaign->start_date, 'timeAgoInWords')) {
                            $startLabel = $campaign->start_date->timeAgoInWords(['accuracy' => ['day' => 'day', 'month' => 'month', 'year' => 'year']]);
                        } elseif (method_exists($campaign->start_date, 'format')) {
                            $startLabel = $campaign->start_date->format('d/m/Y');
                        }
                    }
                    $playerTotal = (int)($campaign->max_players ?? 0);
                    $playerDisplay = $playerTotal > 0
                        ? sprintf('%d/%d', $currentPlayers($campaign), $playerTotal)
                        : (string)$currentPlayers($campaign);
                    ?>
                    <div class="campaign-card">
                        <div class="cover <?= $cover ? '' : 'cover-placeholder' ?>" <?= $cover ? '' : 'style="background: linear-gradient(135deg, #F7D8D8, #B11226);"' ?>>
                            <?php if ($cover): ?>
                                <img src="<?= h($cover) ?>" alt="<?= h($campaign->name) ?>">
                            <?php else: ?>
                                <span class="cover-initial"><?= h($initial) ?></span>
                            <?php endif; ?>

                            <span class="chip role role-master">Mestre</span>
                            <?php if ($systemName): ?>
                                <span class="chip system"><?= h(mb_strtoupper($systemName)) ?></span>
                            <?php endif; ?>
                            <?php if (!empty($campaign->status)): ?>
                                <span class="chip status" style="color: <?= h($statusConf['color']) ?>; background: <?= h($statusConf['bg']) ?>;">
                                    <?= h(mb_strtoupper($statusConf['label'])) ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="card-body">
                            <div class="card-head">
                                <h3><?= h($campaign->name) ?></h3>
                                <p><?= h(mb_strimwidth(trim((string)($campaign->description ?? '')), 0, 140, '...')) ?: 'Sem descricao no momento.' ?></p>
                            </div>

                            <div class="meta-row">
                                <div class="meta-group">
                                    <span class="meta-item">
                                        <i data-lucide="users" class="w-4 h-4"></i>
                                        <?= h($playerDisplay) ?>
                                    </span>
                                    <span class="meta-item">
                                        <i data-lucide="clock-3" class="w-4 h-4"></i>
                                        <?= $startLabel !== '' ? h($startLabel) : 'Sem data' ?>
                                    </span>
                                </div>
                            </div>

                            <div class="actions-row">
                            <?= $this->Html->link('<span>Gerenciar</span><i data-lucide="chevron-right" class="w-4 h-4"></i>', ['action' => 'manage', $campaign->id], ['escape' => false, 'class' => 'primary-btn primary-btn--full']) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">Nenhuma campanha como mestre.</div>
            <?php endif; ?>
        </div>
    </section>

    <div class="section-divider"></div>

    <section class="section-block">
        <div class="section-head">
            <div class="section-title">
                <span class="section-icon section-icon--player">
                    <i data-lucide="user" class="w-5 h-5"></i>
                </span>
                <div>
                    <h2>Campanhas como Player</h2>
                    <p><?= $playerCount ?> <?= $pluralize($playerCount, 'campanha', 'campanhas') ?></p>
                </div>
            </div>
        </div>

        <div class="campaign-grid">
            <?php $shownPlayers = 0; ?>
            <?php foreach ($playerEntries as $entry):
                $campaign = $entry->campaign ?? null;
                if ($campaign === null) {
                    continue;
                }
                $shownPlayers++;
                $cover = null;
                if (!empty($campaign->cover_image)) {
                    $cover = $this->Url->build('/' . ltrim((string)$campaign->cover_image, '/'));
                }
                $initial = strtoupper(mb_substr((string)($campaign->name ?? 'C'), 0, 1));
                $systemName = $campaign->hasValue('system') ? ($campaign->system->name ?? $campaign->system->slug ?? null) : null;
                $normalized = $normalizeStatus($campaign->status ?? '');
                $statusConf = $statusMeta[$normalized] ?? ['label' => ucfirst($campaign->status ?? 'Status'), 'color' => '#5F6470', 'bg' => '#EEF0F4'];
                $startLabel = '';
                if (!empty($campaign->start_date)) {
                    if (method_exists($campaign->start_date, 'timeAgoInWords')) {
                        $startLabel = $campaign->start_date->timeAgoInWords(['accuracy' => ['day' => 'day', 'month' => 'month', 'year' => 'year']]);
                    } elseif (method_exists($campaign->start_date, 'format')) {
                        $startLabel = $campaign->start_date->format('d/m/Y');
                    }
                }
                $playerTotal = (int)($campaign->max_players ?? 0);
                $playerDisplay = $playerTotal > 0
                    ? sprintf('%d/%d', $currentPlayers($campaign), $playerTotal)
                    : (string)$currentPlayers($campaign);
                $masterName = null;
                if ($campaign->hasValue('master_user')) {
                    $masterName = $campaign->master_user->name ?? $campaign->master_user->username ?? null;
                }
                $playerStatus = strtolower((string)($entry->status ?? ''));
                $playerStatusLabel = '';
                $playerStatusColor = '#5F6470';
                $playerStatusBg = '#EEF0F4';
                if ($playerStatus !== '') {
                    $statusInfo = $playerStatusMeta[$playerStatus] ?? null;
                    if ($statusInfo) {
                        $playerStatusLabel = $statusInfo['label'];
                        $playerStatusColor = $statusInfo['color'];
                        $playerStatusBg = $statusInfo['bg'];
                    } else {
                        $playerStatusLabel = ucfirst($playerStatus);
                    }
                }
                ?>
                <div class="campaign-card">
                    <div class="cover <?= $cover ? '' : 'cover-placeholder' ?>" <?= $cover ? '' : 'style="background: linear-gradient(135deg, #E5E9FF, #1D4ED8);"' ?>>
                        <?php if ($cover): ?>
                            <img src="<?= h($cover) ?>" alt="<?= h($campaign->name) ?>">
                        <?php else: ?>
                            <span class="cover-initial"><?= h($initial) ?></span>
                        <?php endif; ?>

                        <span class="chip role role-player">Player</span>
                        <?php if ($systemName): ?>
                            <span class="chip system"><?= h(mb_strtoupper($systemName)) ?></span>
                        <?php endif; ?>
                        <?php if (!empty($campaign->status)): ?>
                            <span class="chip status" style="color: <?= h($statusConf['color']) ?>; background: <?= h($statusConf['bg']) ?>;">
                                <?= h(mb_strtoupper($statusConf['label'])) ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="card-body">
                        <div class="card-head">
                            <h3><?= h($campaign->name) ?></h3>
                            <?php if ($masterName): ?>
                                <div class="card-subtitle">
                                    <i data-lucide="crown" class="w-4 h-4"></i>
                                    Mestre: <?= h($masterName) ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($playerStatusLabel !== ''): ?>
                                <div class="card-subtitle card-subtitle--status">
                                    <span class="status-pill" style="color: <?= h($playerStatusColor) ?>; background: <?= h($playerStatusBg) ?>;">
                                        Convite: <?= h(strtoupper($playerStatusLabel)) ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            <p><?= h(mb_strimwidth(trim((string)($campaign->description ?? '')), 0, 140, '...')) ?: 'Sem descricao no momento.' ?></p>
                        </div>

                        <div class="meta-row">
                            <div class="meta-group">
                                <span class="meta-item">
                                    <i data-lucide="users" class="w-4 h-4"></i>
                                    <?= h($playerDisplay) ?>
                                </span>
                                <span class="meta-item">
                                    <i data-lucide="clock-3" class="w-4 h-4"></i>
                                    <?= $startLabel !== '' ? h($startLabel) : 'Sem data' ?>
                                </span>
                            </div>
                        </div>

                        <div class="actions-row">
                            <?= $this->Html->link('<span>Entrar</span><i data-lucide="chevron-right" class="w-4 h-4"></i>', ['action' => 'playerManage', $campaign->id], ['escape' => false, 'class' => 'primary-btn primary-btn--full']) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if ($shownPlayers === 0): ?>
                <div class="empty-state">Nenhuma campanha como player.</div>
            <?php endif; ?>
        </div>
    </section>
</div>
