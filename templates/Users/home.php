<?php
/**
 * Users Home (Landing) Page — OneDice / RPG Quest
 * Este layout cria a página inicial com seções de apresentação,
 * papéis (Jogador/Mestre), recursos e um CTA final.
 */

// Caminho da imagem de background (coloque o arquivo em webroot/img/rpg-quest-hero.jpg)
$heroBg = $this->Url->assetUrl('backGround.png');
?>

<style>
    .users-home.landing{--gap:2rem;color:#222}
    .users-home .container{max-width:1100px;margin:0 auto;padding:0 1rem}
    .users-home .section{padding:3rem 0}

    /* HERO */
    .users-home .hero{position:relative;min-height:70vh;display:flex;align-items:center}
    .users-home .hero .hero-card{position:relative;z-index:2;max-width:720px;background:rgba(255,255,255,.85);backdrop-filter:saturate(140%) blur(6px);padding:2rem;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,.15)}
    .users-home .hero h1{font-size:clamp(2rem,4vw,3rem);margin:0 0 .5rem;font-weight:800}
    .users-home .hero p.lead{font-size:clamp(1rem,2.2vw,1.25rem);margin:.25rem 0 1rem;color:#333}
    .users-home .hero .actions{display:flex;gap:.75rem;flex-wrap:wrap}
    .users-home .hero .button{padding:.7rem 1.1rem;border-radius:10px;font-weight:600;text-decoration:none}
    .users-home .hero .button-outline{border:2px solid #333;color:#333}
    .users-home .hero .button-primary{background:#111;color:#fff}
    .users-home .hero::before{content:"";position:absolute;inset:0;background:linear-gradient(180deg, rgba(0,0,0,.35), rgba(0,0,0,.35))}
    .users-home .hero::after{content:"";position:absolute;inset:0;background-position:center;background-repeat:no-repeat;background-size:cover;z-index:-1}

    /* GRIDS */
    .users-home .grid{display:grid;gap:var(--gap)}
    .users-home .two{grid-template-columns:repeat(2,minmax(0,1fr))}
    .users-home .three{grid-template-columns:repeat(3,minmax(0,1fr))}
    @media (max-width: 860px){
        .users-home .two, .users-home .three{grid-template-columns:1fr}
    }

    /* CARDS */
    .users-home .card{background:#fff;border:1px solid #eee;border-radius:12px;padding:1.25rem}
    .users-home h2{font-size:1.75rem;margin:0 0 .75rem}
    .users-home h3{font-size:1.15rem;margin:.25rem 0 .5rem}
    .users-home p{margin:.25rem 0 .75rem;line-height:1.55}
    .users-home ul{margin:.5rem 0;padding-left:1.2rem}
    .users-home li{margin:.3rem 0}
    .users-home .muted{color:#555}

    /* CTA */
    .users-home .cta{background:#0f172a;color:#fff;border-radius:14px;padding:2rem;text-align:center}
    .users-home .cta h2{color:#fff;margin-bottom:.25rem}
    .users-home .cta p{color:#e5e7eb}
    .users-home .cta .actions{display:flex;justify-content:center;gap:.75rem;margin-top:1rem;flex-wrap:wrap}
    .users-home .cta .button{padding:.7rem 1.1rem;border-radius:10px;font-weight:700;text-decoration:none}
    .users-home .cta .button-primary{background:#22c55e;color:#102b16}
    .users-home .cta .button-outline{border:2px solid #9ca3af;color:#e5e7eb}
</style>

<div class="users-home landing">
    <!-- HERO -->
    <section class="hero" style="--hero-bg: url('<?= h($heroBg) ?>');">
        <div class="container">
            <div class="hero-card">
                <h1>RPG Quest — Explore mundos e molde destinos</h1>
                <p class="lead">Entre, reúna seu grupo e comece agora a criar campanhas épicas. Role os dados, conte histórias inesquecíveis e decida o rumo das aventuras.</p>
                <p class="muted">Escolha como deseja continuar:</p>
                <div class="actions">
                    <?= $this->Html->link('Entrar', ['controller' => 'Users', 'action' => 'login'], ['class' => 'button button-primary']); ?>
                    <?= $this->Html->link('Registrar', ['controller' => 'Users', 'action' => 'register'], ['class' => 'button button-outline']); ?>
                </div>
            </div>
        </div>
    </section>

    <script>
        /* Aplica o background da hero com gradiente via CSS var */
        (function(){
            var hero=document.querySelector('.users-home .hero');
            if(hero){ hero.style.setProperty('--bg-image', "url('<?= h($heroBg) ?>')");
                hero.style.backgroundImage = "linear-gradient(180deg, rgba(16,24,40,.55), rgba(16,24,40,.25)), url('<?= h($heroBg) ?>')";
                hero.style.backgroundSize = 'cover';
                hero.style.backgroundPosition = 'center';
            }
        })();
    </script>

    <!-- O QUE É -->
    <section class="section">
        <div class="container">
            <div class="card">
                <h2>O que é o RPG Quest?</h2>
                <p>O RPG Quest é uma plataforma simples e flexível para jogar e organizar RPG de mesa pela web. Crie campanhas, monte fichas, conduza sessões com rolagens de dados e registre a evolução da sua história — tudo em um só lugar.</p>
            </div>
        </div>
    </section>

    <!-- COMO FUNCIONA -->
    <section class="section">
        <div class="container">
            <h2>Como funciona</h2>
            <div class="grid four two">
                <div class="card">
                    <h3>1. Crie sua conta</h3>
                    <p>Registre-se em poucos cliques para acessar todos os recursos.</p>
                </div>
                <div class="card">
                    <h3>2. Entre ou crie uma campanha</h3>
                    <p>Junte-se ao seu grupo ou inicie um novo mundo de aventuras.</p>
                </div>
                <div class="card">
                    <h3>3. Monte as fichas</h3>
                    <p>Crie personagens, defina atributos, perícias e inventário.</p>
                </div>
                <div class="card">
                    <h3>4. Jogue sessões</h3>
                    <p>Role dados, narre cenas e registre o progresso da história.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PAPÉIS: JOGADOR x MESTRE -->
    <section class="section">
        <div class="container">
            <h2>Dois papéis, uma aventura</h2>
            <div class="grid two">
                <div class="card">
                    <h3>Jogador</h3>
                    <ul>
                        <li>Cria e evolui o personagem</li>
                        <li>Interpreta, decide ações e rola os dados</li>
                        <li>Gerencia inventário e anotações</li>
                    </ul>
                </div>
                <div class="card">
                    <h3>Mestre</h3>
                    <ul>
                        <li>Constrói o mundo e a campanha</li>
                        <li>Conduz as sessões e define desafios</li>
                        <li>Gerencia NPCs, regras e recompensas</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- RECURSOS -->
    <section class="section">
        <div class="container">
            <h2>Recursos principais</h2>
            <div class="grid three">
                <div class="card"><h3>Campanhas</h3><p>Organize aventuras e convide o grupo.</p></div>
                <div class="card"><h3>Fichas</h3><p>Personagens completos com atributos e perícias.</p></div>
                <div class="card"><h3>Dados</h3><p>Rolações rápidas com histórico nas sessões.</p></div>
                <div class="card"><h3>Sessões</h3><p>Agende e registre acontecimentos de cada encontro.</p></div>
                <div class="card"><h3>Narrativa</h3><p>Anotações, ganchos, NPCs e linhas do tempo.</p></div>
                <div class="card"><h3>Colaboração</h3><p>Todo o grupo acompanhando a mesma página.</p></div>
            </div>
        </div>
    </section>

    <!-- CTA FINAL -->
    <section class="section">
        <div class="container">
            <div class="cta">
                <h2>Pronto para a próxima missão?</h2>
                <p>Crie ou participe de uma campanha agora mesmo e comece a moldar o destino de mundos.</p>
                <div class="actions">
                    <?= $this->Html->link('Entrar', ['controller' => 'Users', 'action' => 'login'], ['class' => 'button button-primary']); ?>
                    <?= $this->Html->link('Registrar', ['controller' => 'Users', 'action' => 'register'], ['class' => 'button button-outline']); ?>
                </div>
            </div>
        </div>
    </section>
</div>
