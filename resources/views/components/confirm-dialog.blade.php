<div id="confirm-dialog" class="fixed inset-0 z-[100] hidden" role="dialog" aria-modal="true" aria-labelledby="confirm-dialog-title">
    <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm" data-confirm-backdrop></div>
    <div class="relative flex min-h-full items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div data-confirm-icon class="shrink-0 flex items-center justify-center w-11 h-11 rounded-2xl bg-rose-50 text-rose-600">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <h3 id="confirm-dialog-title" data-confirm-title class="text-lg font-bold text-gray-900">Konfirmasi</h3>
                        <p data-confirm-message class="text-sm text-gray-500 mt-2 leading-relaxed"></p>
                    </div>
                </div>
            </div>
            <div class="flex gap-3 px-6 py-4 bg-gray-50 border-t border-gray-100">
                <button type="button" data-confirm-cancel class="flex-1 px-4 py-2.5 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-gray-200">
                    Batal
                </button>
                <button type="button" data-confirm-confirm class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-rose-600 hover:bg-rose-700 rounded-xl transition focus:outline-none focus:ring-2 focus:ring-rose-500/30">
                    Ya, lanjutkan
                </button>
            </div>
        </div>
    </div>
</div>
