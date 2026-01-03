<?php
$redirect = $this->request->getQuery('redirect');
$formUrl = ['action' => 'login'];
if ($redirect) {
    $formUrl['?'] = ['redirect' => $redirect];
}
?>
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiceRPG - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&amp;display=swap" rel="stylesheet">
    

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6, .brand-font {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        /* Custom scrollbar hiding */
        ::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }
        .cut-image-mask {
            /* This ensures the image corners are rounded against the white background */
            mask-image: radial-gradient(white, black);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
        .message {
            margin-bottom: 1rem;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            font-size: 0.9rem;
        }
        .message.error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .message.success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
    </style>
<link id="all-fonts-link-font-geist" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&amp;display=swap"><style id="all-fonts-style-font-geist">.font-geist { font-family: 'Geist', sans-serif !important; }</style><link id="all-fonts-link-font-roboto" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&amp;display=swap"><style id="all-fonts-style-font-roboto">.font-roboto { font-family: 'Roboto', sans-serif !important; }</style><link id="all-fonts-link-font-montserrat" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&amp;display=swap"><style id="all-fonts-style-font-montserrat">.font-montserrat { font-family: 'Montserrat', sans-serif !important; }</style><link id="all-fonts-link-font-poppins" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap"><style id="all-fonts-style-font-poppins">.font-poppins { font-family: 'Poppins', sans-serif !important; }</style><link id="all-fonts-link-font-playfair" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;900&amp;display=swap"><style id="all-fonts-style-font-playfair">.font-playfair { font-family: 'Playfair Display', serif !important; }</style><link id="all-fonts-link-font-instrument-serif" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Serif:wght@400;500;600;700&amp;display=swap"><style id="all-fonts-style-font-instrument-serif">.font-instrument-serif { font-family: 'Instrument Serif', serif !important; }</style><link id="all-fonts-link-font-merriweather" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700;900&amp;display=swap"><style id="all-fonts-style-font-merriweather">.font-merriweather { font-family: 'Merriweather', serif !important; }</style><link id="all-fonts-link-font-bricolage" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@300;400;500;600;700&amp;display=swap"><style id="all-fonts-style-font-bricolage">.font-bricolage { font-family: 'Bricolage Grotesque', sans-serif !important; }</style><link id="all-fonts-link-font-jakarta" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;display=swap"><style id="all-fonts-style-font-jakarta">.font-jakarta { font-family: 'Plus Jakarta Sans', sans-serif !important; }</style><link id="all-fonts-link-font-manrope" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&amp;display=swap"><style id="all-fonts-style-font-manrope">.font-manrope { font-family: 'Manrope', sans-serif !important; }</style><link id="all-fonts-link-font-space-grotesk" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&amp;display=swap"><style id="all-fonts-style-font-space-grotesk">.font-space-grotesk { font-family: 'Space Grotesk', sans-serif !important; }</style><link id="all-fonts-link-font-work-sans" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;800&amp;display=swap"><style id="all-fonts-style-font-work-sans">.font-work-sans { font-family: 'Work Sans', sans-serif !important; }</style><link id="all-fonts-link-font-pt-serif" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@400;700&amp;display=swap"><style id="all-fonts-style-font-pt-serif">.font-pt-serif { font-family: 'PT Serif', serif !important; }</style><link id="all-fonts-link-font-geist-mono" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@300;400;500;600;700&amp;display=swap"><style id="all-fonts-style-font-geist-mono">.font-geist-mono { font-family: 'Geist Mono', monospace !important; }</style><link id="all-fonts-link-font-space-mono" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&amp;display=swap"><style id="all-fonts-style-font-space-mono">.font-space-mono { font-family: 'Space Mono', monospace !important; }</style><link id="all-fonts-link-font-quicksand" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&amp;display=swap"><style id="all-fonts-style-font-quicksand">.font-quicksand { font-family: 'Quicksand', sans-serif !important; }</style><link id="all-fonts-link-font-nunito" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700;800&amp;display=swap"><style id="all-fonts-style-font-nunito">.font-nunito { font-family: 'Nunito', sans-serif !important; }</style><link id="all-fonts-link-font-newsreader" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Newsreader:opsz,wght@6..72,400..800&amp;display=swap"><style id="all-fonts-style-font-newsreader">.font-newsreader { font-family: 'Newsreader', serif !important; }</style><link id="all-fonts-link-font-google-sans-flex" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Google+Sans+Flex:wght@400;500;600;700&amp;display=swap"><style id="all-fonts-style-font-google-sans-flex">.font-google-sans-flex { font-family: 'Google Sans Flex', sans-serif !important; }</style><link id="all-fonts-link-font-oswald" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&amp;display=swap"><style id="all-fonts-style-font-oswald">.font-oswald { font-family: 'Oswald', sans-serif !important; }</style><link id="all-fonts-link-font-dm-sans" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&amp;display=swap"><style id="all-fonts-style-font-dm-sans">.font-dm-sans { font-family: 'DM Sans', sans-serif !important; }</style></head>
<body class="min-h-screen w-full bg-white text-neutral-800 flex flex-col lg:flex-row overflow-x-hidden">

    <!-- Left Section: Visual/Image -->
    <!-- Added rounded corners on the right side to create the "cut" effect against the white background -->
    <div class="relative w-full lg:w-[45%] h-[400px] lg:h-screen bg-neutral-900 lg:rounded-tr-[60px] lg:rounded-br-[60px] overflow-hidden z-20 shadow-2xl shadow-neutral-200/50 order-first">
        
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&amp;w=2564&amp;auto=format&amp;fit=crop" class="w-full h-full object-cover opacity-90 scale-105 hover:scale-110 transition-transform duration-[3s] ease-in-out" alt="Abstract Landscape">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-black/80"></div>
        </div>

        <!-- Content Overlay -->
        <div class="relative z-10 flex flex-col justify-between h-full p-8 lg:p-12 text-white">
            <!-- Header on Image -->
            <div class="flex justify-between items-center w-full">
                <span class="text-base font-medium tracking-wide text-white/90">Selected Works</span>
                <div class="flex items-center gap-8">
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'register']) ?>" class="text-sm font-medium hover:text-white/80 transition-colors">Sign Up</a>
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'register']) ?>" class="text-xs font-medium border border-white/30 hover:bg-white hover:text-neutral-900 rounded-full px-6 py-2.5 transition-all">
                        Join Us
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Section: Login Form -->
    <div class="lg:w-[55%] min-h-screen flex flex-col animate-fade-in bg-white w-full h-full relative">
        
        <!-- Top Navigation -->
        <div class="w-full p-8 lg:px-16 lg:py-10 flex justify-between items-center">
            <div class="text-xl font-bold tracking-tighter text-neutral-900 flex items-center gap-1 brand-font uppercase">
                DiceRPG
            </div>
            
            <!-- Language Selector -->
            <button class="flex items-center gap-2 px-3 py-1.5 rounded-full border border-neutral-200 text-xs font-medium text-neutral-600 hover:bg-neutral-50 hover:border-neutral-300 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36" class="w-4 h-4 rounded-sm">
                    <path fill="#00247d" d="M0 0h36v36H0z"></path>
                    <path fill="#cf142b" d="M6 0L0 4v6l13 9L0 28v6l6-4 9-13 9 13 6 4v-6l-4-6 10-7v-6l-6-4-13 9-9-13H6z"></path>
                    <path fill="#fff" d="M21 0h-6v15H0v6h15v15h6V21h15v-6H21V0z"></path>
                    <path fill="#cf142b" d="M20 0h-4v16H0v4h16v16h4V20h16v-4H20V0z"></path>
                </svg>
                <span class="ml-1">EN</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-neutral-400">
                    <path d="m6 9 6 6 6-6"></path>
                </svg>
            </button>
        </div>

        <!-- Main Form Area -->
        <div class="flex-1 flex flex-col justify-center px-8 lg:px-24 xl:px-32 w-full max-w-[800px] mx-auto">
            
            <!-- Headings -->
            <div class="text-center mb-10">
                <h1 class="text-4xl lg:text-5xl font-semibold text-neutral-900 tracking-tight mb-3">Welcome back</h1>
                <p class="text-neutral-500 font-normal text-base">Sign in to DiceRPG</p>
            </div>

            <?= $this->Flash->render() ?>

            <!-- Form -->
            <?= $this->Form->create(null, ['url' => $formUrl, 'class' => 'space-y-5 w-full']) ?>
                <?= $this->Form->hidden('redirect', ['value' => $redirect]) ?>
                
                <!-- Email -->
                <div class="space-y-1">
                    <input type="email" id="email" name="email" autocomplete="email" value="<?= h($this->request->getData('email')) ?>" class="block w-full rounded-xl border border-neutral-200 bg-white px-5 py-4 text-base text-neutral-900 placeholder:text-neutral-400 focus:border-neutral-900 focus:ring-0 transition-all duration-200 outline-none" placeholder="Email" required>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <div class="relative">
                        <input type="password" id="password" name="password" autocomplete="current-password" class="block w-full rounded-xl border border-neutral-200 bg-white px-5 py-4 text-base text-neutral-900 placeholder:text-neutral-400 focus:border-neutral-900 focus:ring-0 transition-all duration-200 outline-none" placeholder="Password" required>
                    </div>
                    <div class="flex justify-end">
                        <a href="#" class="text-xs font-medium text-[#ea4c46] hover:text-[#d63f39] transition-colors">
                            Forgot password ?
                        </a>
                    </div>
                </div>

                <!-- Divider -->
                <div class="relative py-3 flex items-center justify-center my-2">
                    <div class="h-px bg-neutral-200 w-12 absolute"></div>
                    <span class="bg-white px-3 text-xs text-neutral-400 relative z-10 italic">or</span>
                </div>

                <!-- Google Login -->
                <button type="button" class="w-full flex items-center justify-center gap-3 bg-white border border-neutral-200 rounded-full py-3.5 text-sm font-medium text-neutral-700 hover:bg-neutral-50 hover:border-neutral-300 transition-all group">
                    <span class="group-hover:text-neutral-900">Login with Google</span>
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M23.5 12.2857C23.5 11.3786 23.4214 10.6571 23.25 9.85715H12V14.3571H18.5714C18.3357 15.8286 17.4786 17.9286 15.6571 19.1786L15.6366 19.3278L19.2618 22.1121L19.5143 22.1429C21.7571 20.0857 23.05 17.0643 23.05 13.5714" fill="#4285F4"></path>
                        <path d="M12 24.5714C15.15 24.5714 17.8143 23.5357 19.7429 21.7643L15.8929 18.8C14.8929 19.4929 13.5929 19.9286 12 19.9286C8.93571 19.9286 6.34285 17.9 5.41428 15.1214L5.27098 15.1332L1.50346 18.0163L1.45714 18.15C3.39285 21.9857 7.37856 24.5714 12 24.5714" fill="#34A853"></path>
                        <path d="M5.41428 15.1214C5.16428 14.3928 5.02142 13.6143 5.02142 12.8214C5.02142 12.0286 5.16428 11.25 5.41428 10.5214L5.40722 10.3621L1.60338 7.43982L1.45714 7.49285C0.52857 9.32142 0 11.3928 0 13.5714C0 15.75 0.52857 17.8214 1.45714 19.65L5.41428 15.1214" fill="#FBBC05"></path>
                        <path d="M12 5.71429C14.15 5.71429 15.6714 6.63572 16.4929 7.40715L19.85 4.05001C17.8071 2.15001 15.15 1.07144 12 1.07144C7.37856 1.07144 3.39285 3.65715 1.45714 7.49286L5.41428 12.0214C6.34285 9.24286 8.93571 5.71429 12 5.71429" fill="#EA4335"></path>
                    </svg>
                </button>

                <!-- Submit Button -->
                <button type="submit" class="w-full rounded-full bg-[#ea4c46] py-3.5 text-base font-semibold text-white shadow-lg shadow-red-500/20 hover:bg-[#d63f39] hover:shadow-red-500/30 active:scale-[0.99] transition-all duration-200 mt-2">
                    Login
                </button>

                <!-- Sign Up Link -->
                <p class="text-center text-xs text-neutral-500 mt-8">
                    Don't have an account? 
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'register']) ?>" class="font-medium text-[#ea4c46] hover:text-[#d63f39] transition-colors">Sign up</a>
                </p>

            <?= $this->Form->end() ?>

            <!-- Footer Socials -->
            <div class="mt-16 flex justify-center gap-8 opacity-70">
                <a href="#" class="text-neutral-400 hover:text-neutral-800 hover:scale-110 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                </a>
                <a href="#" class="text-neutral-400 hover:text-neutral-800 hover:scale-110 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6c2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4c-.9-4.2 4-6.6 7-3.8c1.1 0 3-1.2 3-1.2"></path></svg>
                </a>
                <a href="#" class="text-neutral-400 hover:text-neutral-800 hover:scale-110 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2a2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect width="4" height="12" x="2" y="9"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                </a>
                <a href="#" class="text-neutral-400 hover:text-neutral-800 hover:scale-110 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path></svg></a></div></div></div></body></html>
