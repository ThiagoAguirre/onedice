<!DOCTYPE html>
<html lang="<?= h($this->request->getParam('lang') ?? 'en') ?>" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiceRPG - Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Manrope:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <?= $this->Html->css('home') ?>
</head>
<body class="page">
    <a class="skip-link" href="#main">Skip to content</a>

    <header class="nav">
        <div class="container nav__inner">
            <a class="brand" href="#home" aria-label="DiceRPG home">
                <span class="brand__mark" aria-hidden="true">
                    <svg class="icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                        <rect x="4" y="4" width="16" height="16" rx="4"></rect>
                        <circle cx="9" cy="9" r="1.5"></circle>
                        <circle cx="15" cy="9" r="1.5"></circle>
                        <circle cx="9" cy="15" r="1.5"></circle>
                        <circle cx="15" cy="15" r="1.5"></circle>
                    </svg>
                </span>
                <span class="brand__name">DiceRPG</span>
            </a>

            <nav class="nav__links" aria-label="Primary">
                <a href="#features">Features</a>
                <a href="#toolkit">Toolkit</a>
                <a href="#guild">Guild</a>
                <a href="#journey">Journey</a>
            </nav>

            <div class="nav__actions">
                <button class="theme-toggle" type="button" data-theme-toggle aria-label="Toggle color theme" aria-pressed="false">
                    <span class="theme-toggle__icon theme-toggle__icon--sun" aria-hidden="true">
                        <svg class="icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                            <circle cx="12" cy="12" r="4"></circle>
                            <path d="M12 2v3M12 19v3M4.6 4.6l2.1 2.1M17.3 17.3l2.1 2.1M2 12h3M19 12h3M4.6 19.4l2.1-2.1M17.3 6.7l2.1-2.1"></path>
                        </svg>
                    </span>
                    <span class="theme-toggle__icon theme-toggle__icon--moon" aria-hidden="true">
                        <svg class="icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                            <path d="M15.5 2.5a8.5 8.5 0 1 0 6 13.9 9 9 0 0 1-6-13.9z"></path>
                        </svg>
                    </span>
                </button>
                <a class="btn btn--ghost" href="<?= $this->Language->url(['controller' => 'Users', 'action' => 'login']) ?>"><?= __('Log in') ?></a>
                <a class="btn btn--primary" href="<?= $this->Language->url(['controller' => 'Users', 'action' => 'login']) ?>"><?= __('Enter platform') ?></a>
            </div>
        </div>
    </header>

    <main id="main">
        <section id="home" class="hero section">
            <div class="container hero__grid">
                <div class="hero__content reveal" style="--delay: 0s;">
                    <p class="eyebrow">Daylight realm and modern fantasy tools</p>
                    <h1 class="hero__title"><?= __('Welcome to OneDice RPG') ?></h1>
                    <p class="hero__subtitle">DiceRPG is a friendly, premium tabletop hub with character sheets, maps, and rituals that feel light to use and powerful to master.</p>
                    <div class="hero__actions">
                        <a class="btn btn--primary" href="<?= $this->Language->url(['controller' => 'Users', 'action' => 'login']) ?>"><?= __('Start your adventure') ?></a>
                        <a class="btn btn--outline" href="#features"><?= __('Explore features') ?></a>
                    </div>
                    <div class="hero__stats">
                        <div class="stat">
                            <span class="stat__value">12k+</span>
                            <span class="stat__label">active campaigns</span>
                        </div>
                        <div class="stat">
                            <span class="stat__value">5 min</span>
                            <span class="stat__label">setup to play</span>
                        </div>
                        <div class="stat">
                            <span class="stat__value">300+</span>
                            <span class="stat__label">creator modules</span>
                        </div>
                    </div>
                </div>

                <div class="hero__visual reveal" style="--delay: 0.12s;">
                    <div class="hero__ring" aria-hidden="true"></div>

                    <article class="hero-card rune-border">
                        <div class="hero-card__top">
                            <div>
                                <p class="hero-card__label">Party leader</p>
                                <h3 class="hero-card__title">Eldric of Dawn</h3>
                            </div>
                            <span class="badge">Paladin</span>
                        </div>
                        <div class="progress">
                            <span class="progress__bar" style="width: 74%;"></span>
                        </div>
                        <div class="hero-card__meta">
                            <span>HP 42 / 56</span>
                            <span class="dot"></span>
                            <span>Shielded</span>
                        </div>
                    </article>

                    <article class="hero-card hero-card--side rune-border">
                        <div class="icon-badge icon-badge--small">
                            <svg class="icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                                <path d="M12 3l2.5 6.5L21 12l-6.5 2.5L12 21l-2.5-6.5L3 12l6.5-2.5L12 3z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="hero-card__label">New quest</p>
                            <p class="hero-card__text">Recover the Crystal Hymn from the Azure Shrine.</p>
                        </div>
                    </article>

                    <div class="hero-chip rune-border">
                        <span class="hero-chip__value">d20</span>
                        <span class="hero-chip__label">Roll ready</span>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="section section--alt">
            <div class="container">
                <div class="section__header reveal" style="--delay: 0s;">
                    <p class="eyebrow">Core features</p>
                    <h2>Everything you need for a clean, modern session.</h2>
                    <p class="section__subtitle">Subtle magic, practical tools, and a UI that stays light even in long campaigns.</p>
                </div>
                <div class="feature-grid">
                    <article class="feature-card reveal" style="--delay: 0.05s;">
                        <div class="icon-badge">
                            <svg class="icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                                <path d="M4 7l6-2 4 2 6-2v12l-6 2-4-2-6 2z"></path>
                                <path d="M10 5v12M14 7v12"></path>
                            </svg>
                        </div>
                        <h3>Living maps</h3>
                        <p>Grid snapping, soft fog of war, and atmospheric layers that feel calm instead of busy.</p>
                    </article>
                    <article class="feature-card reveal" style="--delay: 0.1s;">
                        <div class="icon-badge">
                            <svg class="icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                                <rect x="4" y="4" width="16" height="16" rx="4"></rect>
                                <circle cx="9" cy="9" r="1.5"></circle>
                                <circle cx="15" cy="15" r="1.5"></circle>
                            </svg>
                        </div>
                        <h3>Cinematic dice</h3>
                        <p>Physics rolls with graceful motion and built in outcomes for fast, dramatic pacing.</p>
                    </article>
                    <article class="feature-card reveal" style="--delay: 0.15s;">
                        <div class="icon-badge">
                            <svg class="icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                                <path d="M6 4h9a3 3 0 0 1 3 3v12a2 2 0 0 0-2-2H8a2 2 0 0 1-2-2z"></path>
                                <path d="M6 4v13"></path>
                            </svg>
                        </div>
                        <h3>Lore vault</h3>
                        <p>Link characters, places, and quests with a quiet, searchable wiki that stays organized.</p>
                    </article>
                    <article class="feature-card reveal" style="--delay: 0.2s;">
                        <div class="icon-badge">
                            <svg class="icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                                <circle cx="12" cy="12" r="9"></circle>
                                <path d="M8.5 8.5l7 7M15.5 8.5l-7 7"></path>
                            </svg>
                        </div>
                        <h3>Character forge</h3>
                        <p>Flexible sheets with auto math, custom traits, and exportable party rosters.</p>
                    </article>
                </div>
            </div>
        </section>

        <section id="toolkit" class="section">
            <div class="container">
                <div class="section__header reveal" style="--delay: 0s;">
                    <p class="eyebrow">Adventurer toolkit</p>
                    <h2>Tools that feel premium without feeling heavy.</h2>
                    <p class="section__subtitle">Keep sessions flowing with focused surfaces and deliberate spacing.</p>
                </div>
                <div class="card-grid">
                    <article class="info-card reveal" style="--delay: 0.05s;">
                        <h3>Session lounge</h3>
                        <p>Invite a party, drop a link, and land on a prepped table in seconds.</p>
                        <div class="info-card__foot">Instant lobby with audio ready</div>
                    </article>
                    <article class="info-card reveal" style="--delay: 0.1s;">
                        <h3>Guided prep</h3>
                        <p>Use gentle prompts and checklist magic to prep arcs, NPCs, and encounters.</p>
                        <div class="info-card__foot">Templates for every system</div>
                    </article>
                    <article class="info-card reveal" style="--delay: 0.15s;">
                        <h3>Shared ritual tools</h3>
                        <p>Timers, safety tools, and session notes that keep the table respectful and clear.</p>
                        <div class="info-card__foot">Built in consent prompts</div>
                    </article>
                </div>
            </div>
        </section>

        <section id="guild" class="section section--alt">
            <div class="container split">
                <div class="split__content reveal" style="--delay: 0s;">
                    <p class="eyebrow">For game masters</p>
                    <h2>Run the narrative with calm, precise control.</h2>
                    <p class="section__subtitle">Track secrets, manage encounters, and keep the flow light for your group.</p>
                    <ul class="checklist">
                        <li>
                            <span class="check">
                                <svg class="icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                                    <path d="M5 12l4 4 10-10"></path>
                                </svg>
                            </span>
                            Encounter tracking with gentle alerts
                        </li>
                        <li>
                            <span class="check">
                                <svg class="icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                                    <path d="M5 12l4 4 10-10"></path>
                                </svg>
                            </span>
                            Private notes and mystery layers
                        </li>
                        <li>
                            <span class="check">
                                <svg class="icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                                    <path d="M5 12l4 4 10-10"></path>
                                </svg>
                            </span>
                            Instant loot drops and rewards
                        </li>
                    </ul>
                    <a class="btn btn--primary" href="<?= $this->Language->url(['controller' => 'Users', 'action' => 'login']) ?>">Start as a game master</a>
                </div>
                <div class="split__visual reveal" style="--delay: 0.12s;">
                    <div class="panel rune-border">
                        <div class="panel__header">
                            <div>
                                <p class="panel__label">Campaign dashboard</p>
                                <h3>Whispering Coast</h3>
                            </div>
                            <span class="badge badge--alt">Live</span>
                        </div>
                        <div class="panel__grid">
                            <div class="panel__item">
                                <span class="panel__value">3</span>
                                <span class="panel__label">chapters ready</span>
                            </div>
                            <div class="panel__item">
                                <span class="panel__value">12</span>
                                <span class="panel__label">NPCs tracked</span>
                            </div>
                            <div class="panel__item">
                                <span class="panel__value">6</span>
                                <span class="panel__label">encounters queued</span>
                            </div>
                        </div>
                        <div class="panel__note">
                            Secret: The beacon lights only when the tide is low.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="journey" class="section">
            <div class="container">
                <div class="section__header reveal" style="--delay: 0s;">
                    <p class="eyebrow">Your journey</p>
                    <h2>Three steps from idea to first roll.</h2>
                    <p class="section__subtitle">A simple flow with just enough ceremony to feel magical.</p>
                </div>
                <ol class="steps">
                    <li class="step reveal" style="--delay: 0.05s;">
                        <span class="step__number">1</span>
                        <div>
                            <h3>Create your hero</h3>
                            <p>Pick a system, define your stats, and save your story in one scroll.</p>
                        </div>
                    </li>
                    <li class="step reveal" style="--delay: 0.1s;">
                        <span class="step__number">2</span>
                        <div>
                            <h3>Gather your party</h3>
                            <p>Share a link, set the table mood, and start with a calm, guided lobby.</p>
                        </div>
                    </li>
                    <li class="step reveal" style="--delay: 0.15s;">
                        <span class="step__number">3</span>
                        <div>
                            <h3>Play and track</h3>
                            <p>Roll, chat, and track sessions without losing the fantasy glow.</p>
                        </div>
                    </li>
                </ol>
            </div>
        </section>

        <section class="section cta">
            <div class="container">
                <div class="cta__box rune-border reveal" style="--delay: 0s;">
                    <div>
                        <p class="eyebrow">Ready to roll?</p>
                        <h2>Enter a brighter tabletop experience.</h2>
                        <p class="section__subtitle">Light, friendly, and built for long campaigns with zero clutter.</p>
                    </div>
                    <div class="cta__actions">
                        <a class="btn btn--primary" href="<?= $this->Language->url(['controller' => 'Users', 'action' => 'login']) ?>">Enter the realm</a>
                        <a class="btn btn--outline" href="#features">View the toolkit</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container footer__inner">
            <div class="footer__brand">
                <span class="brand__mark" aria-hidden="true">
                    <svg class="icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                        <rect x="4" y="4" width="16" height="16" rx="4"></rect>
                        <circle cx="9" cy="9" r="1.5"></circle>
                        <circle cx="15" cy="15" r="1.5"></circle>
                    </svg>
                </span>
                <div>
                    <div class="brand__name">DiceRPG</div>
                    <div class="footer__tagline">Modern fantasy tools for bright sessions.</div>
                </div>
            </div>
            <div class="footer__links">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Support</a>
            </div>
            <div class="footer__meta">&copy; 2026 DiceRPG. All rights reserved.</div>
        </div>
    </footer>

    <?= $this->Html->script('home') ?>
</body>
</html>
