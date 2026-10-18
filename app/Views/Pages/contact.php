<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<?php
// Pesan disimpan ke database aplikasi ini (ContactMessages::send), tanpa layanan luar.
$endpoint = $endpoint ?? base_url('pages/contact/send');
$emailTujuan = 'abua08363@gmail.com';
$waNomor     = '6285715330893';

$input = 'peer w-full bg-slate-50 border border-slate-200 rounded-xl py-3 text-sm text-slate-800 placeholder-slate-400 hover:border-slate-300 focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/15 transition duration-200';
$label = 'block text-xs font-semibold text-slate-600 mb-1.5';

$sosial = [
    ['GitHub',    'https://github.com/abua08363-cell',     'hover:bg-slate-900 hover:text-white', 'M12 .5a11.5 11.5 0 00-3.64 22.41c.58.1.79-.25.79-.56v-2c-3.2.7-3.88-1.54-3.88-1.54-.52-1.33-1.28-1.69-1.28-1.69-1.05-.71.08-.7.08-.7 1.15.08 1.76 1.19 1.76 1.19 1.03 1.76 2.69 1.25 3.34.96.1-.74.4-1.25.73-1.54-2.55-.29-5.24-1.28-5.24-5.69 0-1.26.45-2.28 1.19-3.09-.12-.29-.52-1.46.11-3.05 0 0 .97-.31 3.17 1.18a11 11 0 015.77 0c2.2-1.49 3.17-1.18 3.17-1.18.63 1.59.23 2.76.11 3.05.74.81 1.19 1.83 1.19 3.09 0 4.42-2.69 5.39-5.25 5.68.41.36.78 1.06.78 2.14v3.17c0 .31.21.67.8.56A11.5 11.5 0 0012 .5z'],
    ['LinkedIn',  'https://linkedin.com/in/Albu-Hori',     'hover:bg-sky-700 hover:text-white',   'M20.45 20.45h-3.56v-5.57c0-1.33-.03-3.04-1.85-3.04-1.86 0-2.14 1.45-2.14 2.94v5.67H9.35V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28zM5.34 7.43a2.06 2.06 0 110-4.13 2.06 2.06 0 010 4.13zM7.12 20.45H3.56V9h3.56v11.45zM22.22 0H1.77C.79 0 0 .77 0 1.73v20.54C0 23.23.79 24 1.77 24h20.45c.98 0 1.78-.77 1.78-1.73V1.73C24 .77 23.2 0 22.22 0z'],
    ['Instagram', 'https://www.instagram.com/m.albuhori_', 'hover:bg-pink-600 hover:text-white',   'M12 2.16c3.2 0 3.58.01 4.85.07 3.25.15 4.77 1.69 4.92 4.92.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.15 3.23-1.66 4.77-4.92 4.92-1.27.06-1.64.07-4.85.07s-3.58-.01-4.85-.07c-3.26-.15-4.77-1.7-4.92-4.92C2.17 15.58 2.16 15.2 2.16 12s.01-3.58.07-4.85C2.38 3.92 3.9 2.38 7.15 2.23 8.42 2.17 8.8 2.16 12 2.16zM12 0C8.74 0 8.33.01 7.05.07 2.7.27.27 2.69.07 7.05.01 8.33 0 8.74 0 12s.01 3.67.07 4.95c.2 4.36 2.62 6.78 6.98 6.98C8.33 23.99 8.74 24 12 24s3.67-.01 4.95-.07c4.35-.2 6.78-2.62 6.98-6.98.06-1.28.07-1.69.07-4.95s-.01-3.67-.07-4.95c-.2-4.35-2.62-6.78-6.98-6.98C15.67.01 15.26 0 12 0zm0 5.84a6.16 6.16 0 100 12.32 6.16 6.16 0 000-12.32zM12 16a4 4 0 110-8 4 4 0 010 8zm6.41-11.85a1.44 1.44 0 100 2.88 1.44 1.44 0 000-2.88z'],
];
?>

