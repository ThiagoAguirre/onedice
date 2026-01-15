<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MasterCampaign $masterCampaign
 * @var \Cake\Collection\CollectionInterface|string[] $masterUsers
 * @var \Cake\Collection\CollectionInterface|string[] $systems
 */
$this->assign('title', __('Gênesis da Campanha'));

$this->start('meta');
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php
$this->end();

echo $this->Html->css(
    'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap',
    ['block' => true]
);
echo $this->Html->script('https://cdn.tailwindcss.com', ['block' => true]);
echo $this->Html->script('https://unpkg.com/lucide@latest', ['block' => true]);

$this->start('css');
?>
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #000000;
        color: #e5e5e5;
        overflow-x: hidden;
    }

    .top-nav {
        display: none;
    }

    .main {
        margin: 0;
        padding: 0;
    }

    .main .container {
        max-width: none;
        padding: 0;
        width: 100%;
    }

    /* Background Noise Texture */
    .bg-noise {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
        opacity: 0.03;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
    }

    /* Ambient Glows */
    .glow-spot {
        position: fixed;
        border-radius: 50%;
        filter: blur(100px);
        z-index: 0;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #333; border-radius: 3px; }
    ::-webkit-scrollbar-thumb:hover { background: #555; }

    /* Input Styling Override */
    input, select, textarea {
        background-clip: padding-box;
    }

    /* Custom Range Slider */
    input[type=range] {
        -webkit-appearance: none;
        background: transparent;
    }
    input[type=range]::-webkit-slider-thumb {
        -webkit-appearance: none;
        height: 16px;
        width: 16px;
        border-radius: 50%;
        background: #fff;
        cursor: pointer;
        margin-top: -6px;
        box-shadow: 0 0 10px rgba(255,255,255,0.5);
    }
    input[type=range]::-webkit-slider-runnable-track {
        width: 100%;
        height: 4px;
        cursor: pointer;
        background: #333;
        border-radius: 2px;
    }

    /* Animations */
    @keyframes floatUp {
        from { opacity: 0; transform: translateY(20px) scale(0.98); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .animate-enter { animation: floatUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

    .delay-100 { animation-delay: 100ms; }
    .delay-200 { animation-delay: 200ms; }
    .delay-300 { animation-delay: 300ms; }

    /* Specific UI Components */
    .stat-card {
        background: linear-gradient(180deg, rgba(255,255,255,0.03) 0%, rgba(255,255,255,0.01) 100%);
        border: 1px solid rgba(255,255,255,0.08);
        transition: all 0.3s ease;
    }
    .stat-card:hover, .stat-card:focus-within {
        border-color: rgba(255,255,255,0.2);
        background: linear-gradient(180deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.02) 100%);
        box-shadow: 0 0 20px rgba(0,0,0,0.5);
    }

    .tab-radio:checked + div {
        background-color: #fff;
        color: #000;
    }
</style>
<?php
$this->end();

$maxPlayers = (int)($masterCampaign->max_players ?? 4);
$playerDisplay = str_pad((string)$maxPlayers, 2, '0', STR_PAD_LEFT);
$currentStatus = $masterCampaign->status ?: 'draft';
$statusOptions = [
    'draft' => ['text' => __('Draft'), 'templateVars' => ['icon' => 'pen-tool']],
    'live' => ['text' => __('Live'), 'templateVars' => ['icon' => 'play']],
    'hold' => ['text' => __('Hold'), 'templateVars' => ['icon' => 'pause']],
];
?>
<div class="min-h-screen flex flex-col items-center justify-center p-4 sm:p-6 lg:p-8">
    <!-- Background Elements -->
    <div class="bg-noise"></div>
    <div class="glow-spot top-[-20%] left-[-10%] w-[800px] h-[800px] bg-indigo-900/20"></div>
    <div class="glow-spot bottom-[-20%] right-[-10%] w-[600px] h-[600px] bg-violet-900/10"></div>

    <!-- Navigation Minimalist -->
    <nav class="fixed top-0 w-full z-50 flex justify-between items-center px-6 py-6 lg:px-12 pointer-events-none">
        <a class="pointer-events-auto flex items-center gap-2 text-white/80 hover:text-white transition-colors cursor-pointer group" href="<?= $this->Url->build(['action' => 'index']) ?>">
            <div class="p-1.5 rounded bg-white/5 border border-white/10 group-hover:bg-white/10 transition-colors">
                <i data-lucide="chevron-left" class="w-4 h-4"></i>
            </div>
            <span class="text-xs font-medium tracking-widest uppercase"><?= __('Abortar') ?></span>
        </a>

        <div class="hidden sm:flex items-center gap-6 pointer-events-auto">
            <span class="text-[10px] font-bold tracking-[0.2em] text-white/30 uppercase"><?= __('Sistema v.2.0') ?></span>
            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-zinc-800 to-zinc-700 border border-white/10"></div>
        </div>
    </nav>

    <!-- Main "Monolith" Container -->
    <main class="w-full max-w-5xl relative z-10 animate-enter">
        <?= $this->Form->create($masterCampaign, ['class' => 'w-full grid grid-cols-1 lg:grid-cols-12 gap-6', 'type' => 'file']) ?>
            <!-- Header / Title Section (Full Width) -->
            <div class="lg:col-span-12 mb-4 relative group">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/20 via-purple-500/10 to-transparent blur-3xl opacity-50 group-hover:opacity-70 transition-opacity duration-700"></div>
                <div class="relative z-10 flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-white/10 pb-8">
                    <div class="space-y-2">
                        <div class="flex items-center gap-3 text-indigo-400 mb-2">
                            <i data-lucide="sparkles" class="w-4 h-4"></i>
                            <span class="text-xs font-bold tracking-[0.2em] uppercase"><?= __('Nova Sessão') ?></span>
                        </div>
                        <h1 class="text-4xl md:text-6xl font-semibold tracking-tighter text-white"><?= __('Gênesis') ?></h1>
                        <p class="text-zinc-400 max-w-md text-sm leading-relaxed"><?= __('Configure os parâmetros da realidade para sua próxima aventura. O mundo aguarda sua criação.') ?></p>
                    </div>

                    <!-- Quick Actions -->
                    <div class="flex items-center gap-3">
                        <button type="button" class="group flex items-center gap-3 px-4 py-2 rounded-full bg-white/5 border border-white/10 hover:bg-white/10 transition-all">
                            <i data-lucide="upload-cloud" class="w-4 h-4 text-zinc-400 group-hover:text-white"></i>
                            <span class="text-xs font-medium text-zinc-300"><?= __('Importar JSON') ?></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Left Column: Core Data -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Primary Input Block -->
                <div class="stat-card p-1 rounded-2xl">
                    <div class="bg-black/40 rounded-xl p-6 space-y-8 backdrop-blur-sm">
                        <!-- Title Input -->
                        <div class="group relative">
                            <label class="block text-[10px] font-bold tracking-[0.15em] text-zinc-500 uppercase mb-3 group-focus-within:text-indigo-400 transition-colors"><?= __('Designação da Campanha') ?></label>
                            <?= $this->Form->text('name', [
                                'class' => 'w-full bg-transparent border-b border-white/10 py-2 text-2xl font-light text-white placeholder:text-white/20 focus:outline-none focus:border-indigo-500 transition-all',
                                'placeholder' => __('Ex: Crônicas do Vazio'),
                                'required' => true,
                            ]) ?>
                            <div class="absolute right-0 bottom-3 opacity-0 group-focus-within:opacity-100 transition-opacity">
                                <span class="text-[10px] text-indigo-500 font-mono"><?= __('EDITANDO...') ?></span>
                            </div>
                        </div>

                        <!-- Grid for Master, System & Date -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="group">
                                <label class="block text-[10px] font-bold tracking-[0.15em] text-zinc-500 uppercase mb-3"><?= __('Mestre') ?></label>
                                <div class="relative">
                                    <?= $this->Form->select('master_user_id', $masterUsers, [
                                        'class' => 'w-full bg-zinc-900/50 border border-white/10 rounded-lg px-4 py-3 text-sm text-zinc-200 appearance-none focus:outline-none focus:ring-1 focus:ring-indigo-500/50 cursor-pointer hover:bg-zinc-800/50 transition-colors',
                                        'required' => true,
                                    ]) ?>
                                    <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-500 pointer-events-none"></i>
                                </div>
                            </div>

                            <div class="group">
                                <label class="block text-[10px] font-bold tracking-[0.15em] text-zinc-500 uppercase mb-3"><?= __('Sistema Operacional') ?></label>
                                <div class="relative">
                                    <?= $this->Form->select('system_id', $systems, [
                                        'class' => 'w-full bg-zinc-900/50 border border-white/10 rounded-lg px-4 py-3 text-sm text-zinc-200 appearance-none focus:outline-none focus:ring-1 focus:ring-indigo-500/50 cursor-pointer hover:bg-zinc-800/50 transition-colors',
                                        'empty' => __('Selecione um sistema'),
                                    ]) ?>
                                    <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-500 pointer-events-none"></i>
                                </div>
                            </div>

                            <div class="group">
                                <label class="block text-[10px] font-bold tracking-[0.15em] text-zinc-500 uppercase mb-3"><?= __('Início do Ciclo') ?></label>
                                <div class="relative">
                                    <?= $this->Form->text('start_date', [
                                        'type' => 'date',
                                        'class' => 'w-full bg-zinc-900/50 border border-white/10 rounded-lg px-4 py-3 text-sm text-zinc-200 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 [&::-webkit-calendar-picker-indicator]:invert [&::-webkit-calendar-picker-indicator]:opacity-30 cursor-pointer',
                                    ]) ?>
                                </div>
                            </div>
                        </div>

                        <!-- Description Area -->
                        <div class="group">
                            <label class="block text-[10px] font-bold tracking-[0.15em] text-zinc-500 uppercase mb-3"><?= __('Lore & Contexto') ?></label>
                            <?= $this->Form->textarea('description', [
                                'rows' => 5,
                                'class' => 'w-full bg-zinc-900/50 border border-white/10 rounded-lg px-4 py-4 text-sm text-zinc-300 placeholder:text-zinc-700 focus:outline-none focus:ring-1 focus:ring-indigo-500/50 resize-none leading-relaxed',
                                'placeholder' => __('Digite a premissa da sua história aqui...'),
                            ]) ?>
                        </div>
                    </div>
                </div>

                <!-- Settings Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Player Count Slider -->
                    <div class="stat-card rounded-2xl p-6 flex flex-col justify-between">
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold tracking-[0.15em] text-zinc-500 uppercase"><?= __('Capacidade') ?></span>
                                <span class="text-xs text-zinc-400 mt-1"><?= __('Jogadores') ?></span>
                            </div>
                            <span class="text-2xl font-light text-white font-mono" id="playerValue"><?= h($playerDisplay) ?></span>
                        </div>
                        <?= $this->Form->text('max_players', [
                            'type' => 'range',
                            'min' => 1,
                            'max' => 12,
                            'value' => $maxPlayers,
                            'class' => 'w-full h-1 bg-zinc-800 rounded-lg appearance-none cursor-pointer',
                            'oninput' => "document.getElementById('playerValue').innerText = this.value.toString().padStart(2, '0')",
                        ]) ?>
                        <div class="flex justify-between text-[10px] text-zinc-600 font-mono mt-2 uppercase">
                            <span><?= __('Solo') ?></span>
                            <span><?= __('Grupo') ?></span>
                            <span><?= __('Raid') ?></span>
                        </div>
                    </div>

                    <!-- Visibility Toggle -->
                    <div class="stat-card rounded-2xl p-6 flex flex-col justify-between group cursor-pointer">
                        <label class="cursor-pointer">
                            <?= $this->Form->checkbox('is_public', ['class' => 'peer sr-only']) ?>
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-bold tracking-[0.15em] text-zinc-500 uppercase group-hover:text-zinc-300 transition-colors"><?= __('Visibilidade') ?></span>
                                    <span class="text-xs text-zinc-400 mt-1"><?= __('Listar publicamente') ?></span>
                                </div>
                                <div class="w-10 h-5 bg-zinc-800 rounded-full peer-checked:bg-indigo-600 relative transition-colors">
                                    <div class="absolute top-1 left-1 w-3 h-3 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                                </div>
                            </div>
                            <div class="text-xs text-zinc-500 peer-checked:text-indigo-300/80 transition-colors leading-relaxed">
                                <?= __('Habilitar permite que viajantes encontrem sua mesa no nexus de busca.') ?>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Right Column: Visuals & Meta -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Cover Image "Portal" -->
                <div class="stat-card rounded-2xl p-1 h-64 relative overflow-hidden group">
                    <?= $this->Form->file('cover_image', [
                        'class' => 'absolute inset-0 opacity-0 z-20 cursor-pointer',
                        'title' => __('Alterar Capa'),
                        'accept' => 'image/*',
                    ]) ?>
                    <div class="absolute inset-0 bg-zinc-900 w-full h-full rounded-xl overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1635322966219-b75ed372eb01?q=80&w=2564&auto=format&fit=crop" class="w-full h-full object-cover opacity-50 group-hover:opacity-70 group-hover:scale-105 transition-all duration-700 grayscale hover:grayscale-0" alt="<?= __('Capa da campanha') ?>">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>

                        <div class="absolute bottom-4 left-4 z-10">
                            <div class="flex items-center gap-2 mb-1">
                                <div class="w-2 h-2 rounded-full bg-green-500 shadow-[0_0_10px_rgba(34,197,94,0.8)] animate-pulse"></div>
                                <span class="text-[10px] font-bold tracking-widest uppercase text-white"><?= __('Visual') ?></span>
                            </div>
                            <p class="text-xs text-zinc-400"><?= __('Clique para carregar artefato') ?></p>
                        </div>

                        <div class="absolute top-4 right-4 z-10 w-8 h-8 rounded-full bg-black/50 backdrop-blur flex items-center justify-center border border-white/10 group-hover:border-white/30 transition-colors">
                            <i data-lucide="image" class="w-4 h-4 text-white"></i>
                        </div>
                    </div>
                </div>

                <!-- Status Selector -->
                <div class="stat-card rounded-2xl p-1">
                    <div class="bg-zinc-900/80 p-1.5 rounded-xl grid grid-cols-3 gap-1 relative">
                        <?= $this->Form->radio('status', $statusOptions, [
                            'value' => $currentStatus,
                            'hiddenField' => false,
                            'class' => 'tab-radio sr-only',
                            'templates' => [
                                'radioContainer' => '{{content}}',
                                'radioWrapper' => '{{label}}',
                                'label' => '<label class="cursor-pointer relative z-10"{{attrs}}>{{input}}<div class="flex flex-col items-center justify-center py-3 rounded-lg text-zinc-500 hover:text-zinc-300 transition-all"><i data-lucide="{{icon}}" class="w-4 h-4 mb-1"></i><span class="text-[10px] font-bold tracking-wider uppercase">{{text}}</span></div></label>',
                            ],
                        ]) ?>
                    </div>
                </div>

                <!-- Invite Code Ticket -->
                <div class="stat-card rounded-2xl p-6 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-3 opacity-20 group-hover:opacity-100 transition-opacity">
                        <i data-lucide="copy" class="w-4 h-4 text-white"></i>
                    </div>

                    <span class="text-[10px] font-bold tracking-[0.15em] text-zinc-500 uppercase block mb-4"><?= __('Chave de Acesso') ?></span>

                    <div class="flex items-end gap-1">
                        <?= $this->Form->text('invite_code', [
                            'class' => 'w-full bg-transparent border-none text-3xl font-mono text-white tracking-widest uppercase focus:outline-none',
                            'maxlength' => 20,
                            'placeholder' => __('K7-X92'),
                            'style' => 'text-shadow: 0 0 20px rgba(255,255,255,0.3);',
                        ]) ?>
                    </div>

                    <div class="mt-4 pt-4 border-t border-dashed border-white/10 flex justify-between items-center">
                        <span class="text-[10px] text-zinc-500 uppercase tracking-wider"><?= __('Expira em 24h') ?></span>
                        <div class="flex gap-1">
                            <div class="w-1 h-1 rounded-full bg-zinc-600"></div>
                            <div class="w-1 h-1 rounded-full bg-zinc-600"></div>
                            <div class="w-1 h-1 rounded-full bg-zinc-600"></div>
                        </div>
                    </div>

                    <!-- decorative barcode -->
                    <div class="absolute bottom-6 right-6 opacity-20 h-8 flex items-end gap-[2px]">
                        <div class="w-1 h-full bg-white"></div>
                        <div class="w-0.5 h-2/3 bg-white"></div>
                        <div class="w-1 h-1/2 bg-white"></div>
                        <div class="w-2 h-full bg-white"></div>
                        <div class="w-0.5 h-full bg-white"></div>
                    </div>
                </div>
            </div>

            <!-- Action Footer -->
            <div class="lg:col-span-12 mt-4 pt-8 border-t border-white/5 flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="text-xs text-zinc-600 max-w-xs text-center sm:text-left">
                    <?= __('Ao inicializar, o universo será instanciado nos servidores. Essa ação consome 2 Tokens de Criação.') ?>
                </div>

                <div class="flex items-center gap-4 w-full sm:w-auto">
                    <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'flex-1 sm:flex-none px-6 py-3 rounded-xl border border-white/10 text-xs font-bold uppercase tracking-widest text-zinc-400 hover:text-white hover:bg-white/5 transition-all']) ?>
                    <?= $this->Form->button(
                        '<div class="absolute inset-0 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500 opacity-0 group-hover:opacity-20 transition-opacity"></div><span class="relative flex items-center justify-center gap-2 text-xs font-bold uppercase tracking-widest"><i data-lucide="zap" class="w-3 h-3 fill-black"></i>' . __('Materializar') . '</span>',
                        ['class' => 'flex-1 sm:flex-none relative group px-8 py-3 bg-white text-black rounded-xl overflow-hidden hover:scale-105 transition-transform duration-300', 'escapeTitle' => false]
                    ) ?>
                </div>
            </div>
        <?= $this->Form->end() ?>
    </main>
</div>

<?= $this->Html->scriptBlock('lucide.createIcons();') ?>
