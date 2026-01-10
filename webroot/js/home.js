(() => {
    const root = document.documentElement;
    const themeToggle = document.querySelector('[data-theme-toggle]');
    const prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion) {
        root.setAttribute('data-reduced-motion', 'true');
    }

    const storedTheme = (() => {
        try {
            return localStorage.getItem('theme');
        } catch (error) {
            return null;
        }
    })();

    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    const initialTheme = storedTheme || (prefersDark ? 'dark' : 'light');

    const setTheme = (value, persist) => {
        root.setAttribute('data-theme', value);
        if (themeToggle) {
            themeToggle.setAttribute('aria-pressed', value === 'dark' ? 'true' : 'false');
        }
        if (persist) {
            try {
                localStorage.setItem('theme', value);
            } catch (error) {
                // Ignore storage errors.
            }
        }
    };

    setTheme(initialTheme, false);

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            setTheme(next, true);
        });
    }

    const revealItems = document.querySelectorAll('.reveal');

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        revealItems.forEach((item) => item.classList.add('is-visible'));
    } else {
        const observer = new IntersectionObserver(
            (entries, io) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        io.unobserve(entry.target);
                    }
                });
            },
            {
                root: null,
                rootMargin: '0px 0px -10% 0px',
                threshold: 0.2
            }
        );

        revealItems.forEach((item) => observer.observe(item));
    }

    if (prefersReducedMotion) {
        root.style.setProperty('--parallax-x', '0px');
        root.style.setProperty('--parallax-y', '0px');
        root.style.setProperty('--parallax-scroll', '0px');
        return;
    }

    const state = {
        currentX: 0,
        currentY: 0,
        targetX: 0,
        targetY: 0,
        currentScroll: 0,
        targetScroll: 0
    };

    const maxOffset = 18;
    let viewportWidth = Math.max(window.innerWidth, 1);
    let viewportHeight = Math.max(window.innerHeight, 1);

    const updateViewport = () => {
        viewportWidth = Math.max(window.innerWidth, 1);
        viewportHeight = Math.max(window.innerHeight, 1);
    };

    const onPointerMove = (event) => {
        if (event.pointerType && event.pointerType !== 'mouse') {
            return;
        }
        const x = (event.clientX / viewportWidth - 0.5) * 2;
        const y = (event.clientY / viewportHeight - 0.5) * 2;
        state.targetX = x * maxOffset;
        state.targetY = y * maxOffset;
    };

    const onScroll = () => {
        state.targetScroll = window.scrollY * 0.12;
    };

    const tick = () => {
        state.currentX += (state.targetX - state.currentX) * 0.08;
        state.currentY += (state.targetY - state.currentY) * 0.08;
        state.currentScroll += (state.targetScroll - state.currentScroll) * 0.08;

        root.style.setProperty('--parallax-x', `${state.currentX.toFixed(2)}px`);
        root.style.setProperty('--parallax-y', `${state.currentY.toFixed(2)}px`);
        root.style.setProperty('--parallax-scroll', `${(-state.currentScroll).toFixed(2)}px`);

        requestAnimationFrame(tick);
    };

    window.addEventListener('pointermove', onPointerMove, { passive: true });
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', updateViewport, { passive: true });

    updateViewport();
    onScroll();
    requestAnimationFrame(tick);
})();