<style>
    @keyframes cUp {
        from {
            opacity: 0;
            transform: translateY(18px);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    .c-up {
        opacity: 0;
        animation: cUp .7s cubic-bezier(.2, .8, .2, 1) forwards;
        animation-delay: calc(var(--i, 0) * 90ms);
    }

    @media (prefers-reduced-motion: reduce) {
        .c-up {
            animation: none;
            opacity: 1;
        }
    }
</style>

<div class="space-y-6 min-w-0">

    <!-- ===== BANNER ===== -->
    <div class="c-up relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-blue-600 to-sky-500 px-6 sm:px-10 py-8 sm:py-10 text-white shadow-xl shadow-indigo-500/20" style="--i:0">
        <span class="pointer-events-none absolute -top-16 -right-10 w-64 h-64 rounded-full bg-white/10"></span>
        <span class="pointer-events-none absolute -bottom-20 right-32 w-48 h-48 rounded-full bg-white/10"></span>
        <span class="pointer-events-none absolute inset-0 opacity-30" style="background-image:radial-gradient(rgba(255,255,255,.35) 1px,transparent 1px);background-size:22px 22px;-webkit-mask-image:linear-gradient(to right,transparent,#000);mask-image:linear-gradient(to right,transparent,#000)"></span>

        <div class="relative">
            <span class="inline-flex items-center gap-2 px-3 py-1 text-[11px] font-semibold rounded-full bg-white/15 ring-1 ring-inset ring-white/30">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-300"></span> Biasanya membalas dalam 1×24 jam
            </span>
            <h2 class="mt-3 text-2xl sm:text-3xl font-extrabold tracking-tight">Hubungi Saya</h2>
            <p class="mt-2 max-w-xl text-white/90 text-sm sm:text-base">Ada pertanyaan atau ingin bekerja sama? Silakan kirim pesan di bawah ini, saya senang berdiskusi.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

        <!-- ===== INFO KONTAK (kiri) ===== -->
        <div class="lg:col-span-2 space-y-4 min-w-0">

            <!-- Kontak cepat -->
            <a href="mailto:<?= esc($emailTujuan, 'attr'); ?>" class="c-up group flex items-center gap-4 bg-white rounded-2xl border border-slate-100 shadow-sm p-5 hover:-translate-y-1 hover:shadow-lg hover:border-indigo-200 transition duration-300" style="--i:1">
                <span class="w-12 h-12 shrink-0 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="14" rx="2" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7l9 6 9-6" />
                    </svg>
                </span>
                <div class="min-w-0">
                    <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">Email</p>
                    <p class="text-sm font-semibold text-slate-800 truncate"><?= esc($emailTujuan); ?></p>
                </div>
            </a>

            <a href="https://wa.me/<?= esc($waNomor, 'attr'); ?>" target="_blank" rel="noopener noreferrer" class="c-up group flex items-center gap-4 bg-white rounded-2xl border border-slate-100 shadow-sm p-5 hover:-translate-y-1 hover:shadow-lg hover:border-emerald-200 transition duration-300" style="--i:2">
                <span class="w-12 h-12 shrink-0 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.3a1 1 0 01.95.68l1.1 3.3a1 1 0 01-.5 1.2l-1.6.8a11 11 0 005.4 5.4l.8-1.6a1 1 0 011.2-.5l3.3 1.1a1 1 0 01.68.95V19a2 2 0 01-2 2A16 16 0 013 5z" />
                    </svg>
                </span>
                <div class="min-w-0">
                    <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">WhatsApp</p>
                    <p class="text-sm font-semibold text-slate-800">+62 857 1533 0893</p>
                </div>
            </a>

            <!-- Alamat dari database -->
            <?php if (!empty($alamat) && is_array($alamat)) : ?>
                <?php foreach ($alamat as $n => $a) : ?>
                    <div class="c-up bg-white rounded-2xl border border-slate-100 shadow-sm p-5 hover:shadow-md transition" style="--i:<?= $n + 3; ?>">
                        <div class="flex items-center gap-3">
                            <span class="w-9 h-9 rounded-lg bg-sky-100 text-sky-600 flex items-center justify-center">
                                <svg class="w-4.5 h-4.5 w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-5.4 7-11a7 7 0 10-14 0c0 5.6 7 11 7 11z" />
                                    <circle cx="12" cy="10" r="2.5" />
                                </svg>
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 ring-1 ring-inset ring-indigo-100"><?= esc($a['tipe'] ?? 'Alamat'); ?></span>
                        </div>
                        <p class="mt-3 text-sm font-semibold text-slate-900"><?= esc($a['jalan'] ?? ''); ?></p>
                        <p class="mt-0.5 text-sm text-slate-500"><?= esc($a['kota'] ?? ''); ?>, <?= esc($a['provinsi'] ?? ''); ?> <?= esc($a['kode_pos'] ?? ''); ?></p>
                        <?php if (!empty($a['telepon'])) : ?>
                            <p class="mt-3 pt-3 border-t border-slate-100 text-sm text-slate-600">
                                Telp: <a href="tel:<?= esc(preg_replace('/[^0-9+]/', '', $a['telepon']), 'attr'); ?>" class="font-medium hover:text-indigo-600"><?= esc($a['telepon']); ?></a>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Media sosial -->
            <div class="c-up bg-white rounded-2xl border border-slate-100 shadow-sm p-5" style="--i:5">
                <p class="text-sm font-bold text-slate-900">Media Sosial</p>
                <p class="mt-0.5 text-xs text-slate-500">Ikuti dan terhubung dengan saya.</p>
                <div class="mt-4 flex gap-3">
                    <?php foreach ($sosial as [$nama, $href, $hover, $path]) : ?>
                        <a href="<?= esc($href, 'attr'); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?= esc($nama, 'attr'); ?>" title="<?= esc($nama, 'attr'); ?>"
                            class="w-11 h-11 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center hover:-translate-y-0.5 hover:shadow-md transition <?= $hover; ?>">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="<?= $path; ?>" />
                            </svg>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- ===== FORM (kanan) ===== -->
        <div class="c-up lg:col-span-3 bg-white rounded-3xl border border-slate-100 shadow-sm p-6 sm:p-8 min-w-0" style="--i:2">
            <div class="flex items-center gap-3 mb-6">
                <span class="w-11 h-11 rounded-xl bg-gradient-to-br from-indigo-500 to-blue-600 text-white flex items-center justify-center shadow-lg shadow-indigo-500/25">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </span>
                <div>
                    <h3 class="font-extrabold text-slate-900 text-lg leading-tight">Kirim Pesan</h3>
                    <p class="text-xs text-slate-500">Semua kolom wajib diisi.</p>
                </div>
            </div>

            <form id="contactForm" class="space-y-5" data-endpoint="<?= esc($endpoint, 'attr'); ?>" data-email="<?= esc($emailTujuan, 'attr'); ?>" novalidate>
                <?= csrf_field() ?>
                <!-- Honeypot anti-bot (harus tetap kosong) -->
                <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">

                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label for="nama" class="<?= $label; ?>">Nama Lengkap</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 peer-focus:text-indigo-500 pointer-events-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM4 21a8 8 0 0116 0" />
                                </svg>
                            </span>
                            <input type="text" name="nama" id="nama" required minlength="2" maxlength="80" autocomplete="name" placeholder="Masukkan nama Anda" class="<?= $input; ?> pl-10 pr-4">
                        </div>
                        <p class="err hidden mt-1 text-[11px] font-medium text-rose-600"></p>
                    </div>
                    <div>
                        <label for="email" class="<?= $label; ?>">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="3" y="5" width="18" height="14" rx="2" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7l9 6 9-6" />
                                </svg>
                            </span>
                            <input type="email" name="email" id="email" required maxlength="120" autocomplete="email" placeholder="nama@email.com" class="<?= $input; ?> pl-10 pr-4">
                        </div>
                        <p class="err hidden mt-1 text-[11px] font-medium text-rose-600"></p>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="pesan" class="text-xs font-semibold text-slate-600">Pesan</label>
                        <span class="text-[11px] text-slate-400"><span id="pesanCount">0</span>/1000</span>
                    </div>
                    <textarea name="pesan" id="pesan" rows="6" required minlength="10" maxlength="1000" placeholder="Tuliskan pesan Anda di sini..." class="<?= $input; ?> px-4 resize-y"></textarea>
                    <p class="err hidden mt-1 text-[11px] font-medium text-rose-600"></p>
                </div>

                <button type="submit" id="btnSubmit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-bold text-sm py-3.5 rounded-xl shadow-lg shadow-indigo-500/25 hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus-visible:ring-4 focus-visible:ring-indigo-500/30 disabled:opacity-70 disabled:cursor-not-allowed disabled:hover:translate-y-0 transition duration-200 flex items-center justify-center gap-2">
                    <span id="btnLabel">Kirim Pesan</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        const btn = document.getElementById('btnSubmit');
        if (!form) return;

        const idle = '<span id="btnLabel">Kirim Pesan</span>';
        const loading = `
            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Mengirim...</span>`;

        const setLoading = on => {
            btn.disabled = on;
            btn.innerHTML = on ? loading : idle;
        };

        // Penghitung karakter
        const pesan = document.getElementById('pesan');
        const count = document.getElementById('pesanCount');
        pesan.addEventListener('input', () => count.textContent = pesan.value.length);

        // Validasi per kolom
        const messages = {
            nama: 'Nama minimal 2 karakter.',
            email: 'Masukkan alamat email yang valid.',
            pesan: 'Pesan minimal 10 karakter.'
        };
        const validate = el => {
            const err = el.closest('div').parentElement.querySelector('.err') || el.parentElement.nextElementSibling;
            const ok = el.value.trim() !== '' && el.checkValidity();
            el.classList.toggle('border-rose-400', !ok);
            if (err && err.classList.contains('err')) {
                err.textContent = ok ? '' : messages[el.id];
                err.classList.toggle('hidden', ok);
            }
            return ok;
        };
        ['nama', 'email', 'pesan'].forEach(id => {
            const el = document.getElementById(id);
            el.addEventListener('blur', () => validate(el));
            el.addEventListener('input', () => {
                if (el.classList.contains('border-rose-400')) validate(el);
            });
        });

        // Perbarui token CSRF dari balasan server agar pengiriman berikutnya tetap valid
        const refreshCsrf = d => {
            if (d && d.csrfName && d.csrfHash) {
                const f = form.querySelector('input[name="' + d.csrfName + '"]');
                if (f) f.value = d.csrfHash;
            }
        };

        const sukses = (teks) => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: teks,
                confirmButtonColor: '#4f46e5',
                timer: 3500,
                timerProgressBar: true
            });
            form.reset();
            count.textContent = '0';
        };
        const gagal = (teks) => Swal.fire({
            icon: 'error',
            title: 'Gagal mengirim',
            text: teks,
            confirmButtonColor: '#4f46e5'
        });

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Honeypot terisi = bot, abaikan diam-diam
            if (form.website.value) return;

            const valid = ['nama', 'email', 'pesan'].map(id => validate(document.getElementById(id))).every(Boolean);
            if (!valid) {
                form.querySelector('.border-rose-400')?.focus();
                return;
            }

            const endpoint = form.dataset.endpoint;
            setLoading(true);

            try {
                const res = await fetch(endpoint, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                const data = await res.json().catch(() => ({}));
                refreshCsrf(data);
                if (!res.ok || data.status !== 'ok') {
                    throw new Error(data.message || 'Server menolak permintaan. Muat ulang halaman lalu coba lagi.');
                }
                sukses(data.message || 'Pesan Anda berhasil dikirim!');
            } catch (err) {
                gagal(err.message || 'Terjadi kesalahan. Coba lagi nanti.');
            } finally {
                setLoading(false);
            }
        });
    });
</script>

<?= $this->endSection() ?>