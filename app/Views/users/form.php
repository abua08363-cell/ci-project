<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<?php
$isEdit = ($mode ?? 'create') === 'edit';
$user   = $user ?? [];
$errors = $errors ?? (session()->getFlashdata('errors') ?? []);

$val = static fn(string $k, string $d = '') => old($k, $user[$k] ?? $d);

$action = $isEdit ? site_url('users/update/' . $user['id']) : site_url('users/store');

$cls = static fn(string $k) => 'w-full px-4 py-2.5 text-sm rounded-lg border bg-white placeholder-slate-400 focus:outline-none focus:ring-2 '
    . (isset($errors[$k])
        ? 'border-rose-300 focus:ring-rose-500/30 focus:border-rose-500'
        : 'border-slate-200 focus:ring-indigo-500/30 focus:border-indigo-500');

$label = 'block mb-1.5 text-sm font-medium text-slate-700';
?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
        <?= esc(session()->getFlashdata('error')); ?>
    </div>
<?php endif; ?>

<section class="bg-white rounded-2xl shadow-sm overflow-hidden w-full">

    <!-- Header kartu -->
    <div class="px-6 py-5 flex items-center justify-between gap-4 border-b border-slate-100">
        <h2 class="font-semibold text-slate-800"><?= $isEdit ? 'Edit User' : 'Tambah User'; ?></h2>
        <a href="<?= site_url('users'); ?>"
            class="px-4 py-2 text-sm text-slate-700 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
            &larr; Kembali
        </a>
    </div>

    <form action="<?= $action; ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">

            <!-- Foto profil -->
            <?php
            $foto    = $user['photo'] ?? null;
            $fotoUrl = ($foto && is_file(FCPATH . 'uploads/users/' . $foto)) ? base_url('uploads/users/' . $foto) : null;
            $inisial = strtoupper(mb_substr($val('username', 'U') ?: 'U', 0, 1));
            ?>
            <div class="md:col-span-3 flex items-center gap-5 pb-4 border-b border-slate-100">
                <div class="shrink-0">
                    <img id="foto-preview" src="<?= esc((string) $fotoUrl, 'attr'); ?>" alt="Foto profil"
                        class="w-20 h-20 rounded-full object-cover border border-slate-200 <?= $fotoUrl ? '' : 'hidden'; ?>">
                    <span id="foto-inisial"
                        class="w-20 h-20 rounded-full bg-indigo-100 text-indigo-600 text-2xl font-semibold flex items-center justify-center <?= $fotoUrl ? 'hidden' : ''; ?>">
                        <?= esc($inisial); ?>
                    </span>
                </div>
                <div class="min-w-0">
                    <label for="photo" class="<?= $label; ?>">Foto Profil</label>
                    <input type="file" id="photo" name="photo" accept="image/png,image/jpeg,image/webp"
                        class="block text-sm text-slate-500 file:mr-3 file:px-4 file:py-2 file:rounded-lg file:border file:border-slate-200 file:bg-white file:text-sm file:text-slate-700 hover:file:bg-slate-50">
                    <p class="mt-1 text-xs text-slate-400">JPG, PNG, atau WEBP. Maksimal 2 MB.</p>
                    <?php if (isset($errors['photo'])) : ?><p class="mt-1 text-xs text-rose-600"><?= esc($errors['photo']); ?></p><?php endif; ?>
                    <?php if ($isEdit && $fotoUrl) : ?>
                        <label class="mt-2 flex items-center gap-2 text-xs text-slate-500 cursor-pointer">
                            <input type="checkbox" name="remove_photo" value="1" class="accent-rose-600"> Hapus foto saat ini
                        </label>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="<?= $label; ?>">Username <span class="text-rose-500">*</span></label>
                <input type="text" id="username" name="username" value="<?= esc($val('username'), 'attr'); ?>" placeholder="Masukkan username" required
                    class="<?= $cls('username'); ?>">
                <?php if (isset($errors['username'])) : ?><p class="mt-1 text-xs text-rose-600"><?= esc($errors['username']); ?></p><?php endif; ?>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="<?= $label; ?>">Email <span class="text-rose-500">*</span></label>
                <input type="email" id="email" name="email" value="<?= esc($val('email'), 'attr'); ?>" placeholder="nama@email.com" required
                    class="<?= $cls('email'); ?>">
                <?php if (isset($errors['email'])) : ?><p class="mt-1 text-xs text-rose-600"><?= esc($errors['email']); ?></p><?php endif; ?>
            </div>


            <!-- No. HP -->
            <div>
                <label for="phone" class="<?= $label; ?>">No. HP</label>
                <input type="text" id="phone" name="phone" value="<?= esc(old('phone', $user['phone'] ?? ''), 'attr'); ?>" placeholder="08xxxxxxxxxx" inputmode="tel"
                    class="<?= $cls('phone'); ?>">
                <?php if (isset($errors['phone'])) : ?><p class="mt-1 text-xs text-rose-600"><?= esc($errors['phone']); ?></p><?php endif; ?>
            </div>
            <!-- Role -->
            <div>
                <label for="role" class="<?= $label; ?>">Role <span class="text-rose-500">*</span></label>
                <select id="role" name="role" class="<?= $cls('role'); ?>">
                    <?php foreach (['user' => 'User', 'admin' => 'Admin'] as $v => $t) : ?>
                        <option value="<?= $v; ?>" <?= $val('role', 'user') === $v ? 'selected' : ''; ?>><?= $t; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['role'])) : ?><p class="mt-1 text-xs text-rose-600"><?= esc($errors['role']); ?></p><?php endif; ?>
            </div>

            <!-- Status (is_active) -->
            <div class="md:col-span-2">
                <span class="<?= $label; ?>">Status <span class="text-rose-500">*</span></span>
                <div class="flex gap-3">
                    <?php foreach (['1' => 'Aktif', '0' => 'Nonaktif'] as $v => $t) : ?>
                        <label class="flex items-center gap-2 px-4 py-2.5 text-sm border border-slate-200 rounded-lg cursor-pointer hover:bg-slate-50 has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50 has-[:checked]:text-indigo-700">
                            <input type="radio" name="is_active" value="<?= $v; ?>" class="accent-indigo-600"
                                <?= (string)$val('is_active', '1') === (string)$v ? 'checked' : ''; ?>>
                            <?= $t; ?>
                        </label>
                    <?php endforeach; ?>
                </div>
                <?php if (isset($errors['is_active'])) : ?><p class="mt-1 text-xs text-rose-600"><?= esc($errors['is_active']); ?></p><?php endif; ?>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="<?= $label; ?>">
                    Password <?= $isEdit ? '' : '<span class="text-rose-500">*</span>'; ?>
                </label>
                <div class="relative">
                    <input type="password" id="password" name="password" autocomplete="new-password"
                        placeholder="<?= $isEdit ? 'Kosongkan jika tidak diubah' : 'Minimal 8 karakter'; ?>"
                        <?= $isEdit ? '' : 'required'; ?>
                        class="<?= $cls('password'); ?> pr-16">
                    <button type="button" data-toggle="password"
                        class="absolute inset-y-0 right-0 px-4 text-xs text-slate-500 hover:text-indigo-600">Lihat</button>
                </div>
                <?php if (isset($errors['password'])) : ?><p class="mt-1 text-xs text-rose-600"><?= esc($errors['password']); ?></p><?php endif; ?>
            </div>

            <!-- Konfirmasi password -->
            <div>
                <label for="password_confirm" class="<?= $label; ?>">
                    Konfirmasi Password <?= $isEdit ? '' : '<span class="text-rose-500">*</span>'; ?>
                </label>
                <div class="relative">
                    <input type="password" id="password_confirm" name="password_confirm" autocomplete="new-password"
                        placeholder="Ulangi password"
                        <?= $isEdit ? '' : 'required'; ?>
                        class="<?= $cls('password_confirm'); ?> pr-16">
                    <button type="button" data-toggle="password_confirm"
                        class="absolute inset-y-0 right-0 px-4 text-xs text-slate-500 hover:text-indigo-600">Lihat</button>
                </div>
                <?php if (isset($errors['password_confirm'])) : ?><p class="mt-1 text-xs text-rose-600"><?= esc($errors['password_confirm']); ?></p><?php endif; ?>
            </div>
        </div>

        <!-- Tombol -->
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="<?= site_url('users'); ?>"
                class="px-5 py-2.5 text-sm text-slate-700 border border-slate-200 rounded-lg hover:bg-slate-100 transition-colors">Batal</a>
            <button type="submit"
                class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors">
                <?= $isEdit ? 'Simpan Perubahan' : 'Simpan User'; ?>
            </button>
        </div>
    </form>
</section>

<script>
    // Pratinjau foto yang dipilih
    (function() {
        const input = document.getElementById('photo');
        const img = document.getElementById('foto-preview');
        const inisial = document.getElementById('foto-inisial');
        if (input) {
            input.addEventListener('change', function() {
                const file = input.files[0];
                if (!file) return;
                img.src = URL.createObjectURL(file);
                img.classList.remove('hidden');
                if (inisial) inisial.classList.add('hidden');
            });
        }
    })();

    // Tombol "Lihat / Sembunyikan" untuk kolom password
    document.querySelectorAll('[data-toggle]').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const input = document.getElementById(btn.dataset.toggle);
            const tampil = input.type === 'password';
            input.type = tampil ? 'text' : 'password';
            btn.textContent = tampil ? 'Sembunyikan' : 'Lihat';
        });
    });
</script>

<?= $this->endSection() ?>