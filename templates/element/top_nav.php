<?php
/**
 * Top navigation element
 * @var \App\View\AppView $this
 */
?>

<?= $this->Html->css('nav-bar') ?>

<nav class="fixed top-0 w-full z-40 flex justify-between items-center px-6 py-5 bg-[#F5F5F5]/90 backdrop-blur-md border-b border-[#E5E5E5]">
    <!-- Left: Abort -->
    <div class="flex items-center gap-2 text-[#666666] hover:text-[#0F0F0F] transition-colors cursor-pointer group">
        <div class="p-1.5 rounded-md bg-white border border-[#E5E5E5] group-hover:border-[#B11226] transition-colors shadow-sm">
            <i data-lucide="chevron-left" class="w-4 h-4 text-[#0F0F0F]"></i>
        </div>
        <span class="text-xs font-semibold tracking-widest uppercase">Voltar</span>
    </div>
    
    <!-- Center: System ID -->
    <div class="hidden sm:flex items-center gap-3">
        <div class="w-2 h-2 rounded-full bg-[#B11226]"></div>
        <span class="text-[10px] font-bold tracking-[0.2em] text-[#0F0F0F] uppercase">Sistema v.2.0</span>
    </div>

    <!-- Right: Hamburger Menu Trigger -->
    <button id="menuBtn" class="p-2 rounded-md hover:bg-white hover:shadow-sm border border-transparent hover:border-[#E5E5E5] transition-all text-[#0F0F0F]">
        <i data-lucide="menu" class="w-5 h-5"></i>
    </button>
</nav>

<!-- Overlay & Drawer Menu -->
<div id="menuOverlay" class="fixed inset-0 bg-black/20 backdrop-blur-[2px] z-50 opacity-0 pointer-events-none overlay-transition"></div>

<aside id="menuDrawer" class="fixed top-0 right-0 h-full w-80 bg-white z-[60] shadow-2xl transform translate-x-full drawer-transition flex flex-col border-l border-[#E5E5E5]">
    <!-- Drawer Header -->
    <div class="p-6 border-b border-[#E5E5E5] flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="w-6 h-6 bg-[#0F0F0F] rounded flex items-center justify-center">
                <span class="text-white text-xs font-bold">G</span>
            </div>
            <span class="font-bold tracking-tight text-[#0F0F0F]">Gênesis OS</span>
        </div>
        <button id="closeMenuBtn" class="p-1.5 rounded hover:bg-[#F5F5F5] text-[#666666] transition-colors">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>

    <!-- Drawer Content -->
    <div class="flex-1 overflow-y-auto p-4 space-y-8">
        
        <!-- Section 1: Session -->
        <div>
            <h3 class="px-2 text-[10px] font-bold text-[#B11226] uppercase tracking-widest mb-2">Sessão</h3>
            <ul class="space-y-1">
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-[#FFF0F2] text-[#B11226] font-medium text-sm">
                        <i data-lucide="plus-square" class="w-4 h-4"></i>
                        Nova Sessão
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-[#666666] hover:bg-[#F5F5F5] hover:text-[#0F0F0F] transition-colors text-sm font-medium">
                        <i data-lucide="upload-cloud" class="w-4 h-4"></i>
                        Importar JSON
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-[#666666] hover:bg-[#F5F5F5] hover:text-[#0F0F0F] transition-colors text-sm font-medium">
                        <i data-lucide="layout-template" class="w-4 h-4"></i>
                        Templates
                    </a>
                </li>
            </ul>
        </div>

        <!-- Section 2: Campaigns -->
        <div>
            <h3 class="px-2 text-[10px] font-bold text-[#666666] uppercase tracking-widest mb-2">Campanhas</h3>
            <ul class="space-y-1">
                <li>
                    <a href="<?= $this->Url->build(['controller' => 'MasterCampaigns', 'action' => 'myCampaigns']) ?>" class="flex items-center gap-3 px-3 py-2 rounded-lg text-[#666666] hover:bg-[#F5F5F5] hover:text-[#0F0F0F] transition-colors text-sm font-medium">
                        <i data-lucide="book" class="w-4 h-4"></i>
                        Minhas Campanhas
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-[#666666] hover:bg-[#F5F5F5] hover:text-[#0F0F0F] transition-colors text-sm font-medium">
                        <i data-lucide="file-edit" class="w-4 h-4"></i>
                        Rascunhos <span class="ml-auto text-[10px] bg-[#E5E5E5] px-1.5 py-0.5 rounded text-[#0F0F0F]">3</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-[#666666] hover:bg-[#F5F5F5] hover:text-[#0F0F0F] transition-colors text-sm font-medium">
                        <i data-lucide="star" class="w-4 h-4"></i>
                        Favoritos
                    </a>
                </li>
            </ul>
        </div>

        <!-- Section 3: System -->
        <div>
            <h3 class="px-2 text-[10px] font-bold text-[#666666] uppercase tracking-widest mb-2">Sistema</h3>
            <ul class="space-y-1">
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-[#666666] hover:bg-[#F5F5F5] hover:text-[#0F0F0F] transition-colors text-sm font-medium">
                        <i data-lucide="settings" class="w-4 h-4"></i>
                        Preferências
                    </a>
                </li>
                <li>
                    <button class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-[#666666] hover:bg-[#F5F5F5] hover:text-[#0F0F0F] transition-colors text-sm font-medium">
                        <div class="flex items-center gap-3">
                            <i data-lucide="moon" class="w-4 h-4"></i>
                            Tema
                        </div>
                        <div class="flex bg-[#E5E5E5] p-0.5 rounded-full w-10 relative">
                            <div class="w-4 h-4 bg-white rounded-full shadow-sm"></div>
                        </div>
                    </button>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-[#666666] hover:bg-[#F5F5F5] hover:text-[#0F0F0F] transition-colors text-sm font-medium">
                        <i data-lucide="globe" class="w-4 h-4"></i>
                        Idioma
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Drawer Footer: Account -->
    <div class="p-4 border-t border-[#E5E5E5] bg-[#FAFAFA]">
        <a href="#" class="flex items-center gap-3 p-2 rounded-lg hover:bg-white hover:shadow-sm transition-all mb-2">
            <div class="w-8 h-8 rounded-full bg-[#B11226] text-white flex items-center justify-center font-bold text-xs">GM</div>
            <div class="flex-1">
                <p class="text-xs font-bold text-[#0F0F0F]">Mestre Supremo</p>
                <p class="text-[10px] text-[#666666]">Plano Pro</p>
            </div>
            <i data-lucide="chevron-right" class="w-4 h-4 text-[#CCCCCC]"></i>
        </a>
        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>" class="w-full flex items-center justify-center gap-2 text-xs font-bold text-[#B11226] py-2 hover:bg-[#FFF0F2] rounded transition-colors">
            <i data-lucide="log-out" class="w-3 h-3"></i>
            Sair
        </a>
    </div>
</aside>

<?php
echo $this->Html->script('https://unpkg.com/lucide@latest');
echo $this->Html->script('hamburger', ['type' => 'module']);
?>
