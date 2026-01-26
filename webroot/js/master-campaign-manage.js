document.addEventListener('DOMContentLoaded', () => {
    const tabs = Array.from(document.querySelectorAll('[data-tab]'));
    const panels = Array.from(document.querySelectorAll('[data-panel]'));
    const pendingBadges = Array.from(document.querySelectorAll('[data-pending-count]'));
    const tabNames = new Set(tabs.map((btn) => btn.dataset.tab));

    const setActiveTab = (tabName) => {
        tabs.forEach((btn) => {
            btn.classList.toggle('is-active', btn.dataset.tab === tabName);
        });
        panels.forEach((panel) => {
            panel.classList.toggle('is-active', panel.dataset.panel === tabName);
        });
        if (tabName) {
            window.history.replaceState(null, '', `#${tabName}`);
        }
    };

    const initialTab = window.location.hash.replace('#', '');
    if (initialTab && tabNames.has(initialTab)) {
        setActiveTab(initialTab);
    }

    tabs.forEach((btn) => {
        btn.addEventListener('click', () => setActiveTab(btn.dataset.tab));
    });

    const updatePendingBadges = () => {
        const count = document.querySelectorAll('[data-request]').length;
        pendingBadges.forEach((badge) => {
            if (badge.dataset.pendingType === 'panel') {
                badge.textContent = `${count} pendentes`;
            } else {
                badge.textContent = count;
            }
            badge.style.display = count === 0 ? 'none' : '';
        });
        const emptyState = document.querySelector('.request-empty');
        if (emptyState) {
            emptyState.classList.toggle('is-hidden', count > 0);
        }
    };

    const copyButtons = document.querySelectorAll('[data-copy]');
    copyButtons.forEach((btn) => {
        btn.addEventListener('click', async () => {
            const text = btn.getAttribute('data-copy') || '';
            if (!text) {
                return;
            }
            try {
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    await navigator.clipboard.writeText(text);
                } else {
                    const temp = document.createElement('textarea');
                    temp.value = text;
                    temp.style.position = 'fixed';
                    temp.style.opacity = '0';
                    document.body.appendChild(temp);
                    temp.select();
                    document.execCommand('copy');
                    document.body.removeChild(temp);
                }
                const label = btn.querySelector('.copy-label');
                if (label) {
                    label.textContent = 'Copiado';
                }
                btn.classList.add('is-copied');
                setTimeout(() => {
                    if (label) {
                        label.textContent = text;
                    }
                    btn.classList.remove('is-copied');
                }, 1400);
            } catch (error) {
                // Silent fallback for copy failures.
            }
        });
    });

    document.querySelectorAll('[data-request-action]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const card = btn.closest('[data-request]');
            if (!card) {
                return;
            }
            const action = btn.getAttribute('data-request-action');
            if (action === 'accept') {
                const actions = card.querySelector('.request-actions');
                if (actions) {
                    actions.innerHTML = '<span class="status-pill">Aceito</span>';
                }
                card.removeAttribute('data-request');
                card.classList.add('is-accepted');
            }
            if (action === 'decline') {
                card.remove();
            }
            updatePendingBadges();
        });
    });
});
