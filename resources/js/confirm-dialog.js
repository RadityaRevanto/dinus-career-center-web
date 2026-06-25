const DIALOG_ID = 'confirm-dialog';

function getDialogElements() {
    const root = document.getElementById(DIALOG_ID);
    if (!root) return null;

    return {
        root,
        backdrop: root.querySelector('[data-confirm-backdrop]'),
        title: root.querySelector('[data-confirm-title]'),
        message: root.querySelector('[data-confirm-message]'),
        iconWrap: root.querySelector('[data-confirm-icon]'),
        cancelBtn: root.querySelector('[data-confirm-cancel]'),
        confirmBtn: root.querySelector('[data-confirm-confirm]'),
    };
}

function setTone(elements, tone) {
    const { iconWrap, confirmBtn } = elements;
    if (!iconWrap || !confirmBtn) return;

    const tones = {
        danger: {
            icon: 'bg-rose-50 text-rose-600',
            button: 'bg-rose-600 hover:bg-rose-700 focus:ring-rose-500/30',
        },
        warning: {
            icon: 'bg-amber-50 text-amber-600',
            button: 'bg-amber-600 hover:bg-amber-700 focus:ring-amber-500/30',
        },
        default: {
            icon: 'bg-blue-50 text-blue-600',
            button: 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500/30',
        },
    };

    const cfg = tones[tone] ?? tones.default;

    iconWrap.className = `shrink-0 flex items-center justify-center w-11 h-11 rounded-2xl ${cfg.icon}`;
    confirmBtn.className = `flex-1 px-4 py-2.5 text-sm font-semibold text-white rounded-xl transition focus:outline-none focus:ring-2 ${cfg.button}`;
}

export function showConfirmDialog(options = {}) {
    const elements = getDialogElements();
    if (!elements) {
        return Promise.resolve(window.confirm(options.message || 'Yakin?'));
    }

    const {
        title = 'Konfirmasi',
        message = 'Yakin ingin melanjutkan?',
        confirmLabel = 'Ya, lanjutkan',
        cancelLabel = 'Batal',
        tone = 'default',
    } = options;

    return new Promise((resolve) => {
        const { root, backdrop, title: titleEl, message: messageEl, cancelBtn, confirmBtn } = elements;

        let settled = false;
        const finish = (result) => {
            if (settled) return;
            settled = true;
            root.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            document.removeEventListener('keydown', onKeydown);
            resolve(result);
        };

        const onKeydown = (event) => {
            if (event.key === 'Escape') finish(false);
        };

        titleEl.textContent = title;
        messageEl.textContent = message;
        cancelBtn.textContent = cancelLabel;
        confirmBtn.textContent = confirmLabel;
        setTone(elements, tone);

        cancelBtn.onclick = () => finish(false);
        confirmBtn.onclick = () => finish(true);
        backdrop.onclick = () => finish(false);

        root.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        document.addEventListener('keydown', onKeydown);
        cancelBtn.focus();
    });
}

function bindConfirmForms() {
    document.addEventListener('submit', async (event) => {
        const form = event.target.closest('form[data-confirm]');
        if (!form) return;

        event.preventDefault();

        const confirmed = await showConfirmDialog({
            title: form.dataset.confirmTitle || 'Konfirmasi',
            message: form.dataset.confirm || 'Yakin ingin melanjutkan?',
            confirmLabel: form.dataset.confirmLabel || 'Ya, lanjutkan',
            cancelLabel: form.dataset.cancelLabel || 'Batal',
            tone: form.dataset.confirmTone || 'danger',
        });

        if (confirmed) {
            form.submit();
        }
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bindConfirmForms);
} else {
    bindConfirmForms();
}

window.showConfirmDialog = showConfirmDialog;
