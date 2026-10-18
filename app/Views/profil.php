<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<?php
$bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
$formatTanggal = static function ($tgl) use ($bulan) {
    $t = strtotime((string) $tgl);
    return $t ? date('j', $t) . ' ' . $bulan[(int) date('n', $t)] . ' ' . date('Y', $t) : '-';
};

// Ubah nilai database (L / P / Laki-laki / Perempuan) jadi label + warna
$infoJK = static function ($nilai) {
    $v = strtolower(trim((string) $nilai));

    if (in_array($v, ['l', 'laki-laki', 'laki', 'male', '1'], true)) {
        return [
            'label'  => 'Laki-laki',
            'avatar' => 'bg-sky-100 text-sky-700',
            'badge'  => 'bg-sky-50 text-sky-700 ring-1 ring-inset ring-sky-200',
            'dot'    => 'bg-sky-500',
        ];
    }

    if (in_array($v, ['p', 'perempuan', 'female', '2'], true)) {
        return [
            'label'  => 'Perempuan',
            'avatar' => 'bg-pink-100 text-pink-700',
            'badge'  => 'bg-pink-50 text-pink-700 ring-1 ring-inset ring-pink-200',
            'dot'    => 'bg-pink-500',
        ];
    }

    return [
        'label'  => '-',
        'avatar' => 'bg-slate-100 text-slate-500',
        'badge'  => 'bg-slate-50 text-slate-500 ring-1 ring-inset ring-slate-200',
        'dot'    => 'bg-slate-400',
    ];
};

$profil      = $profil ?? [];
$keyword     = $keyword ?? '';
$currentPage = $pager->getCurrentPage('profil') ?: 1;
$perPage     = 7; // samakan dengan paginate(7, 'profil') di controller
$no          = 1 + ($perPage * ($currentPage - 1));
?>

<!-- Header halaman -->
<div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
    <div>
        <h2 class="text-2xl font-bold tracking-tight text-slate-900"><?= esc($title); ?></h2>
        <p class="mt-1 text-sm text-slate-500">Daftar koleksi profil yang tersedia dalam database.</p>
    </div>
    <a href="/profil/create"
        class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14M5 12h14" />
        </svg>
        Tambah profil
    </a>
</div>

<!-- Notifikasi -->
<?php if (session()->getFlashdata('pesan')) : ?>
    <div id="flash" role="status" class="mt-6 flex items-start gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm px-4 py-3 rounded-lg">
        <svg class="w-5 h-5 mt-0.5 shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <p class="flex-1"><?= esc(session()->getFlashdata('pesan')); ?></p>
        <button type="button" onclick="document.getElementById('flash').remove()" class="text-emerald-600 hover:text-emerald-800" aria-label="Tutup notifikasi">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
<?php endif; ?>

<!-- Tabel -->
<div class="mt-6 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

    <div class="px-5 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-200">
        <div class="flex items-baseline gap-2">
            <h3 class="font-semibold text-slate-900">Data profil</h3>
            <span class="text-sm text-slate-500"><?= $pager->getTotal('profil'); ?> data</span>
        </div>

        <form action="/profil" method="get" class="relative w-full sm:w-72">
            <label for="keyword" class="sr-only">Cari profil</label>
            <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input id="keyword" type="text" name="keyword" value="<?= esc($keyword); ?>" placeholder="Cari nama atau alamat"
                class="w-full pl-9 pr-9 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            <?php if ($keyword !== '') : ?>
                <a href="/profil" class="absolute right-2 top-1/2 -translate-y-1/2 p-1 text-slate-400 hover:text-slate-600" aria-label="Hapus pencarian">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            <?php endif; ?>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm table-auto">
            <thead class="bg-slate-50 text-slate-500 text-xs font-medium border-b border-slate-200">
                <tr>
                    <th scope="col" class="py-3 pl-5 pr-3 text-left">No</th>
                    <th scope="col" class="py-3 px-3 text-left">Nama Profil</th>
                    <th scope="col" class="py-3 px-3 hidden md:table-cell text-left">Alamat</th>
                    <th scope="col" class="py-3 px-3 hidden sm:table-cell whitespace-nowrap text-left">Tanggal lahir</th>
                    <th scope="col" class="py-3 px-3 text-left">Jenis kelamin</th>
                    <th scope="col" class="py-3 pl-3 pr-5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-600">
                <?php if (empty($profil)) : ?>
                    <tr>
                        <td colspan="6" class="py-14 px-6 text-center">
                            <p class="font-medium text-slate-900">
                                <?= $keyword !== '' ? 'Profil tidak ditemukan' : 'Belum ada profil'; ?>
                            </p>
                            <p class="mt-1 text-slate-500">
                                <?= $keyword !== '' ? 'Coba kata kunci lain atau hapus pencarian.' : 'Tambahkan profil pertama untuk mulai mengisi daftar ini.'; ?>
                            </p>
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($profil as $k) : ?>
                    <?php
                    $jk      = $infoJK($k['jenis_kelamin'] ?? '');
                    $inisial = strtoupper(mb_substr(trim((string) $k['nama']), 0, 1));
                    ?>
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="py-3.5 pl-5 pr-3 text-slate-400 tabular-nums"><?= $no++; ?></td>

                        <td class="py-3.5 px-3">
                            <div class="flex items-center gap-3">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-sm font-semibold <?= $jk['avatar']; ?>">
                                    <?= esc($inisial); ?>
                                </span>
                                <div class="min-w-0">
                                    <p class="font-medium text-slate-900 truncate"><?= esc($k['nama']); ?></p>
                                    <p class="md:hidden text-xs text-slate-500 truncate max-w-[200px]"><?= esc($k['alamat']); ?></p>
                                </div>
                            </div>
                        </td>

                        <td class="py-3.5 px-3 hidden md:table-cell max-w-xs">
                            <p class="truncate" title="<?= esc($k['alamat']); ?>"><?= esc($k['alamat']); ?></p>
                        </td>

                        <td class="py-3.5 px-3 hidden sm:table-cell whitespace-nowrap tabular-nums">
                            <?= esc($formatTanggal($k['tanggal_lahir'])); ?>
                        </td>

                        <td class="py-3.5 px-3">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium whitespace-nowrap <?= $jk['badge']; ?>">
                                <span class="h-1.5 w-1.5 rounded-full <?= $jk['dot']; ?>"></span>
                                <?= esc($jk['label']); ?>
                            </span>
                        </td>

                        <td class="py-3.5 pl-3 pr-5">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="/profil/edit/<?= esc($k['id'], 'url'); ?>"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 hover:border-slate-300 rounded-lg transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6.768-6.768a2 2 0 112.828 2.828L11.828 15.83a2 2 0 01-.89.513L7 17l.657-3.938a2 2 0 01.513-.89z" />
                                    </svg>
                                    Edit
                                </a>
                                <form action="/profil/<?= esc($k['id'], 'url'); ?>" method="post" class="inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil ini?');">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-rose-600 bg-white border border-rose-200 hover:bg-rose-50 rounded-lg transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-rose-500">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="px-5 py-4 border-t border-slate-200 bg-slate-50/50">
        <?= $pager->links('profil', 'custom_pagination') ?>
    </div>
</div>

<?= $this->endSection() ?>