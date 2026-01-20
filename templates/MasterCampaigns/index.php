<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MasterCampaign[]|\Cake\Datasource\ResultSetInterface $masterCampaigns
 */

$this->assign('title', 'Minhas Campanhas');


echo $this->Html->script('https://unpkg.com/lucide@latest', ['block' => true]);
echo $this->Html->scriptBlock('document.addEventListener("DOMContentLoaded", function(){ if (window.lucide) { lucide.createIcons(); } });', ['block' => true]);
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
    'draft' => ['label' => 'Rascunho', 'color' => '#AF7A1B', 'bg' => '#FFF4E1'],
    'paused' => ['label' => 'Pausada', 'color' => '#9A5C12', 'bg' => '#FFEFE2'],
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
?>

<div class="master-shell">
    <div class="master-header">
        <div>
            <div class="header-eyebrow">
                <i data-lucide="shield" class="w-4 h-4"></i>
                <span>Painel do Mestre</span>
            </div>
            <div class="header-title">Minhas Campanhas</div>
            <p class="header-sub">Gerencie campanhas ativas, rascunhos e encerradas em um so lugar.</p>
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
            <p class="kpi-value" style="color: #1B9D63;"><?= $leadingZero($counts['live']) ?></p>
        </div>
        <div class="kpi-card">
            <div class="kpi-label">Rascunhos</div>
            <p class="kpi-value" style="color: #C57B14;"><?= $leadingZero($counts['draft']) ?></p>
        </div>
        <div class="kpi-card">
            <div class="kpi-label">Jogadores</div>
            <p class="kpi-value" style="color: #B11226;"><?= $leadingZero($players) ?></p>
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
            $privacy = $c->is_public ? 'Publica' : 'Privada';
            ?>
            <div class="campaign-card <?= $viewMode === 'list' ? 'is-list' : '' ?>">
                <div class="cover <?= $cover ? '' : 'cover-placeholder' ?>" <?= $cover ? '' : 'style="background: linear-gradient(135deg, #F8CACA, #B11226);"' ?>>
                    <?php if ($cover): ?>
                        <img src="<?= h($cover) ?>" alt="<?= h($c->name) ?>">
                    <?php else: ?>
                        <span class="cover-initial"><?= h($initial) ?></span>
                    <?php endif; ?>

                    <?php if ($systemName): ?>
                        <span class="chip system"><?= h(mb_strtoupper($systemName)) ?></span>
                    <?php endif; ?>
                    <?php if (!empty($c->status)): ?>
                        <span class="chip status" style="color: <?= h($statusConf['color']) ?>; background: <?= h($statusConf['bg']) ?>; border-color: <?= h($statusConf['bg']) ?>;">
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
                                <?= (int)($c->max_players ?? 0) ?> jogadores
                            </span>
                            <span class="meta-item">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                                <?= $startLabel !== '' ? h($startLabel) : 'Sem data' ?>
                            </span>
                        </div>
                        <span class="privacy"><?= h($privacy) ?></span>
                    </div>

                    <div class="actions-row">
                        <?= $this->Html->link('<span>Gerenciar</span><i data-lucide="chevron-right" class="w-4 h-4"></i>', ['action' => 'view', $c->id], ['escape' => false, 'class' => 'primary-btn']) ?>
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
