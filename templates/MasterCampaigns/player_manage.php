<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MasterCampaign $masterCampaign
 * @var \App\Model\Entity\CampaignPlayer $playerEntry
 * @var array<\App\Model\Entity\CampaignPlayer> $activePlayers
 * @var string $playerStatus
 */

$this->assign('title', 'Campanha');

echo $this->Html->script('https://unpkg.com/lucide@latest', ['block' => true]);
echo $this->Html->scriptBlock(
    'document.addEventListener("DOMContentLoaded", function(){ if (window.lucide) { lucide.createIcons(); } });',
    ['block' => true]
);
echo $this->Html->css('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap', ['block' => true]);
echo $this->Html->css('player-campaign-manage', ['block' => true]);

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
$systemName = $masterCampaign->hasValue('system') ? ($masterCampaign->system->name ?? $masterCampaign->system->slug ?? null) : null;
$masterName = $masterCampaign->hasValue('master_user')
    ? ($masterCampaign->master_user->name ?? $masterCampaign->master_user->username ?? 'Mestre')
    : 'Mestre';
$activeList = is_iterable($activePlayers) ? (is_array($activePlayers) ? $activePlayers : iterator_to_array($activePlayers)) : [];
$playerCount = count($activeList) + 1;
$maxPlayers = (int)($masterCampaign->max_players ?? 0);
$playerDisplay = $maxPlayers > 0 ? sprintf('%d/%d', $playerCount, $maxPlayers) : (string)$playerCount;
$visibilityLabel = $masterCampaign->is_public ? 'P&uacute;blica' : 'Privada';

$acceptedStatuses = ['accepted', 'approved', 'active'];
$isAccepted = in_array($playerStatus, $acceptedStatuses, true);
$isPending = $playerStatus === 'pending';
?>

<div class="player-campaign">
    <div class="player-topbar">
        <a class="back-btn" href="<?= $this->Url->build(['action' => 'myCampaigns']) ?>">
            <i data-lucide="chevron-left" class="w-4 h-4"></i>
            <span>Voltar</span>
        </a>
    </div>

    <div class="player-layout">
        <div class="player-main">
            <section class="hero-card">
                <div class="hero-media <?= $cover ? '' : 'hero-placeholder' ?>" <?= $cover ? '' : 'style="background: linear-gradient(135deg, #1D4ED8, #6D28D9);"' ?>>
                    <?php if ($cover): ?>
                        <img src="<?= h($cover) ?>" alt="<?= h($masterCampaign->name) ?>">
                    <?php else: ?>
                        <span class="cover-initial"><?= h($initial) ?></span>
                    <?php endif; ?>
                    <?php if (!empty($masterCampaign->status)): ?>
                        <span class="hero-status" style="color: <?= h($statusConf['color']) ?>; background: <?= h($statusConf['bg']) ?>;">
                            <?= h(mb_strtoupper($statusConf['label'])) ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="hero-body">
                    <h1><?= h($masterCampaign->name) ?></h1>
                </div>
            </section>

            <section class="synopsis-card">
                <div class="card-head">
                    <span>Sinopse</span>
                </div>
                <p><?= h(trim((string)($masterCampaign->description ?? ''))) ?: 'Sem descricao no momento.' ?></p>
            </section>
        </div>

        <aside class="player-side">
            <section class="side-card">
                <div class="side-head">
                    <h2>Jogadores</h2>
                    <span class="side-count"><?= h($playerDisplay) ?></span>
                </div>
                <div class="player-list">
                    <div class="player-row">
                        <div class="player-avatar player-avatar--master">
                            <?= h(mb_substr($masterName, 0, 1)) ?>
                        </div>
                        <div class="player-info">
                            <strong><?= h($masterName) ?></strong>
                            <span>Mestre</span>
                        </div>
                        <span class="role-pill">GM</span>
                    </div>

                    <?php foreach ($activeList as $entry):
                        $playerName = $entry->user->name ?? $entry->user->username ?? 'Jogador';
                        $playerInitial = strtoupper(mb_substr((string)$playerName, 0, 1));
                        ?>
                        <div class="player-row">
                            <div class="player-avatar"><?= h($playerInitial) ?></div>
                            <div class="player-info">
                                <strong><?= h($playerName) ?></strong>
                                <span>Jogador</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="side-card details-card">
                <div class="side-head">
                    <h2>Detalhes</h2>
                </div>
                <div class="detail-row">
                    <span class="detail-icon">
                        <i data-lucide="dice-5" class="w-4 h-4"></i>
                    </span>
                    <div>
                        <small>Sistema</small>
                        <strong><?= h($systemName ?? 'Sistema') ?></strong>
                    </div>
                </div>
                <div class="detail-row">
                    <span class="detail-icon">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                    </span>
                    <div>
                        <small>Data de inicio</small>
                        <strong><?= $startLabel !== '' ? h($startLabel) : 'Sem data' ?></strong>
                    </div>
                </div>
                <div class="detail-row">
                    <span class="detail-icon">
                        <i data-lucide="users" class="w-4 h-4"></i>
                    </span>
                    <div>
                        <small>Capacidade</small>
                        <strong><?= h($playerDisplay) ?> jogadores</strong>
                    </div>
                </div>
                <div class="detail-row">
                    <span class="detail-icon">
                        <i data-lucide="eye" class="w-4 h-4"></i>
                    </span>
                    <div>
                        <small>Visibilidade</small>
                        <strong><?= $visibilityLabel ?></strong>
                    </div>
                </div>
            </section>

            <div class="side-action">
                <?php if ($isAccepted): ?>
                    <button type="button" class="enter-btn">Entrar na campanha</button>
                <?php else: ?>
                    <button type="button" class="enter-btn is-disabled" disabled>Entrar na campanha</button>
                    <?php if ($isPending): ?>
                        <span class="pending-label">Aguardando aprovacao do mestre</span>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </aside>
    </div>
</div>
