<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MasterCampaign $masterCampaign
 * @var array<\App\Model\Entity\CampaignPlayer> $pendingPlayers
 * @var array<\App\Model\Entity\CampaignPlayer> $activePlayers
 */

$this->assign('title', 'Gerenciar Campanha');

echo $this->Html->script('https://unpkg.com/lucide@latest', ['block' => true]);
echo $this->Html->script('master-campaign-manage', ['block' => true]);
echo $this->Html->scriptBlock(
    'document.addEventListener("DOMContentLoaded", function(){ if (window.lucide) { lucide.createIcons(); } });',
    ['block' => true]
);
echo $this->Html->css('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap', ['block' => true]);
echo $this->Html->css('master-campaign-manage', ['block' => true]);

$normalizeList = static function ($value): array {
    if (is_iterable($value)) {
        return is_array($value) ? array_values($value) : array_values(iterator_to_array($value));
    }

    return [];
};

$activeList = $normalizeList($activePlayers ?? []);
$pendingList = $normalizeList($pendingPlayers ?? []);

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

$cover = null;
if (!empty($masterCampaign->cover_image)) {
    $cover = $this->Url->build('/' . ltrim((string)$masterCampaign->cover_image, '/'));
}
$initial = strtoupper(mb_substr((string)($masterCampaign->name ?? 'C'), 0, 1));
$normalized = $normalizeStatus($masterCampaign->status ?? '');
$statusConf = $statusMeta[$normalized] ?? ['label' => ucfirst($masterCampaign->status ?? 'Status'), 'color' => '#5F6470', 'bg' => '#EEF0F4'];
$startLabel = '';
if (!empty($masterCampaign->start_date)) {
    if (method_exists($masterCampaign->start_date, 'timeAgoInWords')) {
        $startLabel = $masterCampaign->start_date->timeAgoInWords(['accuracy' => ['day' => 'day', 'month' => 'month', 'year' => 'year']]);
    } elseif (method_exists($masterCampaign->start_date, 'format')) {
        $startLabel = $masterCampaign->start_date->format('d/m/Y');
    }
}
$playerCount = count($activeList);
$maxPlayers = (int)($masterCampaign->max_players ?? 0);
$playerDisplay = $maxPlayers > 0 ? sprintf('%d/%d', $playerCount, $maxPlayers) : (string)$playerCount;
$pendingCount = count($pendingList);
$masterName = null;
if ($masterCampaign->hasValue('master_user')) {
    $masterName = $masterCampaign->master_user->name ?? $masterCampaign->master_user->username ?? null;
}
$visibilityLabel = $masterCampaign->is_public ? 'P&uacute;blica' : 'Privada';
?>

