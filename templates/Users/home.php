<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiceRPG - Home</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <?= $this->Html->css('home') ?>
</head>
<body class="antialiased bg-stone-50 text-stone-800 selection:bg-indigo-100 selection:text-indigo-900">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 top-0 transition-all duration-300 glass-panel border-b border-stone-200/50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-2 group">
                <div class="relative w-8 h-8 flex items-center justify-center bg-indigo-900 rounded-lg text-white shadow-md group-hover:rotate-12 transition-transform duration-300">
                    <i data-lucide="dices" class="w-5 h-5"></i>
                </div>
                <span class="font-serif font-semibold text-xl tracking-tight text-stone-900">DiceRPG</span>
            </a>

            <!-- Desktop Links -->
            <div class="hidden lg:flex items-center gap-6 text-sm font-medium text-stone-600">
                <a href="#home" class="hover:text-indigo-700 transition-colors">Home</a>
                <a href="#about" class="hover:text-indigo-700 transition-colors">About</a>
                <a href="#features" class="hover:text-indigo-700 transition-colors">Features</a>
                <a href="#community" class="hover:text-indigo-700 transition-colors">Community</a>
                <a href="#marketplace" class="hover:text-indigo-700 transition-colors">Marketplace</a>
                <div class="h-4 w-px bg-stone-300"></div>
                <a href="#player" class="hover:text-indigo-700 transition-colors">Player</a>
                <a href="#gamemaster" class="hover:text-indigo-700 transition-colors">Game Master</a>
            </div>

            <!-- CTA -->
            <div class="flex items-center gap-4">
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>" class="hidden md:block text-sm font-medium text-stone-600 hover:text-indigo-900">Log in</a>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>" class="px-5 py-2.5 bg-indigo-900 text-white text-sm font-medium rounded-lg shadow-lg shadow-indigo-900/20 hover:bg-indigo-800 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-2">
                    <span>Enter Platform</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden">
        <!-- Background Layers (Parallax simulated via CSS animation/position) -->
        <div class="absolute inset-0 bg-gradient-to-b from-sky-100 via-orange-50 to-stone-50 opacity-60 z-0"></div>
        
        <!-- Animated Abstract Orbs -->
        <div class="absolute top-1/4 left-10 w-64 h-64 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-float-delayed"></div>
        <div class="absolute top-1/3 right-10 w-72 h-72 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-float"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 w-full grid lg:grid-cols-2 gap-12 items-center">
            
            <!-- Left Content -->
            <div class="space-y-8 reveal">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-800 text-xs font-medium">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    v2.0 is now live
                </div>
                
                <h1 class="text-5xl lg:text-7xl font-serif font-semibold text-stone-900 leading-[1.1] tracking-tight">
                    Roll, Create, and <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 to-purple-600">Explore</span>
                </h1>
                
                <p class="text-lg lg:text-xl text-stone-600 max-w-lg leading-relaxed">
                    The modern tabletop hub for adventurers and storytellers. Combine the nostalgia of pen-and-paper with powerful digital tools.
                </p>
                
                <div class="flex flex-wrap items-center gap-4">
                    <button class="px-8 py-3.5 bg-stone-900 text-white rounded-xl font-medium shadow-xl hover:bg-stone-800 hover:-translate-y-1 transition-all flex items-center gap-2">
                        <i data-lucide="swords" class="w-5 h-5"></i>
                        Start Your Adventure
                    </button>
                    <button class="px-8 py-3.5 bg-white text-stone-700 border border-stone-200 rounded-xl font-medium hover:bg-stone-50 transition-all flex items-center gap-2 shadow-sm">
                        <i data-lucide="play-circle" class="w-5 h-5 text-stone-400"></i>
                        Watch Demo
                    </button>
                </div>

                <!-- Social Proof / Stats -->
                <div class="pt-6 flex items-center gap-6 text-stone-500 text-sm">
                    <div class="flex -space-x-3">
                        <div class="w-8 h-8 rounded-full bg-stone-300 border-2 border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-stone-400 border-2 border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-stone-500 border-2 border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-stone-200 border-2 border-white flex items-center justify-center text-xs font-bold text-stone-600">+2k</div>
                    </div>
                    <p>Active campaigns today</p>
                </div>
            </div>

            <!-- Right Content: Abstract Illustration -->
            <div class="relative lg:h-[600px] flex items-center justify-center reveal">
                <!-- Decorative Circle -->
                <div class="absolute inset-0 bg-gradient-to-tr from-indigo-50 to-stone-100 rounded-full scale-90 opacity-50 animate-spin-slow border border-dashed border-stone-300"></div>
                
                <!-- Floating Cards / Elements -->
                <div class="relative z-10 w-full max-w-md">
                    <div class="glass-panel p-6 rounded-2xl shadow-2xl border border-white/60 transform rotate-[-3deg] animate-float">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700">
                                    <i data-lucide="shield" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h3 class="font-serif font-semibold text-stone-900">Eldric the Bold</h3>
                                    <p class="text-xs text-stone-500">Level 5 Paladin</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="block text-xs text-stone-400 uppercase tracking-wider">HP</span>
                                <span class="text-emerald-600 font-bold">42 / 45</span>
                            </div>
                        </div>
                        <div class="h-2 bg-stone-100 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-500 w-[92%] rounded-full"></div>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <span class="px-2 py-1 bg-stone-100 rounded text-xs text-stone-600">Strength +3</span>
                            <span class="px-2 py-1 bg-stone-100 rounded text-xs text-stone-600">Charisma +2</span>
                        </div>
                    </div>

                    <div class="glass-panel p-4 rounded-xl shadow-xl border border-white/60 absolute -bottom-10 -right-4 w-48 transform rotate-[3deg] animate-float-delayed">
                        <div class="flex items-center gap-3 mb-2">
                             <i data-lucide="scroll" class="w-5 h-5 text-amber-600"></i>
                             <span class="text-sm font-semibold text-stone-800">New Quest</span>
                        </div>
                        <p class="text-xs text-stone-500 leading-snug">Explore the Whispering Woods and retrieve the Lost Amulet.</p>
                    </div>

                    <!-- Floating Dice -->
                    <div class="absolute -top-10 right-10 text-indigo-900/20 animate-bounce">
                        <i data-lucide="dices" class="w-16 h-16"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Fade bottom -->
        <div class="absolute bottom-0 w-full h-24 bg-gradient-to-t from-stone-50 to-transparent"></div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-stone-50 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="reveal">
                    <span class="text-indigo-600 font-medium tracking-wide text-sm uppercase">Our Philosophy</span>
                    <h2 class="text-3xl md:text-4xl font-serif font-semibold mt-2 mb-6 text-stone-900 tracking-tight">What is DiceRPG?</h2>
                    <p class="text-lg text-stone-600 mb-6 leading-relaxed">
                        We are a platform built for the modern storyteller. Whether you are delving into dungeons remotely or rolling physical dice at a local table, DiceRPG provides the digital grimoire you need to manage your world.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4 group">
                            <div class="p-2 bg-white border border-stone-200 shadow-sm rounded-lg group-hover:border-indigo-200 transition-colors">
                                <i data-lucide="users" class="w-5 h-5 text-indigo-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-stone-800">Community First</h4>
                                <p class="text-stone-500 text-sm mt-1">Built around shared storytelling and collaborative world-building.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 group">
                            <div class="p-2 bg-white border border-stone-200 shadow-sm rounded-lg group-hover:border-indigo-200 transition-colors">
                                <i data-lucide="wand-2" class="w-5 h-5 text-purple-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-stone-800">Powerful Tools</h4>
                                <p class="text-stone-500 text-sm mt-1">Advanced character builders, map editors, and encounter trackers.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Illustration Card -->
                <div class="reveal relative">
                    <div class="absolute inset-0 bg-indigo-900/5 rounded-2xl transform translate-x-4 translate-y-4"></div>
                    <div class="relative bg-white border border-stone-200 rounded-2xl p-2 shadow-lg overflow-hidden h-[400px]">
                        <div class="absolute top-0 left-0 w-full h-full bg-stone-100 flex items-center justify-center overflow-hidden">
                             <!-- Simulated stylized village/map UI -->
                             <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
                             <div class="w-3/4 h-3/4 border-2 border-dashed border-stone-300 rounded-lg flex items-center justify-center flex-col gap-4">
                                <i data-lucide="map" class="w-12 h-12 text-stone-300"></i>
                                <span class="text-stone-400 font-serif text-sm">World Map Visualization</span>
                             </div>
                             <!-- Floating Elements -->
                             <div class="absolute top-10 left-10 p-3 bg-white shadow-lg rounded-lg border border-stone-100 animate-drift">
                                 <i data-lucide="castle" class="w-6 h-6 text-stone-700"></i>
                             </div>
                             <div class="absolute bottom-20 right-10 p-3 bg-white shadow-lg rounded-lg border border-stone-100 animate-drift" style="animation-delay: 2s;">
                                 <i data-lucide="tent" class="w-6 h-6 text-stone-700"></i>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section id="features" class="py-24 bg-white border-y border-stone-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16 reveal">
                <h2 class="text-3xl md:text-4xl font-serif font-semibold text-stone-900 tracking-tight mb-4">Features for Your Campaigns</h2>
                <p class="text-stone-500 text-lg">Everything you need to run a seamless session, from character creation to combat resolution.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="reveal group p-6 rounded-2xl border border-stone-200 bg-stone-50/50 hover:bg-white card-hover">
                    <div class="w-12 h-12 bg-orange-100 text-orange-700 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="file-text" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-semibold text-lg text-stone-900 mb-2">Dynamic Character Sheets</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">Auto-calculating stats, inventory management, and customizable layouts for any system.</p>
                </div>

                <!-- Card 2 -->
                <div class="reveal group p-6 rounded-2xl border border-stone-200 bg-stone-50/50 hover:bg-white card-hover delay-100">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-700 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="dices" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-semibold text-lg text-stone-900 mb-2">3D Dice Roller</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">Physics-based rolling with custom skins, secret rolls, and complex formula support.</p>
                </div>

                <!-- Card 3 -->
                <div class="reveal group p-6 rounded-2xl border border-stone-200 bg-stone-50/50 hover:bg-white card-hover delay-200">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="map" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-semibold text-lg text-stone-900 mb-2">Interactive Maps</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">Fog of war, grid snapping, and dynamic lighting for immersive dungeon crawling.</p>
                </div>

                <!-- Card 4 -->
                <div class="reveal group p-6 rounded-2xl border border-stone-200 bg-stone-50/50 hover:bg-white card-hover">
                    <div class="w-12 h-12 bg-red-100 text-red-700 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="skull" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-semibold text-lg text-stone-900 mb-2">Monster Bestiary</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">Thousands of pre-loaded creatures. Drag and drop them directly into encounters.</p>
                </div>

                <!-- Card 5 -->
                <div class="reveal group p-6 rounded-2xl border border-stone-200 bg-stone-50/50 hover:bg-white card-hover delay-100">
                    <div class="w-12 h-12 bg-purple-100 text-purple-700 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="book-open" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-semibold text-lg text-stone-900 mb-2">Lore Wiki</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">Organize your world's history, NPCs, and locations in a linked, searchable database.</p>
                </div>

                <!-- Card 6 -->
                <div class="reveal group p-6 rounded-2xl border border-stone-200 bg-stone-50/50 hover:bg-white card-hover delay-200">
                    <div class="w-12 h-12 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="message-circle" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-semibold text-lg text-stone-900 mb-2">Video & Voice</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">Built-in low latency communication so you never miss a dramatic moment.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Community Section -->
    <section id="community" class="py-24 bg-stone-50 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10 pointer-events-none">
            <div class="absolute top-10 left-10 w-32 h-32 bg-indigo-300 rounded-full mix-blend-multiply filter blur-2xl animate-float"></div>
            <div class="absolute bottom-10 right-10 w-64 h-64 bg-amber-200 rounded-full mix-blend-multiply filter blur-3xl animate-float-delayed"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-3 gap-12">
            <div class="lg:col-span-1 reveal">
                <h2 class="text-3xl font-serif font-semibold text-stone-900 tracking-tight mb-4">Community & News</h2>
                <p class="text-stone-600 mb-6">Stay updated with the latest features, developer logs, and community spotlight events.</p>
                
                <div class="flex items-center gap-2 mb-8">
                    <div class="flex -space-x-2">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Felix" alt="User" class="w-10 h-10 rounded-full border-2 border-stone-50 bg-white">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Aneka" alt="User" class="w-10 h-10 rounded-full border-2 border-stone-50 bg-white">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Bob" alt="User" class="w-10 h-10 rounded-full border-2 border-stone-50 bg-white">
                    </div>
                    <span class="text-sm font-medium text-stone-500">Join 50k+ storytellers</span>
                </div>

                <a href="#" class="text-indigo-700 font-medium hover:text-indigo-900 inline-flex items-center gap-1">
                    Visit the Forums <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <div class="lg:col-span-2 grid gap-6">
                <!-- News Card 1 -->
                <div class="reveal bg-white p-6 rounded-xl border border-stone-200 shadow-sm hover:shadow-md transition-shadow flex flex-col md:flex-row gap-6 items-start">
                    <div class="w-full md:w-48 h-32 bg-stone-100 rounded-lg flex items-center justify-center text-stone-300 shrink-0">
                        <i data-lucide="newspaper" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-2 py-0.5 rounded-md bg-emerald-100 text-emerald-800 text-xs font-semibold">Update</span>
                            <span class="text-stone-400 text-xs">Oct 24, 2023</span>
                        </div>
                        <h3 class="font-semibold text-lg text-stone-900 mb-2">The Great Library Update</h3>
                        <p class="text-stone-500 text-sm">Introducing cross-referencing for all lore entries, improved search, and exportable PDFs for your campaign notes.</p>
                    </div>
                </div>
                
                <!-- News Card 2 -->
                <div class="reveal bg-white p-6 rounded-xl border border-stone-200 shadow-sm hover:shadow-md transition-shadow flex flex-col md:flex-row gap-6 items-start delay-100">
                    <div class="w-full md:w-48 h-32 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-200 shrink-0">
                        <i data-lucide="calendar" class="w-8 h-8"></i>
                    </div>
                    <div>
                         <div class="flex items-center gap-2 mb-2">
                            <span class="px-2 py-0.5 rounded-md bg-purple-100 text-purple-800 text-xs font-semibold">Event</span>
                            <span class="text-stone-400 text-xs">Nov 01, 2023</span>
                        </div>
                        <h3 class="font-semibold text-lg text-stone-900 mb-2">Weekly One-Shot: "The Silent Tower"</h3>
                        <p class="text-stone-500 text-sm">Join our official Game Masters for a spooky Halloween special. Beginners welcome! Sign ups open now.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Marketplace Section (Toggle) -->
    <section id="marketplace" class="py-24 bg-stone-900 text-stone-100 relative overflow-hidden">
        <!-- Subtle parallax background detail -->
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/dark-matter.png')]"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-12 reveal">
                <h2 class="text-3xl md:text-4xl font-serif font-semibold tracking-tight mb-6">The Marketplace</h2>
                
                <!-- Toggle Control -->
                <div class="inline-flex p-1 bg-stone-800 rounded-lg border border-stone-700" id="market-toggle">
                    <button onclick="switchMarket('player')" id="btn-player" class="px-6 py-2 rounded-md text-sm font-medium bg-stone-600 text-white shadow transition-all">
                        For Players
                    </button>
                    <button onclick="switchMarket('gm')" id="btn-gm" class="px-6 py-2 rounded-md text-sm font-medium text-stone-400 hover:text-white transition-all">
                        For Game Masters
                    </button>
                </div>
            </div>

            <!-- Player Content -->
            <div id="content-player" class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 reveal">
                <!-- Item -->
                <div class="bg-stone-800 border border-stone-700 rounded-xl p-4 hover:border-stone-500 hover:-translate-y-2 transition-all group">
                    <div class="h-40 bg-stone-900 rounded-lg mb-4 flex items-center justify-center">
                        <i data-lucide="user" class="w-10 h-10 text-stone-600 group-hover:text-indigo-400 transition-colors"></i>
                    </div>
                    <h4 class="font-medium mb-1">Hero Pack: Rogue</h4>
                    <p class="text-xs text-stone-400">Portraits & Tokens</p>
                </div>
                <!-- Item -->
                <div class="bg-stone-800 border border-stone-700 rounded-xl p-4 hover:border-stone-500 hover:-translate-y-2 transition-all group">
                    <div class="h-40 bg-stone-900 rounded-lg mb-4 flex items-center justify-center">
                        <i data-lucide="gem" class="w-10 h-10 text-stone-600 group-hover:text-emerald-400 transition-colors"></i>
                    </div>
                    <h4 class="font-medium mb-1">Obsidian Dice</h4>
                    <p class="text-xs text-stone-400">3D Dice Skin</p>
                </div>
                <!-- Item -->
                <div class="bg-stone-800 border border-stone-700 rounded-xl p-4 hover:border-stone-500 hover:-translate-y-2 transition-all group">
                    <div class="h-40 bg-stone-900 rounded-lg mb-4 flex items-center justify-center">
                        <i data-lucide="shirt" class="w-10 h-10 text-stone-600 group-hover:text-amber-400 transition-colors"></i>
                    </div>
                    <h4 class="font-medium mb-1">Cloak of Shadows</h4>
                    <p class="text-xs text-stone-400">Item Card Art</p>
                </div>
                <!-- Item -->
                <div class="bg-stone-800 border border-stone-700 rounded-xl p-4 hover:border-stone-500 hover:-translate-y-2 transition-all group">
                    <div class="h-40 bg-stone-900 rounded-lg mb-4 flex items-center justify-center">
                        <i data-lucide="sparkles" class="w-10 h-10 text-stone-600 group-hover:text-pink-400 transition-colors"></i>
                    </div>
                    <h4 class="font-medium mb-1">Spell Effects</h4>
                    <p class="text-xs text-stone-400">Animation Bundle</p>
                </div>
            </div>

            <!-- GM Content (Hidden by default) -->
            <div id="content-gm" class="hidden grid md:grid-cols-2 lg:grid-cols-4 gap-6 reveal">
                <!-- Item -->
                <div class="bg-stone-800 border border-stone-700 rounded-xl p-4 hover:border-stone-500 hover:-translate-y-2 transition-all group">
                    <div class="h-40 bg-stone-900 rounded-lg mb-4 flex items-center justify-center">
                        <i data-lucide="scroll-text" class="w-10 h-10 text-stone-600 group-hover:text-indigo-400 transition-colors"></i>
                    </div>
                    <h4 class="font-medium mb-1">Curse of Strahd</h4>
                    <p class="text-xs text-stone-400">Adventure Module</p>
                </div>
                <!-- Item -->
                <div class="bg-stone-800 border border-stone-700 rounded-xl p-4 hover:border-stone-500 hover:-translate-y-2 transition-all group">
                    <div class="h-40 bg-stone-900 rounded-lg mb-4 flex items-center justify-center">
                        <i data-lucide="map" class="w-10 h-10 text-stone-600 group-hover:text-emerald-400 transition-colors"></i>
                    </div>
                    <h4 class="font-medium mb-1">Forest Battlemaps</h4>
                    <p class="text-xs text-stone-400">50+ High Res Maps</p>
                </div>
                <!-- Item -->
                <div class="bg-stone-800 border border-stone-700 rounded-xl p-4 hover:border-stone-500 hover:-translate-y-2 transition-all group">
                    <div class="h-40 bg-stone-900 rounded-lg mb-4 flex items-center justify-center">
                        <i data-lucide="ghost" class="w-10 h-10 text-stone-600 group-hover:text-red-400 transition-colors"></i>
                    </div>
                    <h4 class="font-medium mb-1">Undead Horde</h4>
                    <p class="text-xs text-stone-400">Monster Token Pack</p>
                </div>
                <!-- Item -->
                <div class="bg-stone-800 border border-stone-700 rounded-xl p-4 hover:border-stone-500 hover:-translate-y-2 transition-all group">
                    <div class="h-40 bg-stone-900 rounded-lg mb-4 flex items-center justify-center">
                        <i data-lucide="music" class="w-10 h-10 text-stone-600 group-hover:text-blue-400 transition-colors"></i>
                    </div>
                    <h4 class="font-medium mb-1">Tavern Ambience</h4>
                    <p class="text-xs text-stone-400">Soundscapes</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Player Section -->
    <section id="player" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
            <div class="reveal order-2 lg:order-1">
                 <!-- Step UI -->
                 <div class="space-y-8 relative">
                     <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-stone-100"></div>
                     
                     <div class="relative flex gap-6">
                         <div class="w-12 h-12 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 z-10 shrink-0 font-serif font-bold">1</div>
                         <div>
                             <h3 class="text-xl font-semibold text-stone-900 mb-2">Create Your Character</h3>
                             <p class="text-stone-500">Choose from 12+ systems. Use our drag-and-drop builder to craft your hero in minutes.</p>
                         </div>
                     </div>
                     
                     <div class="relative flex gap-6">
                         <div class="w-12 h-12 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 z-10 shrink-0 font-serif font-bold">2</div>
                         <div>
                             <h3 class="text-xl font-semibold text-stone-900 mb-2">Find a Party</h3>
                             <p class="text-stone-500">Browse the "Looking for Group" listings. Filter by time zone, language, and playstyle.</p>
                         </div>
                     </div>
                     
                     <div class="relative flex gap-6">
                         <div class="w-12 h-12 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 z-10 shrink-0 font-serif font-bold">3</div>
                         <div>
                             <h3 class="text-xl font-semibold text-stone-900 mb-2">Track Progress</h3>
                             <p class="text-stone-500">Your character evolves. We track XP, inventory changes, and journal entries automatically.</p>
                         </div>
                     </div>
                 </div>

                 <div class="mt-10">
                     <button class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-medium shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all">
                         Start as a Player
                     </button>
                 </div>
            </div>
            <div class="reveal order-1 lg:order-2">
                <span class="text-indigo-600 font-medium tracking-wide text-sm uppercase">For Players</span>
                <h2 class="text-4xl font-serif font-semibold mt-2 mb-6 text-stone-900 tracking-tight">Your Legend Begins Here</h2>
                <p class="text-lg text-stone-600 leading-relaxed">
                    Focus on roleplaying, not math. Our player tools are designed to be invisible when you don't need them and powerful when you do.
                </p>
                <div class="mt-8 p-6 bg-indigo-50 rounded-2xl border border-indigo-100">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm">
                            <i data-lucide="sword" class="w-6 h-6 text-indigo-600"></i>
                        </div>
                        <div>
                            <div class="text-sm font-bold text-indigo-900">Inventory Updated</div>
                            <div class="text-xs text-indigo-700">You received "Blade of Aethelgard"</div>
                        </div>
                    </div>
                    <div class="h-2 bg-indigo-200 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-500 w-2/3"></div>
                    </div>
                    <div class="flex justify-between mt-2 text-xs text-indigo-800 font-medium">
                        <span>Level 4</span>
                        <span>1,250 / 3,000 XP</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GM Section -->
    <section id="gamemaster" class="py-24 bg-stone-50">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
            <div class="reveal">
                <span class="text-emerald-700 font-medium tracking-wide text-sm uppercase">For Game Masters</span>
                <h2 class="text-4xl font-serif font-semibold mt-2 mb-6 text-stone-900 tracking-tight">Command the Narrative</h2>
                <p class="text-lg text-stone-600 leading-relaxed mb-8">
                    Organize your campaigns with god-like efficiency. Keep secrets, manage combat flow, and improvise with intelligent random generators.
                </p>
                
                <button class="px-6 py-3 bg-stone-800 text-white rounded-lg font-medium shadow-lg hover:bg-stone-700 transition-all">
                    Start as a Game Master
                </button>
            </div>
            
            <!-- GM Dashboard Mockup -->
            <div class="reveal relative">
                <div class="absolute -inset-2 bg-gradient-to-r from-emerald-100 to-stone-200 rounded-2xl blur-lg opacity-50"></div>
                <div class="relative bg-white border border-stone-200 rounded-xl shadow-xl overflow-hidden">
                    <!-- Fake Toolbar -->
                    <div class="h-10 bg-stone-100 border-b border-stone-200 flex items-center px-4 gap-3">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
                        <div class="ml-auto text-xs text-stone-400 font-medium">GM View</div>
                    </div>
                    <!-- Content -->
                    <div class="p-6 grid grid-cols-2 gap-4">
                         <div class="col-span-2 p-3 bg-stone-50 rounded border border-stone-100 flex justify-between items-center">
                             <span class="text-sm font-semibold text-stone-700">Encounter: Goblin Ambush</span>
                             <span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded">Combat Active</span>
                         </div>
                         <!-- Stat block mini -->
                         <div class="p-3 bg-white border border-stone-200 rounded shadow-sm">
                             <div class="flex justify-between items-center mb-2">
                                 <span class="text-xs font-bold text-stone-800">Goblin Boss</span>
                                 <i data-lucide="skull" class="w-3 h-3 text-stone-400"></i>
                             </div>
                             <div class="w-full bg-stone-100 h-1.5 rounded-full mb-1">
                                 <div class="bg-red-500 h-1.5 rounded-full w-1/2"></div>
                             </div>
                             <div class="text-[10px] text-stone-400">HP: 15/30</div>
                         </div>
                         <!-- Stat block mini -->
                         <div class="p-3 bg-white border border-stone-200 rounded shadow-sm">
                             <div class="flex justify-between items-center mb-2">
                                 <span class="text-xs font-bold text-stone-800">Minion A</span>
                                 <i data-lucide="skull" class="w-3 h-3 text-stone-400"></i>
                             </div>
                             <div class="w-full bg-stone-100 h-1.5 rounded-full mb-1">
                                 <div class="bg-red-500 h-1.5 rounded-full w-[10%]"></div>
                             </div>
                             <div class="text-[10px] text-stone-400">HP: 1/7</div>
                         </div>
                         
                         <div class="col-span-2 p-3 bg-amber-50 border border-amber-100 rounded text-xs text-amber-900">
                             <strong>Secret Note:</strong> The bridge is rigged to collapse if more than 2 creatures cross at once.
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team & History -->
    <section id="team" class="py-24 bg-white border-t border-stone-100">
        <div class="max-w-7xl mx-auto px-6">
             <div class="text-center mb-16 reveal">
                <h2 class="text-3xl md:text-4xl font-serif font-semibold text-stone-900 tracking-tight">Our Journey</h2>
            </div>
            
            <div class="relative">
                <!-- Timeline Line -->
                <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-px bg-stone-200"></div>

                <div class="space-y-12">
                    <!-- Item 1 -->
                    <div class="relative flex items-center justify-between reveal">
                        <div class="w-5/12 text-right pr-8">
                            <h4 class="text-xl font-serif font-semibold text-stone-800">The Spark</h4>
                            <p class="text-stone-500 text-sm mt-2">A prototype built during a weekend hackathon for a local D&D group.</p>
                            <span class="text-indigo-600 text-xs font-bold mt-2 block">2020</span>
                        </div>
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-white border-4 border-indigo-600 rounded-full z-10"></div>
                        <div class="w-5/12 pl-8"></div>
                    </div>
                    
                    <!-- Item 2 -->
                    <div class="relative flex items-center justify-between reveal">
                        <div class="w-5/12 pr-8"></div>
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-white border-4 border-stone-400 rounded-full z-10"></div>
                        <div class="w-5/12 pl-8 text-left">
                            <h4 class="text-xl font-serif font-semibold text-stone-800">Beta Launch</h4>
                            <p class="text-stone-500 text-sm mt-2">Opened to 500 users. The dice physics engine was perfected.</p>
                             <span class="text-indigo-600 text-xs font-bold mt-2 block">2021</span>
                        </div>
                    </div>

                     <!-- Item 3 -->
                    <div class="relative flex items-center justify-between reveal">
                        <div class="w-5/12 text-right pr-8">
                             <h4 class="text-xl font-serif font-semibold text-stone-800">Global Release</h4>
                            <p class="text-stone-500 text-sm mt-2">DiceRPG v1.0 goes live. Marketplace opens for creators.</p>
                             <span class="text-indigo-600 text-xs font-bold mt-2 block">2022</span>
                        </div>
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-white border-4 border-stone-400 rounded-full z-10"></div>
                        <div class="w-5/12 pl-8"></div>
                    </div>
                </div>
            </div>

            <!-- Team Cards -->
            <div class="grid md:grid-cols-3 gap-8 mt-20">
                <div class="text-center reveal">
                    <div class="w-20 h-20 mx-auto bg-stone-200 rounded-full mb-4 overflow-hidden">
                         <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Felix" alt="Dev" class="w-full h-full object-cover">
                    </div>
                    <h5 class="font-semibold text-stone-900">Alex Mercer</h5>
                    <p class="text-xs text-stone-500 uppercase tracking-widest">Systems Alchemist</p>
                </div>
                <div class="text-center reveal delay-100">
                    <div class="w-20 h-20 mx-auto bg-stone-200 rounded-full mb-4 overflow-hidden">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Sarah" alt="Dev" class="w-full h-full object-cover">
                    </div>
                    <h5 class="font-semibold text-stone-900">Sarah Vance</h5>
                    <p class="text-xs text-stone-500 uppercase tracking-widest">Lore Keeper</p>
                </div>
                <div class="text-center reveal delay-200">
                    <div class="w-20 h-20 mx-auto bg-stone-200 rounded-full mb-4 overflow-hidden">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Jules" alt="Dev" class="w-full h-full object-cover">
                    </div>
                    <h5 class="font-semibold text-stone-900">Jules Verne</h5>
                    <p class="text-xs text-stone-500 uppercase tracking-widest">Map Cartographer</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Table Rules -->
    <section id="rules" class="py-24 bg-stone-50">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-serif font-semibold text-stone-900 mb-8 reveal">Table Rules & Conduct</h2>
            <p class="text-stone-600 mb-12 reveal">To ensure every adventure is enjoyable, we uphold a strict code of honor.</p>
            
            <div class="grid sm:grid-cols-2 gap-6 reveal">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-stone-200 text-left flex gap-4">
                    <i data-lucide="shield-check" class="w-6 h-6 text-emerald-600 shrink-0"></i>
                    <div>
                        <h4 class="font-semibold text-stone-800">Safety Tools</h4>
                        <p class="text-sm text-stone-500 mt-1">Integrated X-Cards and Lines & Veils in every session.</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-stone-200 text-left flex gap-4">
                    <i data-lucide="heart-handshake" class="w-6 h-6 text-red-500 shrink-0"></i>
                    <div>
                        <h4 class="font-semibold text-stone-800">Respect & Inclusion</h4>
                        <p class="text-sm text-stone-500 mt-1">Zero tolerance for harassment or hate speech.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact & Footer -->
    <footer class="bg-stone-900 text-stone-400 py-16 border-t-4 border-indigo-900 relative">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Contact Form Area -->
            <div class="grid lg:grid-cols-2 gap-16 mb-16 border-b border-stone-800 pb-16">
                <div>
                    <h3 class="text-2xl font-serif font-semibold text-white mb-4">Get in Touch</h3>
                    <p class="mb-6">Have a question about the platform or a feature request? Send us a raven.</p>
                    <div class="flex gap-4">
                        <a href="#" class="text-stone-400 hover:text-white transition-colors"><i data-lucide="twitter" class="w-5 h-5"></i></a>
                        <a href="#" class="text-stone-400 hover:text-white transition-colors"><i data-lucide="github" class="w-5 h-5"></i></a>
                        <a href="#" class="text-stone-400 hover:text-white transition-colors"><i data-lucide="youtube" class="w-5 h-5"></i></a>
                    </div>
                </div>
                <form class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" placeholder="Name" class="bg-stone-800 border border-stone-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-indigo-500 text-sm">
                        <input type="email" placeholder="Email" class="bg-stone-800 border border-stone-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-indigo-500 text-sm">
                    </div>
                    <textarea rows="3" placeholder="Message" class="w-full bg-stone-800 border border-stone-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-indigo-500 text-sm"></textarea>
                    <button class="bg-indigo-700 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-indigo-600 transition-colors">Send Message</button>
                </form>
            </div>

            <!-- Links -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-2">
                    <i data-lucide="dices" class="w-6 h-6 text-indigo-500"></i>
                    <span class="font-serif font-semibold text-white text-lg">DiceRPG</span>
                </div>
                <div class="flex gap-8 text-sm">
                    <a href="#" class="hover:text-white transition-colors">Privacy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms</a>
                    <a href="#" class="hover:text-white transition-colors">Status</a>
                </div>
                <div class="text-xs text-stone-600">
                    &copy; 2023 DiceRPG Inc. All rights reserved.
                </div>
            </div>
        </div>
        <!-- Tiny animated rune border detail -->
        <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-stone-900 via-indigo-900 to-stone-900 opacity-50"></div>
    </footer>

    <?= $this->Html->script('home') ?>
</body>
</html>
