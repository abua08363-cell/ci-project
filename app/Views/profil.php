<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- Banner -->
<div class="rounded-2xl bg-gradient-to-r from-indigo-600 via-blue-500 to-sky-500 px-8 py-7 text-white shadow-lg shadow-indigo-500/20">
    <h2 class="text-2xl font-bold"><?= esc($title); ?></h2>
    <p class="mt-1 text-white/90">Daftar koleksi profil yang tersedia dalam database.</p>
</div>

<!-- Notifikasi -->
<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="mt-6 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-4 py-3 rounded-xl">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
<?php endif; ?>

<!-- Kartu tabel -->
<div class="mt-6 bg-white rounded-2xl shadow-sm overflow-hidden">

    <div class="px-6 py-5 flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-100">
        <h3 class="font-semibold text-slate-900">Data Profil</h3>

        <div class="flex flex-col sm:flex-row gap-3">
            <form action="/profil" method="get" class="relative min-w-[240px]">
                <input type="text" name="keyword" value="<?= esc($keyword ?? ''); ?>" placeholder="Cari profil..."
                    class="w-full pl-9 pr-3 py-2 bg-white border border-slate-200 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <button type="submit" class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 hover:text-indigo-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>
            <a href="/profil/create" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                + Tambah Profil
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-xs font-semibold uppercase text-slate-500 border border-slate-200">
                <tr>
                    <th class="py-3 px-6">No</th>
                    <th class="py-3 px-6">Nama</th>
                    <th class="py-3 px-6">Alamat</th>
                    <th class="py-3 px-6">Tanggal Lahir</th>
                    <th class="py-3 px-6">Jenis Kelamin</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-600">
                <?php
                $currentPage = $pager->getCurrentPage('profil');
                $no = 1 + (7 * ($currentPage - 1));
                ?>
                <?php foreach ($profil as $k) : ?>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-6"><?= $no++; ?></td>
                        <td class="py-4 px-6 font-medium text-slate-900"><?= esc($k['nama']); ?></td>
                        <td class="py-4 px-6"><?= esc($k['alamat']); ?></td>
                        <td class="py-4 px-6 text-center"><?= esc($k['tanggal_lahir']); ?></td>
                        <td class="py-4 px-6 text-center">
                            <?php $l = strtolower($k['jenis_kelamin']) === 'laki-laki'; ?>
                            <span class="px-2.5 py-0.5 rounded-full font-medium <?= $l ? 'bg-sky-100 text-sky-700' : 'bg-pink-100 text-pink-700'; ?>">
                                <?= esc($k['jenis_kelamin']); ?>
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-2">
                                <a href="/profil/edit/<?= $k['id']; ?>" class="px-3 py-1.5 bg-amber-100 text-amber-700 hover:bg-amber-200 text-xs font-medium rounded-lg transition-colors">Edit</a>
                                <form action="/profil/<?= $k['id']; ?>" method="post" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil ini?');">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="px-3 py-1.5 bg-rose-50 text-rose-600 hover:bg-rose-100 border border-rose-200 text-xs font-medium rounded-lg transition-colors">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-slate-100">
        <?= $pager->links('profil', 'custom_pagination') ?>
    </div>
</div>

<?= $this->endSection() ?>