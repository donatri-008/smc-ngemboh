import Alpine from 'alpinejs';
import flatpickr from 'flatpickr';
import { Indonesian } from 'flatpickr/dist/l10n/id.js';
import 'flatpickr/dist/flatpickr.min.css';

// window.showToast HARUS selalu terdaftar, tidak peduli Alpine instance ini
// yang pertama jalan atau bukan. Ini fungsi utilitas murni (cuma dispatchEvent),
// tidak bergantung pada status Alpine sama sekali — makanya dipisah dari guard di bawah.
if (!window.showToast) {
    window.showToast = (type, message) => {
        window.dispatchEvent(new CustomEvent('toast', { detail: { type, message } }));
    };
}

// Set locale Indonesia sebagai default global untuk semua instance Flatpickr,
// dan expose ke window supaya bisa dipanggil langsung dari x-init di Blade
// (misal: x-init="flatpickr($el, {...})").
flatpickr.localize(Indonesian);
window.flatpickr = flatpickr;

// Guard ini KHUSUS untuk mencegah "Detected multiple instances of Alpine running"
// kalau di suatu halaman Alpine kebetulan sudah di-start duluan (misal dari Livewire).
if (!window.Alpine) {
    window.Alpine = Alpine;
    Alpine.start();
}