<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<?php
$keyword = $keyword ?? (service('request')->getGet('q') ?? '');

$users = $users ?? [
    ['id' => 1, 'username' => 'Administrator', 'email' => 'admin@unilam.ac.id', 'phone' => null, 'role' => 'admin', 'is_active' => 1, 'created_at' => '2026-10-04 08:03:00'],
    ['id' => 2, 'username' => 'Albu',          'email' => 'albu@unilam.ac.id',  'phone' => null, 'role' => 'user',  'is_active' => 1, 'created_at' => '2026-10-04 08:03:00'],
];

$idLogin = session('user_id') ?? session('id');

$badgeRole = [
    'admin' => 'bg-amber-100 text-amber-700',
    'user'  => 'bg-slate-100 text-slate-600',
];

$tanggal = fn($v) => $v ? date('d M Y H:i', strtotime($v)) : '-';
?>

<!-- Notifikasi -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
        <?= esc(session()->getFlashdata('success')); ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
    <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
        <?= esc(session()->getFlashdata('error')); ?>
    </div>
<?php endif; ?>

<section class="bg-white rounded-2xl shadow-sm overflow-hidden">

    <!-- Header: judul, pencarian, tombol tambah -->
    <div class="px-6 py-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <h2 class="font-semibold text-slate-800">Daftar User</h2>

        <div class="flex flex-wrap items-center gap-2">
            <form action="<?= site_url('users'); ?>" method="get" class="flex items-center gap-2">
                <input type="text" name="q" value="<?= esc($keyword, 'attr'); ?>" placeholder="Cari username / email..."
                    class="w-56 md:w-72 px-4 py-2 text-sm border border-slate-200 rounded-lg placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500">
                <button type="submit"
                    class="px-4 py-2 text-sm text-slate-700 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                    Cari
                </button>
            </form>

            <a href="<?= site_url('users/create'); ?>"
                class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors">
                + Tambah User
            </a>
        </div>
    </div>

    <!-- Tabel -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left whitespace-nowrap text-center ">
            <thead class="bg-slate-50 border-y text-center border-slate-100 text-xs font-semibold uppercase text-slate-600">
                <tr>
                    <th class="px-6 py-3">Foto</th>
                    <th class="px-6 py-3">Username</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">No. HP</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Dibuat Pada</th>
                    <th class="px-20 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">

                <?php if (empty($users)) : ?>
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-slate-400">
                            <?= $keyword !== '' ? 'Tidak ada user yang cocok dengan "' . esc($keyword) . '".' : 'Belum ada user terdaftar.'; ?>
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($users as $u) : ?>
                    <tr class="hover:bg-slate-50/60">
                        <!-- 1. Foto -->
                        <td class="px-6 py-4">
                            <?php
                            $fotoUser = $u['photo'] ?? null;
                            $urlFoto  = ($fotoUser && is_file(FCPATH . 'uploads/users/' . $fotoUser)) ? base_url('uploads/users/' . $fotoUser) : null;
                            $inisial  = strtoupper(mb_substr($u['username'] ?? 'U', 0, 1));
                            ?>

                            <?php if ($urlFoto) : ?>
                                <img src="<?= esc($urlFoto, 'attr'); ?>" alt="Foto" class="w-9 h-9 rounded-full object-cover border border-slate-200">
                            <?php else : ?>
                                <span class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-600 text-sm font-semibold flex items-center justify-center">
                                    <?= esc($inisial); ?>
                                </span>
                            <?php endif; ?>
                        </td>

                        <!-- 2. Username -->
                        <td class="px-6 py-4 font-semibold text-slate-800">
                            <?= esc($u['username'] ?? 'Tanpa Username'); ?>
                        </td>

                        <!-- 3. Email -->
                        <td class="px-6 py-4 text-slate-500"><?= esc($u['email']); ?></td>

                        <!-- 4. No. HP -->
                        <td class="px-6 py-4 text-slate-500"><?= !empty($u['phone']) ? esc($u['phone']) : '-'; ?></td>

                        <!-- 5. Role -->
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium <?= $badgeRole[$u['role']] ?? 'bg-slate-100 text-slate-600'; ?>">
                                <?= esc(ucfirst($u['role'])); ?>
                            </span>
                        </td>

                        <!-- 6. Status -->
                        <td class="px-6 py-4">
                            <?php $isActive = ($u['is_active'] ?? 1) == 1; ?>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium <?= $isActive ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700'; ?>">
                                <?= $isActive ? 'Aktif' : 'Nonaktif'; ?>
                            </span>
                        </td>

                        <!-- 7. Dibuat Pada -->
                        <td class="px-6 py-4 text-slate-500"><?= $tanggal($u['created_at'] ?? null); ?></td>

                        <!-- 8. Aksi (Selalu dirender dengan wrapper flex agar posisinya stabil) -->
                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex items-center justify-end gap-2">
                                <a href="<?= site_url('users/edit/' . $u['id']); ?>"
                                    class="px-3 py-1.5 text-xs text-slate-700 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                                    Edit
                                </a>

                                <?php if ((string) $u['id'] !== (string) $idLogin) : ?>
                                    <form action="<?= site_url('users/delete/' . $u['id']); ?>" method="post"
                                        onsubmit="return confirm('Hapus user <?= esc($u['username'] ?? 'ini', 'js'); ?>?');" class="inline">
                                        <?= csrf_field(); ?>
                                        <button type="submit"
                                            class="px-3 py-1.5 text-xs text-slate-700 border border-slate-200 rounded-lg hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 transition-colors">
                                            Hapus
                                        </button>
                                    </form>
                                <?php else : ?>
                                    <span class="inline-block w-[52px]"></span>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <div class="h-4"></div>
</section>

<?= $this->endSection() ?>