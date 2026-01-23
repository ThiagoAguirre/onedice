<?php
$this->assign('title', 'Gênesis da Campanha');
?>

<?php
// Registrar o script do Lucide e inicializar os ícones após o carregamento do DOM.
// O layout precisa fazer echo $this->fetch('script') no final do body.
echo $this->Html->script('https://unpkg.com/lucide@latest', ['block' => true]);
echo $this->Html->scriptBlock(
    'document.addEventListener("DOMContentLoaded", function(){ if (window.lucide) { lucide.createIcons(); } });',
    ['block' => true]
);
// Observação: fontes e outros assets globais devem ser carregados no layout.
?>

<?php
// Preview src: use saved cover if present, otherwise a placeholder image
$previewSrc = !empty($masterCampaign->cover_image) ? $this->Url->build('/' . $masterCampaign->cover_image) : 'https://images.unsplash.com/photo-1614728263952-84ea256f9679?q=80&w=2508&auto=format&fit=crop';
?>


<div class="min-h-screen flex flex-col items-center justify-start p-4 sm:p-6 lg:p-8 relative">

    <!-- Main Content -->
    <main class="w-full max-w-5xl relative z-10 animate-enter mt-20 sm:mt-24 mb-12">
        
        <?= $this->Form->create($masterCampaign, ['type' => 'file', 'class' => 'w-full grid grid-cols-1 lg:grid-cols-12 gap-6']) ?>
            
            <!-- Header Section -->
            <div class="lg:col-span-12 mb-2 relative">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-6 border-b border-[#E5E5E5]">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2 text-[#B11226] mb-1">
                            <i data-lucide="cpu" class="w-3 h-3"></i>
                            <span class="text-[10px] font-bold tracking-widest uppercase">Inicializar</span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-semibold tracking-tighter text-[#0F0F0F]">Gênesis</h1>
                        <p class="text-[#666666] text-sm leading-relaxed max-w-md mt-2">Configure os parâmetros do sistema para materializar sua nova realidade.</p>
                    </div>
                </div>
            </div>

            <!-- Left Column: Core Data -->
            <div class="lg:col-span-8 space-y-6">
                
                <!-- Main Form Card -->
                <div class="bg-white rounded-2xl p-6 md:p-8 card-shadow border border-[#E5E5E5]">
                    
                    <div class="space-y-8">
                        <!-- Campaign Title -->
                        <div class="group relative">
                            <label class="block text-[10px] font-bold tracking-widest text-[#666666] uppercase mb-2">Designação da Campanha</label>
                            <?= $this->Form->text('name', [
                                'class' => 'w-full bg-[#FAFAFA] border border-[#E5E5E5] rounded-lg px-4 py-3 text-lg font-medium text-[#0F0F0F] placeholder:text-[#CCCCCC] focus:outline-none focus:border-[#B11226] focus:ring-1 focus:ring-[#B11226] transition-all',
                                'placeholder' => 'Crônicas do Vazio'
                            ]) ?>
                        </div>

                        <!-- Grid: System & Date -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="block text-[10px] font-bold tracking-widest text-[#666666] uppercase mb-2">Sistema Base</label>
                                <div class="relative">
                                    <?= $this->Form->select('system_id', $systems ?? [], [
                                        'empty' => 'Selecione...',
                                        'class' => 'w-full bg-[#FAFAFA] border border-[#E5E5E5] rounded-lg px-4 py-3 text-sm font-medium text-[#0F0F0F] appearance-none focus:outline-none focus:border-[#B11226] focus:ring-1 focus:ring-[#B11226] cursor-pointer hover:bg-[#F5F5F5] transition-colors'
                                    ]) ?>
                                    <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-[#666666] pointer-events-none"></i>
                                </div>
                            </div>
                            
                            <div class="group">
                                <label class="block text-[10px] font-bold tracking-widest text-[#666666] uppercase mb-2">Data de Início</label>
                                <div class="relative">
                                    <?= $this->Form->text('start_date', [
                                        'type' => 'date',
                                        'class' => 'w-full bg-[#FAFAFA] border border-[#E5E5E5] rounded-lg px-4 py-3 text-sm font-medium text-[#0F0F0F] focus:outline-none focus:border-[#B11226] focus:ring-1 focus:ring-[#B11226] cursor-pointer hover:bg-[#F5F5F5]'
                                    ]) ?>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="group">
                            <label class="block text-[10px] font-bold tracking-widest text-[#666666] uppercase mb-2">Sinopse do Mundo</label>
                            <?= $this->Form->textarea('description', [
                                'rows' => 4,
                                'class' => 'w-full bg-[#FAFAFA] border border-[#E5E5E5] rounded-lg px-4 py-3 text-sm text-[#0F0F0F] placeholder:text-[#999999] focus:outline-none focus:border-[#B11226] focus:ring-1 focus:ring-[#B11226] resize-none leading-relaxed',
                                'placeholder' => 'Descreva os parâmetros iniciais da realidade...'
                            ]) ?>
                        </div>
                    </div>
                </div>

                <!-- Settings Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Player Count -->
                    <div class="bg-white rounded-2xl p-6 card-shadow border border-[#E5E5E5] flex flex-col justify-between">
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold tracking-widest text-[#666666] uppercase">Capacidade</span>
                                <span class="text-xs text-[#999999] mt-0.5">Slots de Jogadores</span>
                            </div>
                            <span class="text-2xl font-bold text-[#0F0F0F] font-mono" id="playerValue"><?= h($masterCampaign->max_players ?? 4) ?></span>
                        </div>
                        <input type="range" name="max_players" min="1" max="12" value="<?= h($masterCampaign->max_players ?? 4) ?>" class="w-full" oninput="document.getElementById('playerValue').innerText = this.value.toString().padStart(2, '0')">
                        <div class="flex justify-between text-[10px] text-[#999999] font-mono mt-3 uppercase font-medium">
                            <span>Solo</span>
                            <span>Standard</span>
                            <span>Massive</span>
                        </div>
                    </div>

                    <!-- Visibility Toggle -->
                    <div class="bg-white rounded-2xl p-6 card-shadow border border-[#E5E5E5] flex flex-col justify-center cursor-pointer hover:border-[#CCCCCC] transition-colors">
                        <label class="cursor-pointer h-full flex flex-col justify-center">
                            <input type="hidden" name="is_public" value="0">
                            <input type="checkbox" name="is_public" value="1" class="peer sr-only" <?= !empty($masterCampaign->is_public) ? 'checked' : '' ?>>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-[10px] font-bold tracking-widest text-[#666666] uppercase peer-checked:text-[#0F0F0F]">Visibilidade Pública</span>
                                <div class="w-10 h-5 bg-[#E5E5E5] rounded-full peer-checked:bg-[#B11226] relative transition-colors">
                                    <div class="absolute top-1 left-1 w-3 h-3 bg-white rounded-full shadow-sm transition-transform peer-checked:translate-x-5"></div>
                                </div>
                            </div>
                            <div class="text-xs text-[#999999] leading-relaxed">
                                Indexar esta campanha no Nexus Global para que outros viajantes possam encontrá-la.
                            </div>
                        </label>
                    </div>
                </div>

            </div>

            <!-- Right Column: Visuals & Meta -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Cover Image -->
                <div class="bg-white rounded-2xl p-2 h-64 relative overflow-hidden group card-shadow border border-[#E5E5E5]">
                    <div class="absolute inset-0 z-20 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-white/90 backdrop-blur-sm">
                        <div class="p-3 bg-[#F5F5F5] rounded-full text-[#B11226] mb-2 shadow-sm">
                            <i data-lucide="image-plus" class="w-6 h-6"></i>
                        </div>
                        <span class="text-xs font-bold text-[#0F0F0F] uppercase tracking-wide">Alterar Artefato</span>
                        <?= $this->Form->file('cover_image_file', [
                            'id' => 'coverImageFile',
                            'class' => 'absolute inset-0 w-full h-full cursor-pointer opacity-0',
                            'title' => 'Alterar Capa',
                            'accept' => 'image/jpeg,image/png,image/webp',
                        ]) ?>
                    </div>

                    <div class="w-full h-full rounded-xl overflow-hidden relative bg-[#F5F5F5]">
                        <img id="coverImagePreview" src="<?= h($previewSrc) ?>" class="w-full h-full object-cover grayscale opacity-90 group-hover:scale-105 transition-transform duration-700" alt="Cover preview">
                        <!-- Tag -->
                        <div class="absolute top-3 left-3 bg-white/90 backdrop-blur px-2 py-1 rounded shadow-sm border border-white/50">
                            <span class="text-[10px] font-bold tracking-widest uppercase text-[#0F0F0F]">Cover</span>
                        </div>
                    </div>
                </div>

                <!-- Status Selector -->
                <div class="bg-white rounded-2xl p-2 card-shadow border border-[#E5E5E5]">
                    <div class="bg-[#F5F5F5] p-1 rounded-xl grid grid-cols-3 gap-1 relative">
                        <label class="cursor-pointer relative z-10">
                            <input type="radio" name="status" value="draft" class="tab-radio sr-only" <?= (!empty($masterCampaign->status) && $masterCampaign->status === 'draft') || empty($masterCampaign->status) ? 'checked' : '' ?>>
                            <div class="flex flex-col items-center justify-center py-2.5 rounded-lg text-[#999999] hover:text-[#666666] transition-all">
                                <span class="text-[10px] font-bold tracking-wider uppercase">Draft</span>
                            </div>
                        </label>
                        <label class="cursor-pointer relative z-10">
                            <input type="radio" name="status" value="live" class="tab-radio sr-only" <?= (!empty($masterCampaign->status) && $masterCampaign->status === 'live') ? 'checked' : '' ?>>
                            <div class="flex flex-col items-center justify-center py-2.5 rounded-lg text-[#999999] hover:text-[#666666] transition-all">
                                <span class="text-[10px] font-bold tracking-wider uppercase">Live</span>
                            </div>
                        </label>
                        <label class="cursor-pointer relative z-10">
                            <input type="radio" name="status" value="hold" class="tab-radio sr-only" <?= (!empty($masterCampaign->status) && $masterCampaign->status === 'hold') ? 'checked' : '' ?>>
                            <div class="flex flex-col items-center justify-center py-2.5 rounded-lg text-[#999999] hover:text-[#666666] transition-all">
                                <span class="text-[10px] font-bold tracking-wider uppercase">Hold</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Invite Code Ticket -->
                <div class="bg-white rounded-2xl p-6 relative overflow-hidden card-shadow border border-[#E5E5E5] group">
                    <div class="absolute -right-6 -top-6 w-20 h-20 bg-[#B11226]/5 rounded-full group-hover:bg-[#B11226]/10 transition-colors"></div>
                    
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-[10px] font-bold tracking-widest text-[#666666] uppercase">Chave de Acesso</span>
                        <i data-lucide="copy" class="w-3.5 h-3.5 text-[#CCCCCC] group-hover:text-[#B11226] cursor-pointer transition-colors"></i>
                    </div>
                    
                    <div class="text-center py-2 bg-[#FAFAFA] border border-dashed border-[#E5E5E5] rounded-lg mb-4">
                        <div class="text-2xl font-mono font-bold text-[#0F0F0F] tracking-[0.2em] border-none bg-transparent text-center w-full">
                            <?= h($masterCampaign->invite_code ?? '—') ?>
                        </div>
                        <?= $this->Form->hidden('invite_code') ?>
                    </div>
                    
                    <div class="flex justify-between items-center text-[10px] text-[#999999] uppercase tracking-wide font-medium">
                        <span>Expira: 24h</span>
                        <div class="flex gap-1">
                            <div class="w-1 h-1 rounded-full bg-[#B11226]"></div>
                            <div class="w-1 h-1 rounded-full bg-[#E5E5E5]"></div>
                            <div class="w-1 h-1 rounded-full bg-[#E5E5E5]"></div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Action Footer -->
            <div class="lg:col-span-12 mt-6 pt-6 border-t border-[#E5E5E5] flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-2 text-xs text-[#666666]">
                    <i data-lucide="info" class="w-3.5 h-3.5 text-[#B11226]"></i>
                    <span>Custo de criação: <strong>2 Tokens</strong>. Saldo atual: 14.</span>
                </div>
                
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <button type="button" class="flex-1 sm:flex-none px-6 py-2.5 rounded-xl border border-[#E5E5E5] text-xs font-bold uppercase tracking-widest text-[#666666] hover:bg-[#F5F5F5] hover:text-[#0F0F0F] transition-all bg-white shadow-sm">
                        Cancelar
                    </button>
                    <button type="submit" class="flex-1 sm:flex-none relative group px-8 py-2.5 bg-[#B11226] text-white rounded-xl overflow-hidden hover:bg-[#8E0F1E] shadow-lg shadow-red-900/10 transition-all duration-300">
                        <span class="relative flex items-center justify-center gap-2 text-xs font-bold uppercase tracking-widest">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                            Salvar
                        </span>
                    </button>
                </div>
            </div>

        <?= $this->Form->end() ?>
    </main>

</div>

<?php
// Registrar os assets específicos desta view via blocks do CakePHP.
// O layout deve fazer echo $this->fetch('css') e echo $this->fetch('script') no local adequado.
echo $this->Html->css('master', ['block' => true]);
// Script block to preview uploaded cover image immediately
echo $this->Html->scriptBlock(
    "document.addEventListener('DOMContentLoaded', function(){
        var input = document.getElementById('coverImageFile');
        var preview = document.getElementById('coverImagePreview');
        if(!input || !preview) return;
        input.addEventListener('change', function(){
            var file = this.files && this.files[0];
            if(!file) return;
            var allowed = ['image/jpeg','image/png','image/webp'];
            if(allowed.indexOf(file.type) === -1){
                alert('Tipo de imagem inválido. Use JPG, PNG ou WEBP.');
                this.value = '';
                return;
            }
            var reader = new FileReader();
            reader.onload = function(e){
                preview.src = e.target.result;
                preview.style.filter = 'none';
                preview.style.opacity = '1';
                preview.style.transform = 'scale(1.03)';
            };
            reader.readAsDataURL(file);
        });
    });",
    ['block' => true]
);
?>

