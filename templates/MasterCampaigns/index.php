<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MasterCampaign[]|\Cake\Datasource\ResultSetInterface $masterCampaigns
 */

$this->assign('title', 'Minhas Campanhas');


echo $this->Html->script('https://unpkg.com/lucide@latest', ['block' => true]);
echo $this->Html->scriptBlock('document.addEventListener("DOMContentLoaded", function(){ if (window.lucide) { lucide.createIcons(); } });', ['block' => true]);
echo $this->Html->css('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap', ['block' => true]);
echo $this->Html->css('teste', ['block' => true]);

// Normalize campaigns into a plain array
$campaigns = [];
foreach ($masterCampaigns as $m) {
    $campaigns[] = $m;
}

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

$total = count($campaigns);
$counts = [
    'live' => 0,
    'draft' => 0,
    'paused' => 0,
    'ended' => 0,
];
$players = 0;
foreach ($campaigns as $c) {
    $players += (int)($c->max_players ?? 0);
    $normalized = $normalizeStatus($c->status ?? '');
    if (isset($counts[$normalized])) {
        $counts[$normalized]++;
    }
}

$q = trim((string)$this->request->getQuery('q'));
$filterStatus = $normalizeStatus($this->request->getQuery('status'));
$viewMode = $this->request->getQuery('mode') === 'list' ? 'list' : 'grid';

$queryParams = $this->request->getQueryParams();
unset($queryParams['page']);
$buildQuery = static function (array $params) use ($queryParams): array {
    $merged = array_merge($queryParams, $params);
    foreach ($merged as $key => $val) {
        if ($val === null || $val === '') {
            unset($merged[$key]);
        }
    }

    return $merged;
};

$leadingZero = static function (int $number): string {
    return $number < 10 ? sprintf('0%d', $number) : (string)$number;
};

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
?>

