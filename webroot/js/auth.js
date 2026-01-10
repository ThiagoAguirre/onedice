document.addEventListener('DOMContentLoaded', () => {
    const switcher = document.querySelector('[data-lang-switcher]');
    if (switcher) {
        const toggle = switcher.querySelector('[data-lang-toggle]');
        const panel = switcher.querySelector('[data-lang-panel]');
        const options = switcher.querySelectorAll('[data-lang-option]');
        const activeFlag = switcher.querySelector('[data-active-flag]');
        const activeLabel = switcher.querySelector('[data-active-label]');

        if (switcher.dataset.langCurrent) {
            document.documentElement.dataset.lang = switcher.dataset.langCurrent;
        }

        const close = () => {
            switcher.classList.remove('is-open');
            toggle.setAttribute('aria-expanded', 'false');
            panel.setAttribute('aria-hidden', 'true');
        };

        const open = () => {
            switcher.classList.add('is-open');
            toggle.setAttribute('aria-expanded', 'true');
            panel.setAttribute('aria-hidden', 'false');
        };

        const setActive = (option) => {
            options.forEach((item) => item.classList.remove('is-active'));
            option.classList.add('is-active');

            const nextFlag = option.dataset.flag || '';
            const nextLabel = option.dataset.label || '';
            const nextLang = option.dataset.lang || '';

            if (activeFlag) {
                activeFlag.className = `lang-switcher__flag flag ${nextFlag}`;
            }
            if (activeLabel) {
                activeLabel.textContent = nextLabel;
            }
            if (nextLang) {
                switcher.dataset.langCurrent = nextLang;
                document.documentElement.dataset.lang = nextLang;
            }
        };

        toggle.addEventListener('click', (event) => {
            event.stopPropagation();
            if (switcher.classList.contains('is-open')) {
                close();
            } else {
                open();
            }
        });

        options.forEach((option) => {
            option.addEventListener('click', (event) => {
                event.preventDefault();
                setActive(option);
                close();
            });
        });

        document.addEventListener('click', (event) => {
            if (!switcher.contains(event.target)) {
                close();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                close();
            }
        });
    }

    document.querySelectorAll('[data-toggle-password]').forEach((button) => {
        const targetSelector = button.getAttribute('data-target');
        if (!targetSelector) {
            return;
        }
        const input = document.querySelector(targetSelector);
        if (!input) {
            return;
        }

        button.addEventListener('click', () => {
            const isVisible = input.getAttribute('type') === 'text';
            input.setAttribute('type', isVisible ? 'password' : 'text');
            button.classList.toggle('is-visible', !isVisible);
            button.setAttribute('aria-pressed', String(!isVisible));
        });
    });

    document.querySelectorAll('[data-password-meter]').forEach((meter) => {
        const form = meter.closest('form');
        const passwordInput = form ? form.querySelector('[data-password-input]') : null;
        if (!passwordInput) {
            return;
        }

        const confirmInput = form ? form.querySelector('[data-confirm-input]') : null;
        const confirmMessage = form ? form.querySelector('[data-confirm-message]') : null;
        const fill = meter.querySelector('[data-strength-fill]');
        const label = meter.querySelector('[data-strength-text]');
        const count = meter.querySelector('[data-strength-count]');
        const message = meter.querySelector('[data-strength-message]');
        const checklistItems = meter.querySelectorAll('[data-check]');
        const alert = form ? form.querySelector('[data-form-alert]') : null;

        const minLength = Number.parseInt(meter.dataset.minLength || '8', 10);
        const shortThreshold = Number.parseInt(meter.dataset.shortThreshold || '5', 10);
        const msgIdle = meter.dataset.msgIdle || '';
        const msgTooShort = meter.dataset.msgTooShort || '';
        const msgInvalid = meter.dataset.msgInvalid || '';
        const msgValid = meter.dataset.msgValid || '';

        const labels = {
            weak: meter.dataset.labelWeak || 'Weak',
            medium: meter.dataset.labelMedium || 'Medium',
            strong: meter.dataset.labelStrong || 'Strong',
        };

        const evaluate = (value) => ({
            length: value.length >= minLength,
            upper: /[A-Z]/.test(value),
            number: /[0-9]/.test(value),
            symbol: /[^A-Za-z0-9]/.test(value),
        });

        const updateChecklist = (results) => {
            checklistItems.forEach((item) => {
                const key = item.dataset.check;
                if (!key || !(key in results)) {
                    return;
                }
                const ok = results[key];
                item.classList.toggle('is-valid', ok);
                item.classList.toggle('is-invalid', !ok);
            });
        };

        const updateConfirm = () => {
            if (!confirmInput) {
                return;
            }
            const mismatch = confirmInput.value.length > 0 && confirmInput.value !== passwordInput.value;
            confirmInput.classList.toggle('is-mismatch', mismatch);
            if (confirmMessage) {
                confirmMessage.textContent = confirmMessage.dataset.mismatchText || '';
                confirmMessage.hidden = !mismatch;
            }
        };

        const updateMeter = () => {
            const value = passwordInput.value || '';
            const results = evaluate(value);
            const passed = Object.values(results).filter(Boolean).length;
            const total = Object.keys(results).length;
            const percentage = total > 0 ? Math.round((passed / total) * 100) : 0;

            if (fill) {
                fill.style.width = `${percentage}%`;
            }

            let strength = 'weak';
            if (passed >= total) {
                strength = 'strong';
            } else if (passed >= total - 1) {
                strength = 'medium';
            }
            meter.dataset.strength = strength;

            if (label) {
                label.textContent = labels[strength];
            }
            if (count) {
                count.textContent = `${passed}/${total}`;
            }

            const isShort = value.length > 0 && value.length < shortThreshold;
            passwordInput.classList.toggle('is-too-short', isShort);
            meter.classList.toggle('is-too-short', isShort);

            if (message) {
                if (!value) {
                    message.textContent = msgIdle;
                } else if (isShort) {
                    message.textContent = msgTooShort;
                } else if (passed === total) {
                    message.textContent = msgValid;
                } else {
                    message.textContent = msgInvalid;
                }
            }

            updateChecklist(results);
            updateConfirm();
        };

        passwordInput.addEventListener('input', updateMeter);
        if (confirmInput) {
            confirmInput.addEventListener('input', updateConfirm);
        }

        updateMeter();

        if (form) {
            form.addEventListener('submit', (event) => {
                const results = evaluate(passwordInput.value || '');
                const allValid = Object.values(results).every(Boolean);
                const matchValid = !confirmInput || confirmInput.value === passwordInput.value;
                if (!allValid || !matchValid) {
                    event.preventDefault();
                    if (alert) {
                        alert.textContent = form.dataset.formError || msgInvalid;
                        alert.hidden = false;
                    }
                    if (!matchValid && confirmMessage) {
                        confirmMessage.textContent = confirmMessage.dataset.mismatchText || '';
                        confirmMessage.hidden = false;
                    }
                    passwordInput.focus();
                }
            });
        }
    });
});
