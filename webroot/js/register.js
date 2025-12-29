document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.querySelector('input[type="password"][name="password"]');
    const confirmInput = document.querySelector('input[type="password"][name="password_confirm"]');

    // Inject simple styles for valid/invalid checklist states
    const style = document.createElement('style');
    style.textContent = `
      .password-checklist { margin-top: 6px; }
      .password-checklist ul { margin: 4px 0 0; padding-left: 18px; }
      .password-checklist li { font-size: 0.9rem; line-height: 1.3; }
      .password-checklist li.invalid { color: #c62828; }
      .password-checklist li.valid { color: #2e7d32; }
    `;
    document.head.appendChild(style);

    function buildChecklist(includeMatch = false) {
        const container = document.createElement('div');
        container.className = 'password-checklist';
        const ul = document.createElement('ul');

        const items = [
            { key: 'upper', text: 'Contém letra maiúscula (A-Z)' },
            { key: 'lower', text: 'Contém letra minúscula (a-z)' },
            { key: 'digit', text: 'Contém número (0-9)' },
            { key: 'length', text: 'No mínimo 8 caracteres' },
        ];
        if (includeMatch) {
            items.push({ key: 'match', text: 'As senhas coincidem' });
        }

        items.forEach(({ key, text }) => {
            const li = document.createElement('li');
            li.dataset.key = key;
            li.className = 'invalid';
            li.textContent = text;
            ul.appendChild(li);
        });

        container.appendChild(ul);
        return container;
    }

    function buildMatchOnlyChecklist() {
        const container = document.createElement('div');
        container.className = 'password-checklist';
        const ul = document.createElement('ul');
        const li = document.createElement('li');
        li.dataset.key = 'match';
        li.className = 'invalid';
        li.textContent = 'As senhas coincidem';
        ul.appendChild(li);
        container.appendChild(ul);
        return container;
    }

    function updateChecklist(input, container, opts) {
        const value = input?.value ?? '';
        const other = opts?.other?.value ?? '';

        const checks = {
            upper: /[A-Z]/.test(value),
            lower: /[a-z]/.test(value),
            digit: /\d/.test(value),
            length: value.length >= 8,
            match: opts?.includeMatch ? value.length > 0 && value === other : undefined,
        };

        container.querySelectorAll('li').forEach(li => {
            const key = li.dataset.key;
            const ok = checks[key];
            if (ok === undefined) return;
            li.classList.toggle('valid', !!ok);
            li.classList.toggle('invalid', !ok);
        });
    }

    if (passwordInput) {
        const checklist = buildChecklist(false);
        passwordInput.insertAdjacentElement('afterend', checklist);
        ['input', 'keyup', 'change'].forEach(ev => {
            passwordInput.addEventListener(ev, () => updateChecklist(passwordInput, checklist, { includeMatch: false }));
        });
        // initialize
        updateChecklist(passwordInput, checklist, { includeMatch: false });
    }

    if (confirmInput) {
        const checklistConfirm = buildMatchOnlyChecklist();
        confirmInput.insertAdjacentElement('afterend', checklistConfirm);

        const refreshConfirm = () => {
            updateChecklist(confirmInput, checklistConfirm, { includeMatch: true, other: passwordInput });
        };
        ['input', 'keyup', 'change'].forEach(ev => {
            confirmInput.addEventListener(ev, refreshConfirm);
        });
        if (passwordInput) {
            ['input', 'keyup', 'change'].forEach(ev => {
                passwordInput.addEventListener(ev, refreshConfirm);
            });
        }
        refreshConfirm();
    }
});