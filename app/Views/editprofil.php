<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="w-full bg-white rounded-2xl shadow-sm overflow-hidden">

    <!-- Header kartu -->
    <div class="px-6 py-5 flex items-center justify-between gap-4 border-b border-slate-100">
        <div>
            <h2 class="font-semibold text-slate-900"><?= esc($title); ?></h2>
            <p class="text-sm text-slate-500 mt-0.5">Ubah data profil di bawah ini.</p>
        </div>
        <a href="/profil" class="inline-flex items-center px-4 py-2 text-sm text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors whitespace-nowrap">
            &larr; Kembali
        </a>
    </div>

    <!-- Form -->
    <form action="/profil/update/<?= $profil['id']; ?>" method="post" class="p-6 space-y-5">
        <?= csrf_field(); ?>
        <input type="hidden" name="_method" value="PUT">
        <?php
        $input = 'w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition';
        $label = 'block text-sm font-medium text-slate-700 mb-1';
        $jk    = old('jenis_kelamin', $profil['jenis_kelamin']);
        ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="nama" class="<?= $label; ?>">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required
                    value="<?= esc(old('nama', $profil['nama'])); ?>" class="<?= $input; ?>">
            </div>

            <div>
                <label for="tanggal_lahir" class="<?= $label; ?>">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" required
                    value="<?= esc(old('tanggal_lahir', $profil['tanggal_lahir'])); ?>" class="<?= $input; ?>">
            </div>

            <div>
                <label for="jenis_kelamin" class="<?= $label; ?>">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" required class="<?= $input; ?>">
                    <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                    <option value="L" <?= $jk == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="P" <?= $jk == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label for="alamat" class="<?= $label; ?>">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3" required class="<?= $input; ?>"><?= esc(old('alamat', $profil['alamat'])); ?></textarea>
            </div>
        </div>

        <div class="pt-5 flex justify-end gap-2 border-t border-slate-100">
            <a href="/profil" class="px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">Batal</a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors">Simpan Perubahan</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>