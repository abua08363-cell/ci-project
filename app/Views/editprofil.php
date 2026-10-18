<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<?php
$jkRaw = strtolower(trim((string) ($profil['jenis_kelamin'] ?? '')));
$jk    = in_array($jkRaw, ['l', 'laki-laki', 'laki', 'male', '1'], true) ? 'L'
    : (in_array($jkRaw, ['p', 'perempuan', 'female', '2'], true) ? 'P' : '');

$inputClass = 'w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent';
?>

<div class="w-full">

    <!-- Header halaman -->
    <div>
        <a href="/profil" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke daftar
        </a>
        <h2 class="mt-3 text-2xl font-bold tracking-tight text-slate-900"><?= esc($title); ?></h2>
        <p class="mt-1 text-sm text-slate-500">Perbarui data profil lalu simpan perubahan.</p>
    </div>

    <!-- Form -->
    <div class="mt-6 w-full bg-white rounded-xl border border-slate-200 shadow-sm">
        <form action="/profil/<?= esc($profil['id'], 'url'); ?>" method="post" class="p-6 space-y-5">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">

            <div>
                <label for="nama" class="block text-sm font-medium text-slate-700 mb-1.5">Nama</label>
                <input type="text" id="nama" name="nama" required value="<?= esc(old('nama', $profil['nama'])); ?>" class="<?= $inputClass; ?>">
            </div>

            <div>
                <label for="alamat" class="block text-sm font-medium text-slate-700 mb-1.5">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3" required class="<?= $inputClass; ?>"><?= esc(old('alamat', $profil['alamat'])); ?></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="tanggal_lahir" class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" required value="<?= esc(old('tanggal_lahir', $profil['tanggal_lahir'])); ?>" class="<?= $inputClass; ?>">
                </div>

                <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium text-slate-700 mb-1.5">Jenis kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required class="<?= $inputClass; ?>">
                        <option value="" disabled <?= $jk === '' ? 'selected' : ''; ?>>Pilih jenis kelamin</option>
                        <option value="L" <?= $jk === 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                        <option value="P" <?= $jk === 'P' ? 'selected' : ''; ?>>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-100">
                <a href="/profil" class="px-4 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 rounded-lg transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-sm transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                    Simpan perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>