<div class="master-shell">
    <div class="master-header">
        <div>
            <div class="header-eyebrow">
                <i data-lucide="shield" class="w-4 h-4"></i>
                <span>Painel do Mestre</span>
            </div>
            <div class="header-title">Minhas Campanhas</div>
        </div>
        <div>
            <?= $this->Html->link('<i data-lucide="plus" class="w-4 h-4"></i><span>Nova Campanha</span>', ['action' => 'add'], ['escape' => false, 'class' => 'primary-btn']) ?>
        </div>
    </div>

    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-label">Total</div>
            <p class="kpi-value"><?= $leadingZero($total) ?></p>
        </div>
        <div class="kpi-card">
            <div class="kpi-label">Ativas</div>
            <p class="kpi-value is-live"><?= $leadingZero($counts['live']) ?></p>
        </div>
        <div class="kpi-card">
            <div class="kpi-label">Rascunhos</div>
            <p class="kpi-value is-draft"><?= $leadingZero($counts['draft']) ?></p>
        </div>
        <div class="kpi-card">
            <div class="kpi-label">Jogadores</div>
            <p class="kpi-value is-players"><?= $leadingZero($players) ?></p>
        </div>
    </div>

    <div class="search-toolbar">
        <form method="get" class="search-form">
            <i data-lucide="search" class="search-icon"></i>
            <input
                name="q"
                value="<?= h($q) ?>"
                class="search-input"
                placeholder="Buscar campanhas..."
                autocomplete="off"
            />
            <?php if ($filterStatus !== '' && $filterStatus !== null): ?>
                <input type="hidden" name="status" value="<?= h($filterStatus) ?>">
            <?php endif; ?>
            <?php if ($viewMode !== 'grid'): ?>
                <input type="hidden" name="mode" value="<?= h($viewMode) ?>">
            <?php endif; ?>
        </form>

        <div class="filters-wrap">
            <div class="filters">
                <a class="pill <?= ($filterStatus === '' || $filterStatus === null) ? 'is-active' : '' ?>" href="<?= $this->Url->build(['?' => $buildQuery(['status' => null, 'mode' => $viewMode, 'q' => $q])]) ?>">Todas</a>
                <a class="pill <?= $filterStatus === 'live' ? 'is-active' : '' ?>" href="<?= $this->Url->build(['?' => $buildQuery(['status' => 'live', 'mode' => $viewMode, 'q' => $q])]) ?>">Ativas</a>
                <a class="pill <?= $filterStatus === 'draft' ? 'is-active' : '' ?>" href="<?= $this->Url->build(['?' => $buildQuery(['status' => 'draft', 'mode' => $viewMode, 'q' => $q])]) ?>">Rascunhos</a>
                <a class="pill <?= $filterStatus === 'paused' ? 'is-active' : '' ?>" href="<?= $this->Url->build(['?' => $buildQuery(['status' => 'paused', 'mode' => $viewMode, 'q' => $q])]) ?>">Pausadas</a>
                <a class="pill <?= $filterStatus === 'ended' ? 'is-active' : '' ?>" href="<?= $this->Url->build(['?' => $buildQuery(['status' => 'ended', 'mode' => $viewMode, 'q' => $q])]) ?>">Encerradas</a>
            </div>
            <div class="view-toggle">
                <a class="<?= $viewMode === 'grid' ? 'is-active' : '' ?>" href="<?= $this->Url->build(['?' => $buildQuery(['mode' => 'grid'])]) ?>" aria-label="Modo grade"><i data-lucide="layout-grid"></i></a>
                <a class="<?= $viewMode === 'list' ? 'is-active' : '' ?>" href="<?= $this->Url->build(['?' => $buildQuery(['mode' => 'list'])]) ?>" aria-label="Modo lista"><i data-lucide="list"></i></a>
            </div>
        </div>
    </div>

    <?php $shown = 0; ?>
    <div class="campaign-grid <?= $viewMode === 'list' ? 'list-mode' : '' ?>">
        <?php foreach ($campaigns as $c):
            $normalized = $normalizeStatus($c->status ?? '');
            if ($filterStatus !== '' && $filterStatus !== null && $normalized !== $filterStatus) {
                continue;
            }
            if ($q !== '') {
                $hay = mb_strtolower(($c->name ?? '') . ' ' . ($c->description ?? ''));
                if (mb_strpos($hay, mb_strtolower($q)) === false) {
                    continue;
                }
            }

            $shown++;
            $cover = null;
            if (!empty($c->cover_image)) {
                $cover = $this->Url->build('/' . ltrim((string)$c->cover_image, '/'));
            }
            $initial = strtoupper(mb_substr((string)($c->name ?? 'C'), 0, 1));
            $systemName = $c->hasValue('system') ? ($c->system->name ?? $c->system->slug ?? null) : null;
            $statusConf = $statusMeta[$normalized] ?? ['label' => ucfirst($c->status ?? 'Status'), 'color' => '#5F6470', 'bg' => '#EEF0F4'];
            $startLabel = '';
            if (!empty($c->start_date)) {
                if (method_exists($c->start_date, 'timeAgoInWords')) {
                    $startLabel = $c->start_date->timeAgoInWords(['accuracy' => ['day' => 'day', 'month' => 'month', 'year' => 'year']]);
            } elseif (method_exists($c->start_date, 'format')) {
                    $startLabel = $c->start_date->format('d/m/Y');
                }
            }
            $playerTotal = (int)($c->max_players ?? 0);
            $playerDisplay = $playerTotal > 0
                ? sprintf('%d/%d', $currentPlayers($c), $playerTotal)
                : (string)$currentPlayers($c);
            ?>
            <div class="campaign-card <?= $viewMode === 'list' ? 'is-list' : '' ?>">
                <div class="cover <?= $cover ? '' : 'cover-placeholder' ?>" <?= $cover ? '' : 'style="background: linear-gradient(135deg, #F7D8D8, #B11226);"' ?>>
                    <?php if ($cover): ?>
                        <img src="<?= h($cover) ?>" alt="<?= h($c->name) ?>">
                    <?php else: ?>
                        <span class="cover-initial"><?= h($initial) ?></span>
                    <?php endif; ?>

                    <?php if ($systemName): ?>
                        <span class="chip system"><?= h(mb_strtoupper($systemName)) ?></span>
                    <?php endif; ?>
                    <?php if (!empty($c->status)): ?>
                        <span class="chip status" style="color: <?= h($statusConf['color']) ?>; background: <?= h($statusConf['bg']) ?>;">
                            <?= h(mb_strtoupper($statusConf['label'])) ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="card-body">
                    <div class="card-head">
                        <h3><?= h($c->name) ?></h3>
                        <p><?= h(mb_strimwidth(trim((string)($c->description ?? '')), 0, 140, '...')) ?: 'Sem descricao no momento.' ?></p>
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
                        <?= $this->Html->link('<span>Gerenciar</span><i data-lucide="chevron-right" class="w-4 h-4"></i>', ['action' => 'view', $c->id], ['escape' => false, 'class' => 'primary-btn primary-btn--full']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if ($shown === 0): ?>
            <div class="empty-state">Nenhuma campanha encontrada.</div>
        <?php endif; ?>
    </div>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('<') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('>') ?>
        </ul>
        <p class="text-sm"><?= $this->Paginator->counter() ?></p>
    </div>
</div>