<div class="campaign-manage">
    <div class="manage-topbar">
        <a class="back-btn" href="<?= $this->Url->build(['action' => 'myCampaigns']) ?>">
            <i data-lucide="chevron-left" class="w-4 h-4"></i>
            <span>Voltar</span>
        </a>
    </div>

    <header class="manage-header">
        <div class="cover-card <?= $cover ? '' : 'cover-placeholder' ?>" <?= $cover ? '' : 'style="background: linear-gradient(135deg, #1D4ED8, #6D28D9);"' ?>>
            <?php if ($cover): ?>
                <img src="<?= h($cover) ?>" alt="<?= h($masterCampaign->name) ?>">
            <?php else: ?>
                <span class="cover-initial"><?= h($initial) ?></span>
            <?php endif; ?>
        </div>

        <div class="campaign-info">
            <div class="info-eyebrow">
                <i data-lucide="shield" class="w-4 h-4"></i>
                <span>Gerenciar campanha</span>
            </div>
            <div class="info-title">
                <h1><?= h($masterCampaign->name) ?></h1>
                <?php if (!empty($masterCampaign->status)): ?>
                    <span class="status-pill" style="color: <?= h($statusConf['color']) ?>; background: <?= h($statusConf['bg']) ?>;">
                        <?= h(mb_strtoupper($statusConf['label'])) ?>
                    </span>
                <?php endif; ?>
            </div>
            <p class="info-description">
                <?= h(mb_strimwidth(trim((string)($masterCampaign->description ?? '')), 0, 240, '...')) ?: 'Sem descricao no momento.' ?>
            </p>
            <div class="info-meta">
                <span>
                    <i data-lucide="users" class="w-4 h-4"></i>
                    <?= h($playerDisplay) ?> jogadores
                </span>
                <span>
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    <?= $startLabel !== '' ? h($startLabel) : 'Sem data' ?>
                </span>
                <span>
                    <i data-lucide="globe-2" class="w-4 h-4"></i>
                    <?= $visibilityLabel ?>
                </span>
            </div>
        </div>

        <div class="campaign-actions">
            <?= $this->Html->link('<i data-lucide="pencil" class="w-4 h-4"></i><span>Editar</span>', ['action' => 'edit', $masterCampaign->id], ['escape' => false, 'class' => 'btn btn-primary']) ?>
            <button type="button" class="btn btn-soft" data-copy="<?= h((string)($masterCampaign->invite_code ?? '')) ?>">
                <i data-lucide="copy" class="w-4 h-4"></i>
                <span class="copy-label"><?= h((string)($masterCampaign->invite_code ?? '---')) ?></span>
            </button>
        </div>
    </header>

    <nav class="tab-bar">
        <button type="button" class="tab-btn is-active" data-tab="overview">
            <i data-lucide="layout-grid" class="w-4 h-4"></i>
            <span>Vis&atilde;o geral</span>
        </button>
        <button type="button" class="tab-btn" data-tab="requests">
            <i data-lucide="user-plus" class="w-4 h-4"></i>
            <span>Solicita&ccedil;&otilde;es</span>
            <?php if ($pendingCount > 0): ?>
                <span class="tab-badge" data-pending-count data-pending-type="tab"><?= $pendingCount ?></span>
            <?php endif; ?>
        </button>
        <button type="button" class="tab-btn" data-tab="settings">
            <i data-lucide="settings" class="w-4 h-4"></i>
            <span>Configura&ccedil;&otilde;es</span>
        </button>
    </nav>

    <section class="tab-panel is-active" data-panel="overview">
        <div class="panel-grid">
            <div class="panel-card panel-card--synopsis">
                <h2>Sinopse</h2>
                <p><?= h(trim((string)($masterCampaign->description ?? ''))) ?: 'Adicione uma sinopse para a campanha.' ?></p>
            </div>

            <div class="panel-card panel-card--players">
                <div class="panel-head">
                    <h2>Jogadores</h2>
                    <span class="panel-count"><?= h($playerDisplay) ?></span>
                </div>
                <div class="player-list">
                    <div class="player-row">
                        <div class="player-avatar player-avatar--master">
                            <?= h(mb_substr($masterName ?? 'M', 0, 1)) ?>
                        </div>
                        <div class="player-info">
                            <strong><?= h($masterName ?? 'Mestre') ?></strong>
                            <span>Game Master</span>
                        </div>
                        <span class="role-pill">Mestre</span>
                    </div>

                    <?php foreach ($activeList as $entry):
                        $playerName = $entry->user->name ?? $entry->user->username ?? 'Jogador';
                        $playerInitial = strtoupper(mb_substr((string)$playerName, 0, 1));
                        ?>
                        <div class="player-row">
                            <div class="player-avatar"><?= h($playerInitial) ?></div>
                            <div class="player-info">
                                <strong><?= h($playerName) ?></strong>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php if (count($activeList) === 0): ?>
                        <div class="empty-inline">Nenhum jogador aprovado ainda.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="tab-panel" data-panel="requests">
        <div class="panel-card">
            <div class="panel-head">
                <h2>Solicita&ccedil;&otilde;es de entrada</h2>
                <?php if ($pendingCount > 0): ?>
                    <span class="panel-badge" data-pending-count data-pending-type="panel"><?= $pendingCount ?> pendentes</span>
                <?php endif; ?>
            </div>
            <div class="request-list">
                <?php foreach ($pendingList as $entry):
                    $playerName = $entry->user->name ?? $entry->user->username ?? 'Jogador';
                    $playerInitial = strtoupper(mb_substr((string)$playerName, 0, 1));
                    $timeLabel = '';
                    $invitedAt = $entry->invited_at ?? $entry->created;
                    if ($invitedAt && method_exists($invitedAt, 'timeAgoInWords')) {
                        $timeLabel = $invitedAt->timeAgoInWords(['accuracy' => ['day' => 'day', 'month' => 'month', 'year' => 'year']]);
                    } elseif ($invitedAt && method_exists($invitedAt, 'format')) {
                        $timeLabel = $invitedAt->format('d/m/Y');
                    }
                    ?>
                    <div class="request-card" data-request>
                        <div class="request-avatar"><?= h($playerInitial) ?></div>
                        <div class="request-body">
                            <div class="request-title">
                                <strong><?= h($playerName) ?></strong>
                                <?php if ($timeLabel !== ''): ?>
                                    <span><?= h($timeLabel) ?></span>
                                <?php endif; ?>
                            </div>
                            <p>Solicitou entrar na campanha.</p>
                        </div>
                        <div class="request-actions">
                            <button type="button" class="icon-btn" data-request-action="decline">
                                <i data-lucide="x" class="w-4 h-4"></i>
                            </button>
                            <button type="button" class="icon-btn icon-btn--primary" data-request-action="accept">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="request-empty <?= $pendingCount > 0 ? 'is-hidden' : '' ?>">
                    Nenhuma solicita&ccedil;&atilde;o pendente.
                </div>
            </div>
        </div>
    </section>

    <section class="tab-panel" data-panel="settings">
        <div class="panel-card">
            <div class="panel-head">
                <h2>Configura&ccedil;&otilde;es da campanha</h2>
            </div>
            <div class="settings-list">
                <div class="settings-row">
                    <div>
                        <strong>C&oacute;digo de acesso</strong>
                        <span>Use este c&oacute;digo para convidar jogadores</span>
                    </div>
                    <button type="button" class="btn btn-ghost" data-copy="<?= h((string)($masterCampaign->invite_code ?? '')) ?>">
                        <i data-lucide="copy" class="w-4 h-4"></i>
                        <span class="copy-label"><?= h((string)($masterCampaign->invite_code ?? '---')) ?></span>
                    </button>
                </div>
                <div class="settings-row">
                    <div>
                        <strong>Visibilidade</strong>
                        <span><?= $visibilityLabel === 'P&uacute;blica' ? 'Vis&iacute;vel no explorar' : 'Apenas por convite' ?></span>
                    </div>
                    <span class="pill-status"><?= $visibilityLabel ?></span>
                </div>
                <div class="settings-row settings-row--danger">
                    <div>
                        <strong>Excluir campanha</strong>
                        <span>Esta a&ccedil;&atilde;o n&atilde;o pode ser desfeita</span>
                    </div>
                    <?= $this->Form->postLink(
                        '<i data-lucide="trash-2" class="w-4 h-4"></i><span>Excluir</span>',
                        ['action' => 'delete', $masterCampaign->id],
                        [
                            'escape' => false,
                            'confirm' => __('Tem certeza que deseja excluir esta campanha?'),
                            'class' => 'btn btn-danger',
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    </section>
</div>
