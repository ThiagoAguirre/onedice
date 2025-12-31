<div class="app">
      <!-- Noise overlay -->
      <div class="noise-overlay bg-noise"></div>
      <!-- Grid overlay -->
      <div class="grid-overlay"></div>
      <!-- Center divider -->
      <div class="center-divider"></div>

      <!-- D20 dice canvas layer -->
      <div id="dice-layer" class="dice-layer"></div>
      <div class="dice-glow bg-dice-glow"></div>

      <!-- Panels -->
      <div class="panels">
        <!-- PLAYER -->
        <div id="panel-player" class="role-panel role-panel-player glow-border-player">
          <div class="corner tl player"></div>
          <div class="corner bl player"></div>

          <div class="content" style="position: relative; z-index: 10; display: flex; flex-direction: column; align-items: center;">
            <!-- Player Icon (SVG) with sigil wrapper -->
            <div class="sigil sigil-player">
              <svg class="role-icon text-player" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M50 5L15 20V45C15 67.5 29.5 87.5 50 95C70.5 87.5 85 67.5 85 45V20L50 5Z" stroke="currentColor" stroke-width="3" fill="currentColor" fill-opacity="0.1"/>
                <path d="M50 25V70" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                <path d="M40 35H60" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                <path d="M45 70H55V75H45V70Z" fill="currentColor"/>
                <path d="M50 20L46 28H54L50 20Z" fill="currentColor"/>
              </svg>
            </div>

            <h2 class="role-title text-player">PLAYER</h2>
            <div class="stats">
              <div class="stat">
                <span class="label">HP</span>
                <span class="bar hp"><span class="fill" style="--pct: 82%"></span></span>
              </div>
              <div class="stat">
                <span class="label">MP</span>
                <span class="bar mp"><span class="fill" style="--pct: 64%"></span></span>
              </div>
            </div>
            <p class="details hidden text-muted-foreground">Pronto para a jornada</p>
          </div>

          <!-- Background radial glow on hover (via ::before) -->
          <!-- Particles -->
          <div class="particles" data-particles>
            <span class="particle" style="background-color: hsl(var(--player-blue));"></span>
            <span class="particle" style="background-color: hsl(var(--player-blue));"></span>
            <span class="particle" style="background-color: hsl(var(--player-blue));"></span>
            <span class="particle" style="background-color: hsl(var(--player-blue));"></span>
            <span class="particle" style="background-color: hsl(var(--player-blue));"></span>
            <span class="particle" style="background-color: hsl(var(--player-blue));"></span>
          </div>
        </div>

        <!-- MESTRE -->
        <div id="panel-mestre" class="role-panel role-panel-mestre glow-border-mestre">
          <div class="corner tr mestre"></div>
          <div class="corner br mestre"></div>

          <div class="content" style="position: relative; z-index: 10; display: flex; flex-direction: column; align-items: center;">
            <!-- Mestre Icon (SVG) with sigil wrapper -->
            <div class="sigil sigil-mestre">
              <svg class="role-icon text-mestre" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 55L30 30L50 45L70 30L80 55H20Z" stroke="currentColor" stroke-width="3" fill="currentColor" fill-opacity="0.1"/>
                <circle cx="30" cy="28" r="4" fill="currentColor"/>
                <circle cx="50" cy="20" r="5" fill="currentColor"/>
                <circle cx="70" cy="28" r="4" fill="currentColor"/>
                <path d="M20 55H80V65C80 67 78 70 75 70H25C22 70 20 67 20 65V55Z" stroke="currentColor" stroke-width="3" fill="currentColor" fill-opacity="0.2"/>
                <path d="M25 75H75V80C75 82 73 85 70 85H30C27 85 25 82 25 80V75Z" stroke="currentColor" stroke-width="2" fill="currentColor" fill-opacity="0.15"/>
                <path d="M30 80H70" stroke="currentColor" stroke-width="1" opacity="0.5"/>
              </svg>
            </div>

            <h2 class="role-title text-mestre">MESTRE</h2>
            <div class="stats">
              <div class="stat">
                <span class="label">AMEAÇA</span>
                <span class="bar threat"><span class="fill" style="--pct: 70%"></span></span>
              </div>
              <div class="stat">
                <span class="label">PODER</span>
                <span class="bar power"><span class="fill" style="--pct: 55%"></span></span>
              </div>
            </div>
            <p class="details hidden text-muted-foreground">Forje seu mundo</p>
          </div>

          <!-- Particles -->
          <div class="particles" data-particles-right>
            <span class="particle" style="background-color: hsl(var(--mestre-red));"></span>
            <span class="particle" style="background-color: hsl(var(--mestre-red));"></span>
            <span class="particle" style="background-color: hsl(var(--mestre-red));"></span>
            <span class="particle" style="background-color: hsl(var(--mestre-red));"></span>
            <span class="particle" style="background-color: hsl(var(--mestre-red));"></span>
            <span class="particle" style="background-color: hsl(var(--mestre-red));"></span>
          </div>
        </div>
      </div>

      <!-- Bottom instruction -->
      <div class="bottom-instruction">
        <p class="text-muted-foreground-60" id="instruction">Escolha seu caminho</p>
      </div>
    </div>
    <?php echo $this->Html->script('choice', ['block' => true, 'type' => 'module']); ?>
    <?php echo $this->Html->css('choice', ['block' => true]); ?>