// choice-popup.js (ES module)
// Attaches confirm popups to the Player and Mestre panels and redirects on confirm.

const SELECTOR_PLAYER = '#panel-player';
const SELECTOR_MESTRE = '#panel-mestre';

function ensureStyles() {
  if (document.getElementById('choice-popup-styles')) return;
  const style = document.createElement('style');
  style.id = 'choice-popup-styles';
  style.textContent = `
    .confirm-overlay{position:fixed;inset:0;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,.55);backdrop-filter:blur(2px);z-index:1000;}
    .confirm-modal{background:rgba(20,22,28,.96);color:#e8e8e8;border:1px solid rgba(255,255,255,.08);box-shadow:0 10px 40px rgba(0,0,0,.6), inset 0 0 0 1px rgba(255,255,255,.04);border-radius:12px;max-width:420px;width:90%;padding:20px}
    .confirm-modal h3{margin:0 0 8px;font-size:1.25rem;letter-spacing:.3px}
    .confirm-modal p{margin:0 0 16px;color:#b9c0cf;line-height:1.5}
    .confirm-actions{display:flex;gap:12px;justify-content:flex-end}
    .btn{appearance:none;border:none;padding:10px 14px;border-radius:8px;font-weight:600;cursor:pointer;transition:transform .06s ease, filter .2s ease;}
    .btn:active{transform:translateY(1px)}
    .btn-cancel{background:#2a2f3a;color:#d0d6e4;border:1px solid rgba(255,255,255,.08)}
    .btn-cancel:hover{filter:brightness(1.1)}
    .btn-confirm{background:linear-gradient(135deg,#3b82f6,#22c55e);color:white;}
    .btn-confirm:hover{filter:brightness(1.05)}
    .confirm-head{display:flex;align-items:center;gap:10px;margin-bottom:8px}
    .confirm-pill{font-size:.75rem;letter-spacing:.5px;opacity:.9;padding:2px 8px;border-radius:999px;border:1px solid rgba(255,255,255,.12)}
    .pill-player{color:#8ec5ff;background:rgba(59,130,246,.12)}
    .pill-mestre{color:#ff9a9a;background:rgba(239,68,68,.12)}
  `;
  document.head.appendChild(style);
}

function showConfirm({ role, onConfirm, onCancel }) {
  ensureStyles();

  const overlay = document.createElement('div');
  overlay.className = 'confirm-overlay';
  overlay.setAttribute('role', 'dialog');
  overlay.setAttribute('aria-modal', 'true');

  const modal = document.createElement('div');
  modal.className = 'confirm-modal';

  const head = document.createElement('div');
  head.className = 'confirm-head';
  const pill = document.createElement('span');
  pill.className = `confirm-pill ${role === 'PLAYER' ? 'pill-player' : 'pill-mestre'}`;
  pill.textContent = role;
  const title = document.createElement('h3');
  title.textContent = 'Confirmar escolha?';
  head.appendChild(pill);
  head.appendChild(title);

  const text = document.createElement('p');
  text.textContent = `Tem certeza que deseja escolher ${role}? Você poderá alterar mais tarde.`;

  const actions = document.createElement('div');
  actions.className = 'confirm-actions';
  const cancelBtn = document.createElement('button');
  cancelBtn.className = 'btn btn-cancel';
  cancelBtn.textContent = 'Cancelar';
  const confirmBtn = document.createElement('button');
  confirmBtn.className = 'btn btn-confirm';
  confirmBtn.textContent = 'Confirmar';
  actions.append(cancelBtn, confirmBtn);

  modal.append(head, text, actions);
  overlay.appendChild(modal);
  document.body.appendChild(overlay);

  const close = () => {
    overlay.remove();
    document.removeEventListener('keydown', onKey);
    onCancel && onCancel();
  };
  const confirm = () => {
    overlay.remove();
    document.removeEventListener('keydown', onKey);
    onConfirm && onConfirm();
  };
  const onKey = (e) => {
    if (e.key === 'Escape') close();
    if (e.key === 'Enter') confirm();
  };

  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) close();
  });
  cancelBtn.addEventListener('click', close);
  confirmBtn.addEventListener('click', confirm);
  document.addEventListener('keydown', onKey);

  confirmBtn.focus();
}

function wirePanel(panelEl) {
  if (!panelEl) return;
  const role = panelEl.getAttribute('data-role') || 'PAPEL';
  const url = panelEl.getAttribute('data-url');
  if (!url) return;

  const handle = (e) => {
    e.preventDefault();
    e.stopPropagation();
    showConfirm({
      role,
      onConfirm: () => {
        window.location.assign(url);
      },
      onCancel: () => {}
    });
  };

  panelEl.style.cursor = 'pointer';
  panelEl.addEventListener('click', handle);
  panelEl.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' || e.key === ' ') handle(e);
  });
  panelEl.setAttribute('tabindex', '0');
  panelEl.setAttribute('role', 'button');
  panelEl.setAttribute('aria-label', `Escolher ${role}`);
}

document.addEventListener('DOMContentLoaded', () => {
  const player = document.querySelector(SELECTOR_PLAYER);
  const mestre = document.querySelector(SELECTOR_MESTRE);
  wirePanel(player);
  wirePanel(mestre);
});
