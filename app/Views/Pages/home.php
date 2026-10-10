<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<?php
$namaUser = session('name') ?? session('username') ?? session('nama') ?? 'Albu';

// Data $users diambil dari controller
$users = $users ?? [];

// Statistik otomatis dihitung dari data database
$stats = [
    'total'     => count($users),
    'aktif'     => count(array_filter($users, fn($u) => (int)($u['is_active'] ?? 0) === 1)),
    'admin'     => count(array_filter($users, fn($u) => ($u['role'] ?? '') === 'admin')),
    'bulan_ini' => count(array_filter($users, fn($u) => !empty($u['created_at']) && date('Y-m', strtotime($u['created_at'])) === date('Y-m'))),
];

$kartu = [
    ['Total User',       $stats['total'],     'bg-indigo-100 text-indigo-600'],
    ['User Aktif',       $stats['aktif'],     'bg-emerald-100 text-emerald-600'],
    ['Admin',            $stats['admin'],     'bg-amber-100 text-amber-600'],
    ['Daftar Bulan Ini', $stats['bulan_ini'], 'bg-sky-100 text-sky-600'],
];

$badgeRole = [
    'admin' => 'bg-amber-100 text-amber-700',
    'user'  => 'bg-slate-100 text-slate-600',
];

$badgeStatus = [
    1 => ['label' => 'Aktif',    'class' => 'bg-emerald-100 text-emerald-700'],
    0 => ['label' => 'Nonaktif', 'class' => 'bg-rose-100 text-rose-700'],
];
?>

<div class="space-y-6">

    <!-- Banner -->
    <section class="rounded-2xl bg-gradient-to-r from-indigo-600 via-blue-500 to-sky-500 px-8 py-8 text-white shadow-lg shadow-indigo-500/20">
        <h2 class="text-2xl font-bold">Halo, <?= esc($namaUser); ?> 👋</h2>
        <p class="mt-1 text-white/90">Selamat datang kembali di dashboard Albu Project.</p>
    </section>

    <!-- Kartu statistik -->
    <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
        <?php foreach ($kartu as [$label, $nilai, $warna]) : ?>
            <div class="bg-white rounded-2xl shadow-sm px-6 py-5 flex items-center gap-4">
                <span class="w-12 h-12 shrink-0 rounded-xl flex items-center justify-center <?= $warna; ?>">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
                <div>
                    <p class="text-sm text-slate-500"><?= esc($label); ?></p>
                    <p class="text-2xl font-bold text-slate-800 leading-tight"><?= (int) $nilai; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <!-- Tabel User -->
    <section class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <h3 class="px-6 py-5 font-semibold text-slate-800">User Terbaru</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 border-y border-slate-100 text-xs font-semibold uppercase text-slate-600">
                    <tr>
                        <th class="px-6 py-3">Username / Nama</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Role</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Terdaftar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (empty($users)) : ?>
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-400">Belum ada user terdaftar.</td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($users as $u) : ?>
                        <?php $statusInfo = $badgeStatus[$u['is_active'] ?? 0] ?? $badgeStatus[0]; ?>
                        <tr>
                            <td class="px-6 py-3.5 font-medium text-slate-800"><?= esc($u['username'] ?? $u['nama'] ?? '-'); ?></td>
                            <td class="px-6 py-3.5 text-slate-500"><?= esc($u['email']); ?></td>
                            <td class="px-6 py-3.5">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium <?= $badgeRole[$u['role'] ?? 'user'] ?? 'bg-slate-100 text-slate-600'; ?>">
                                    <?= esc(ucfirst($u['role'] ?? 'user')); ?>
                                </span>
                            </td>
                            <td class="px-6 py-3.5">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium <?= $statusInfo['class']; ?>">
                                    <?= esc($statusInfo['label']); ?>
                                </span>
                            </td>
                            <td class="px-6 py-3.5 text-slate-500">
                                <?= !empty($u['created_at']) ? date('d M Y', strtotime($u['created_at'])) : '-'; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Isi Session -->
    <section class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <h3 class="px-6 py-5 font-semibold text-slate-800 border-b border-slate-100">Isi Session</h3>
        <pre class="px-6 py-5 text-sm font-mono text-slate-700 overflow-x-auto"><?= esc(print_r(session()->get(), true)); ?></pre>
    </section>

</div>

<?= $this->endSection() ?>