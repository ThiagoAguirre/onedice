<?php
/** @var \App\View\AppView $this */
/** @var \App\Model\Entity\User $user */
$loginUrl = $this->Url->build(['controller' => 'Users', 'action' => 'login']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiceRPG - Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Manrope:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --font-serif: 'Cinzel', serif;
            --font-sans: 'Manrope', sans-serif;
            --ink: #1f2937;
            --accent: #0f766e;
            --accent-strong: #115e59;
            --accent-soft: rgba(15, 118, 110, 0.12);
            --gold: #b45309;
            --surface: rgba(255, 255, 255, 0.86);
        }
        body {
            font-family: var(--font-sans);
            color: var(--ink);
        }
        h1, h2, h3 {
            font-family: var(--font-serif);
        }
        .glass-card {
            background: var(--surface);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }
        .btn-primary {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 12px 30px -15px rgba(15, 118, 110, 0.55);
        }
        .btn-primary:hover {
            background: var(--accent-strong);
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
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-18px); }
        }
        @keyframes drift {
            0% { transform: translateX(0) translateY(0); opacity: 0.35; }
            50% { transform: translateX(12px) translateY(-16px); opacity: 0.7; }
            100% { transform: translateX(0) translateY(0); opacity: 0.35; }
        }
        .animate-float {
            animation: float 9s ease-in-out infinite;
        }
        .animate-drift {
            animation: drift 12s ease-in-out infinite;
        }
        .pattern-grid {
            background-image:
                radial-gradient(circle at 1px 1px, rgba(15, 23, 42, 0.06) 1px, transparent 0);
            background-size: 28px 28px;
        }
    </style>
</head>
<body class="min-h-screen bg-slate-50">
    <div class="relative min-h-screen overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-amber-50 via-stone-50 to-emerald-50"></div>
        <div class="absolute inset-0 pattern-grid opacity-50"></div>
        <div class="absolute -top-24 -left-16 h-64 w-64 rounded-full bg-amber-200/50 blur-3xl animate-float"></div>
        <div class="absolute bottom-0 right-0 h-72 w-72 rounded-full bg-emerald-200/50 blur-3xl animate-drift"></div>

        <div class="relative z-10 max-w-6xl mx-auto px-6 py-12 lg:py-20 grid lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-8">
                <div class="inline-flex items-center gap-3 rounded-full border border-emerald-200/70 bg-white/70 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-emerald-700">
                    New campaign access
                    <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                </div>
                <div class="space-y-4">
                    <h1 class="text-4xl lg:text-5xl font-semibold text-slate-900 leading-tight">
                        Build your DiceRPG identity
                    </h1>
                    <p class="text-lg text-slate-600">
                        Create a profile for your party, track your rolls, and keep your world in one place.
                    </p>
                </div>
                <div class="grid gap-5">
                    <div class="flex items-start gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700 font-semibold">
                            1
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">Characters in one hub</h3>
                            <p class="text-sm text-slate-600">Save sheets, gear, and campaign notes with fast sync.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100 text-amber-700 font-semibold">
                            2
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">Instant party invites</h3>
                            <p class="text-sm text-slate-600">Share a link and bring your table together quickly.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-700 font-semibold">
                            3
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">Secure storage</h3>
                            <p class="text-sm text-slate-600">Your campaigns are protected with modern security.</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500">
                    <span class="rounded-full border border-slate-200 bg-white/80 px-3 py-1">No credit card</span>
                    <span class="rounded-full border border-slate-200 bg-white/80 px-3 py-1">Free starter account</span>
                    <span class="rounded-full border border-slate-200 bg-white/80 px-3 py-1">Cancel anytime</span>
                </div>
            </div>

            <div class="glass-card rounded-3xl border border-white/70 p-8 shadow-2xl shadow-emerald-100/60">
                <div class="mb-6 space-y-2">
                    <div class="text-xs font-semibold uppercase tracking-[0.3em] text-emerald-700">Join DiceRPG</div>
                    <h2 class="text-3xl font-semibold text-slate-900">Start your adventure</h2>
                    <p class="text-sm text-slate-500">
                        Already have an account?
                        <a href="<?= $loginUrl ?>" class="font-semibold text-emerald-700 hover:text-emerald-800 transition-colors">Log in</a>
                    </p>
                </div>

                <?= $this->Flash->render() ?>

                <?= $this->Form->create($user, ['class' => 'space-y-4']) ?>
                    <div class="space-y-2">
                        <label for="username" class="text-sm font-semibold text-slate-700">Username</label>
                        <input id="username" name="username" type="text" autocomplete="username" value="<?= h($user->username ?? '') ?>" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-emerald-600 focus:ring-0 outline-none transition" placeholder="Choose a username" required>
                        <?= $this->Form->error('username', null, ['class' => 'text-xs text-rose-600']) ?>
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="text-sm font-semibold text-slate-700">Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" value="<?= h($user->email ?? '') ?>" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-emerald-600 focus:ring-0 outline-none transition" placeholder="you@example.com" required>
                        <?= $this->Form->error('email', null, ['class' => 'text-xs text-rose-600']) ?>
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="text-sm font-semibold text-slate-700">Password</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-emerald-600 focus:ring-0 outline-none transition" placeholder="Create a password" required>
                        <?= $this->Form->error('password', null, ['class' => 'text-xs text-rose-600']) ?>
                    </div>

                    <div class="space-y-2">
                        <label for="password_confirm" class="text-sm font-semibold text-slate-700">Confirm password</label>
                        <input id="password_confirm" name="password_confirm" type="password" autocomplete="new-password" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-emerald-600 focus:ring-0 outline-none transition" placeholder="Repeat your password" required>
                        <?= $this->Form->error('password_confirm', null, ['class' => 'text-xs text-rose-600']) ?>
                    </div>

                    <button type="submit" class="btn-primary w-full rounded-xl px-4 py-3 text-sm font-semibold transition">
                        Create account
                    </button>
                <?= $this->Form->end() ?>

                <p class="mt-6 text-xs text-slate-500">
                    By creating an account, you agree to the DiceRPG terms and privacy policy.
                </p>
            </div>
        </div>
    </div>
    <?= $this->Html->script('register') ?>
</body>
</html>
