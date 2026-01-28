<?php
/**
 * @var \App\View\AppView $this
 * @var string $greetingName
 */
$this->assign('title', 'Hub Central');

echo $this->Html->css('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', ['block' => true]);
echo $this->Html->css('master-home', ['block' => true]);
echo $this->Html->script('https://unpkg.com/lucide@latest', ['block' => true]);
echo $this->Html->scriptBlock(
    'document.addEventListener("DOMContentLoaded", function(){ if (window.lucide) { lucide.createIcons(); } });',
    ['block' => true]
);
?>

<div class="master-home">
    <header class="home-hero reveal" style="--delay: 0s;">
        <div class="home-hero__eyebrow">
            <i data-lucide="sparkles" class="icon"></i>
            <span>HUB CENTRAL</span>
        </div>
        <h1 class="home-hero__title">
            Bem-vindo de volta, <span><?= h($greetingName ?? 'Mestre') ?></span>
        </h1>
        <p class="home-hero__subtitle">O que voc&ecirc; gostaria de fazer hoje?</p>
    </header>

    <section class="action-grid">
        <a class="action-card action-card--primary reveal" style="--delay: 0.05s;" href="<?= $this->Url->build(['action' => 'add']) ?>">
            <span class="action-icon">
                <i data-lucide="plus" class="icon"></i>
            </span>
            <div>
                <h3>Nova Campanha</h3>
                <p>Crie um novo mundo</p>
            </div>
        </a>
        <a class="action-card reveal" style="--delay: 0.1s;" href=" <?= $this->Url->build(['action' => 'index']) ?>">
            <span class="action-icon">
                <i data-lucide="search" class="icon"></i>
            </span>
            <div>
                <h3>Procurar</h3>
                <p>Encontre campanhas</p>
            </div>
        </a>
        <a class="action-card reveal" style="--delay: 0.15s;" href="<?= $this->Url->build(['action' => 'explore']) ?>">
            <span class="action-icon">
                <i data-lucide="compass" class="icon"></i>
            </span>
            <div>
                <h3>Em manutençãooo</h3>
                <p>Campanhas p&uacute;blicas</p>
            </div>
        </a>
        <a class="action-card reveal" style="--delay: 0.2s;" href="<?= $this->Url->build(['action' => 'myCampaigns']) ?>">
            <span class="action-icon">
                <i data-lucide="book-open" class="icon"></i>
            </span>
            <div>
                <h3>Minhas Campanhas</h3>
                <p>Ver todas</p>
            </div>
        </a>
    </section>

    <section class="dashboard">
        <div class="dashboard-main">
            <div class="section-head reveal" style="--delay: 0.25s;">
                <h2>Campanhas Ativas</h2>
                <a class="section-link" href="<?= $this->Url->build(['action' => 'myCampaigns']) ?>">
                    <span>Ver todas</span>
                    <i data-lucide="chevron-right" class="icon"></i>
                </a>
            </div>

            <div class="campaign-grid">
                <article class="campaign-card reveal" style="--delay: 0.3s;">
                    <div class="campaign-media">
                        <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=1200&auto=format&fit=crop" alt="Cr&ocirc;nicas do Vazio">
                        <span class="campaign-chip campaign-chip--system">D&amp;D 5E</span>
                        <span class="campaign-chip campaign-chip--status">ATIVA</span>
                    </div>
                    <div class="campaign-body">
                        <h3>Cr&ocirc;nicas do Vazio</h3>
                        <p>Uma aventura &eacute;pica atrav&eacute;s dos planos dimensionais.</p>
                        <div class="campaign-meta">
                            <span><i data-lucide="users" class="icon"></i> 4/5</span>
                            <span><i data-lucide="clock-3" class="icon"></i> H&aacute; 2 dias</span>
                        </div>
                        <button class="btn btn--ghost" type="button">
                            <span>Entrar</span>
                            <i data-lucide="chevron-right" class="icon"></i>
                        </button>
                    </div>
                </article>

                <article class="campaign-card reveal" style="--delay: 0.35s;">
                    <div class="campaign-media">
                        <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1200&auto=format&fit=crop" alt="A Queda de Ravnica">
                        <span class="campaign-chip campaign-chip--system">PATHFINDER 2E</span>
                        <span class="campaign-chip campaign-chip--status is-live">ATIVA</span>
                    </div>
                    <div class="campaign-body">
                        <h3>A Queda de Ravnica</h3>
                        <p>A cidade est&aacute; em perigo. Quem ir&aacute; salv&aacute;-la?</p>
                        <div class="campaign-meta">
                            <span><i data-lucide="users" class="icon"></i> 3/4</span>
                            <span><i data-lucide="calendar" class="icon"></i> Ontem</span>
                        </div>
                        <button class="btn btn--primary" type="button">
                            <span>Gerenciar</span>
                            <i data-lucide="chevron-right" class="icon"></i>
                        </button>
                    </div>
                </article>
            </div>

            <div class="invite-card reveal" style="--delay: 0.4s;">
                <div class="invite-head">
                    <span class="invite-icon">
                        <i data-lucide="ticket" class="icon"></i>
                    </span>
                    <div>
                        <h3>Entrar com C&oacute;digo</h3>
                        <p>Use um c&oacute;digo de convite para entrar em uma campanha</p>
                    </div>
                </div>
                <?= $this->Form->create(null, [
                    'url' => ['controller' => 'CampaignPlayers', 'action' => 'invite'],
                    'class' => 'invite-form',
                ]) ?>
                    <?= $this->Form->text('invite_code', [
                        'class' => 'invite-input',
                        'placeholder' => 'EX: K7-X92',
                        'aria-label' => 'C&oacute;digo de convite',
                        'required' => true,
                    ]) ?>
                    <button class="btn btn--soft" type="submit">Entrar</button>
                <?= $this->Form->end() ?>
            </div>
        </div>

        <aside class="dashboard-side">
            <div class="panel notifications-card reveal" style="--delay: 0.3s;">
                <div class="panel-head">
                    <h3>Notifica&ccedil;&otilde;es</h3>
                    <span class="badge">2</span>
                </div>
                <div class="notification-list">
                    <div class="notification-item">
                        <span class="notification-icon is-red">
                            <i data-lucide="user-plus" class="icon"></i>
                        </span>
                        <div class="notification-body">
                            <div class="notification-title">Convite para campanha <span class="dot"></span></div>
                            <p>Voc&ecirc; foi convidado para "O Despertar dos..."</p>
                            <span class="notification-time">H&aacute; 5 min</span>
                        </div>
                        <i data-lucide="chevron-right" class="icon notification-arrow"></i>
                    </div>
                    <div class="notification-item">
                        <span class="notification-icon is-green">
                            <i data-lucide="sparkles" class="icon"></i>
                        </span>
                        <div class="notification-body">
                            <div class="notification-title">Nova sess&atilde;o agendada <span class="dot"></span></div>
                            <p>Cr&ocirc;nicas do Vazio - S&aacute;bado &agrave;s 19h</p>
                            <span class="notification-time">H&aacute; 1 hora</span>
                        </div>
                        <i data-lucide="chevron-right" class="icon notification-arrow"></i>
                    </div>
                    <div class="notification-item">
                        <span class="notification-icon is-gray">
                            <i data-lucide="bell" class="icon"></i>
                        </span>
                        <div class="notification-body">
                            <div class="notification-title">Atualiza&ccedil;&atilde;o do sistema</div>
                            <p>Novos recursos dispon&iacute;veis na vers&atilde;o 2.1</p>
                            <span class="notification-time">H&aacute; 2 dias</span>
                        </div>
                        <i data-lucide="chevron-right" class="icon notification-arrow"></i>
                    </div>
                </div>
                <a class="panel-link" href="#">Ver todas</a>
            </div>

            <div class="panel stats-card reveal" style="--delay: 0.45s;">
                <h3>Suas Estat&iacute;sticas</h3>
                <div class="stats-list">
                    <div class="stat-row">
                        <span>Campanhas como Mestre</span>
                        <strong>3</strong>
                    </div>
                    <div class="stat-row">
                        <span>Campanhas como Jogador</span>
                        <strong>5</strong>
                    </div>
                    <div class="stat-row">
                        <span>Sess&otilde;es este m&ecirc;s</span>
                        <strong class="is-accent">12</strong>
                    </div>
                    <div class="stat-row">
                        <span>Tokens dispon&iacute;veis</span>
                        <strong class="is-accent">14</strong>
                    </div>
                </div>
            </div>
        </aside>
    </section>
</div>
