<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- Banner -->
<div class="rounded-2xl bg-gradient-to-r from-indigo-600 via-blue-500 to-sky-500 px-8 py-7 text-white shadow-lg shadow-indigo-500/20">
    <h2 class="text-2xl font-bold">Hubungi Saya</h2>
    <p class="mt-1 text-white/90">Ada pertanyaan atau ingin bekerja sama? Silakan kirim pesan di bawah ini.</p>
</div>

<div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Info kontak (kiri) -->
    <div class="space-y-4">
        <?php if (!empty($alamat) && is_array($alamat)) : ?>
            <?php foreach ($alamat as $a) : ?>
                <div class="bg-white rounded-2xl shadow-sm p-5">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700"><?= esc($a['tipe']); ?></span>
                    <p class="mt-3 text-sm font-medium text-slate-900"><?= esc($a['jalan']); ?></p>
                    <p class="mt-0.5 text-sm text-slate-500"><?= esc($a['kota']); ?>, <?= esc($a['provinsi']); ?> <?= esc($a['kode_pos']); ?></p>
                    <p class="mt-3 pt-3 border-t border-slate-100 text-sm text-slate-600">Telp: <?= esc($a['telepon']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="bg-white rounded-2xl shadow-sm p-5">
            <p class="text-sm font-semibold text-slate-900">Media Sosial</p>
            <div class="flex gap-4 mt-2 text-sm font-medium text-indigo-600">
                <a href="https://github.com/abua08363-cell" target="_blank" rel="noopener noreferrer" class="hover:underline">GitHub</a>
                <a href="https://linkedin.com/in/Albu-Hori" target="_blank" rel="noopener noreferrer" class="hover:underline">LinkedIn</a>
            </div>
        </div>
    </div>

    <!-- Form (kanan) -->
    <div class="md:col-span-2 bg-white rounded-2xl shadow-sm p-6">
        <h3 class="font-semibold text-slate-900 mb-4">Kirim Pesan</h3>
        <form id="contactForm" action="/pages/contact" method="post" class="space-y-4">
            <?= csrf_field(); ?>
            <?php
            $input = 'w-full bg-white border border-slate-200 rounded-lg px-3 py-2 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent';
            $label = 'block text-sm font-medium text-slate-700 mb-1';
            ?>
            <div>
                <label class="<?= $label; ?>">Nama Lengkap</label>
                <input type="text" name="nama" required placeholder="Masukkan nama Anda" class="<?= $input; ?>">
            </div>
            <div>
                <label class="<?= $label; ?>">Email</label>
                <input type="email" name="email" required placeholder="nama@email.com" class="<?= $input; ?>">
            </div>
            <div>
                <label class="<?= $label; ?>">Pesan</label>
                <textarea name="pesan" rows="4" required placeholder="Tuliskan pesan Anda di sini..." class="<?= $input; ?>"></textarea>
            </div>
            <button type="submit" id="btnSubmit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm py-2.5 rounded-lg transition-colors flex items-center justify-center gap-2">
                <span>Kirim Pesan</span>
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session()->getFlashdata('pesan')) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: <?= json_encode(session()->getFlashdata('pesan')); ?>,
                confirmButtonColor: '#4f46e5',
                timer: 3500,
                timerProgressBar: true
            });
        <?php endif; ?>

        const form = document.getElementById('contactForm');
        const btn = document.getElementById('btnSubmit');
        form.addEventListener('submit', function() {
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            btn.innerHTML = `
            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Mengirim...</span>`;
        });
    });
</script>

<?= $this->endSection() ?>