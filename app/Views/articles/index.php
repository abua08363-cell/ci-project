<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php
// Hitung statistik ringkas untuk header
$articlesArr  = is_array($articles) ? $articles : [];
$totalArt     = count($articlesArr);
$totalPub     = count(array_filter($articlesArr, fn($a) => ($a['status'] ?? '') === 'published'));
$totalDraft   = count(array_filter($articlesArr, fn($a) => ($a['status'] ?? '') === 'draft'));

// Format Tanggal Indonesia
$bulan = ['Jan' => 'Jan', 'Feb' => 'Feb', 'Mar' => 'Mar', 'Apr' => 'Apr', 'May' => 'Mei', 'Jun' => 'Jun', 'Jul' => 'Jul', 'Aug' => 'Agu', 'Sep' => 'Sep', 'Oct' => 'Okt', 'Nov' => 'Nov', 'Dec' => 'Des'];
$fmtTgl = fn($t) => date('d', strtotime($t)) . ' ' . ($bulan[date('M', strtotime($t))] ?? date('M', strtotime($t))) . ' ' . date('Y', strtotime($t));
?>

<div class="max-w-7xl mx-auto space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <div class="flex items-center gap-2">
                <h1 class="text-xl font-bold text-slate-900">Manajemen Artikel</h1>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-600 border border-indigo-100">
                    <?= $totalArt; ?> Total
                </span>
            </div>
            <p class="text-xs text-slate-500 mt-1">Kelola, sunting, dan terbitkan postingan artikel ke halaman utama website.</p>
        </div>

        <div class="flex items-center gap-3">
            <!-- Tombol Tambah: Hanya tampil jika role admin -->
            <?php if (session()->get('role') === 'admin') : ?>
                <a href="<?= base_url('/admin/articles/create'); ?>" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold shadow-md shadow-indigo-500/20 hover:shadow-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Artikel Baru
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Mini Cards Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Total Artikel</p>
                <p class="text-2xl font-bold text-slate-800 mt-0.5"><?= $totalArt; ?></p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Published</p>
                <p class="text-2xl font-bold text-emerald-600 mt-0.5"><?= $totalPub; ?></p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Draft</p>
                <p class="text-2xl font-bold text-amber-600 mt-0.5"><?= $totalDraft; ?></p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Alert Notifikasi Flashdata -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl text-xs font-medium flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span><?= session()->getFlashdata('success'); ?></span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800">&times;</button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl text-xs font-medium flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span><?= session()->getFlashdata('error'); ?></span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800">&times;</button>
        </div>
    <?php endif; ?>

    <!-- Tabel Artikel dengan Filter & Pencarian -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

        <!-- Filter Bar -->
        <div class="p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100">
            <!-- Form Pencarian -->
            <div class="relative w-full sm:w-80">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7" />
                    <path stroke-linecap="round" d="M21 21l-4.3-4.3" />
                </svg>
                <input id="articleSearch" type="search" placeholder="Cari judul atau kategori..." autocomplete="off"
                    class="w-full pl-10 pr-4 py-2 text-xs bg-slate-50 border border-slate-200/80 rounded-xl placeholder-slate-400 focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition">
            </div>

            <!-- Filter Status -->
            <div class="flex items-center gap-2">
                <select id="statusFilter" class="px-3 py-2 text-xs bg-slate-50 border border-slate-200/80 rounded-xl text-slate-700 focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition">
                    <option value="">Semua Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Artikel</th>
                        <th class="py-3.5 px-5">Kategori</th>
                        <th class="py-3.5 px-5">Status</th>
                        <th class="py-3.5 px-5 whitespace-nowrap">Tanggal Buat</th>
                        <th class="py-3.5 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="articleBody" class="divide-y divide-slate-100 text-xs">
                    <?php if (!empty($articles) && is_array($articles)) : ?>
                        <?php foreach ($articles as $article) : ?>
                            <?php
                            $title     = (string) ($article['title'] ?? '-');
                            $category  = (string) ($article['category'] ?? 'Umum');
                            $status    = (string) ($article['status'] ?? 'draft');
                            $image     = $article['image'] ?? $article['cover'] ?? $article['thumbnail'] ?? null;
                            ?>
                            <tr class="article-row hover:bg-slate-50/80 transition-colors"
                                data-search="<?= esc(mb_strtolower($title . ' ' . $category . ' ' . $status), 'attr'); ?>"
                                data-status="<?= esc($status, 'attr'); ?>">

                                <!-- Judul & Gambar Sampul -->
                                <td class="py-4 px-6 font-medium text-slate-800">
                                    <div class="flex items-center gap-3 min-w-[220px]">
                                        <?php if (!empty($image)) : ?>
                                            <img src="<?= base_url('uploads/articles/' . esc($image)); ?>" alt="<?= esc($title); ?>" class="w-10 h-10 shrink-0 rounded-lg object-cover border border-slate-200">
                                        <?php else : ?>
                                            <div class="w-10 h-10 shrink-0 rounded-lg bg-indigo-50 text-indigo-500 flex items-center justify-center font-bold border border-indigo-100">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                        <div class="min-w-0">
                                            <p class="font-semibold text-slate-900 truncate max-w-xs" title="<?= esc($title); ?>"><?= esc($title); ?></p>
                                            <p class="text-[11px] text-slate-400 truncate mt-0.5">ID: #<?= esc($article['id'] ?? '-'); ?></p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Kategori -->
                                <td class="py-4 px-5 whitespace-nowrap">
                                    <span class="inline-block px-2.5 py-1 bg-slate-100 text-slate-700 rounded-md text-[11px] font-semibold border border-slate-200/60">
                                        <?= esc($category); ?>
                                    </span>
                                </td>

                                <!-- Status -->
                                <td class="py-4 px-5 whitespace-nowrap">
                                    <?php if ($status === 'published') : ?>
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-full text-[11px] font-semibold ring-1 ring-inset ring-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Published
                                        </span>
                                    <?php else : ?>
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-amber-50 text-amber-700 rounded-full text-[11px] font-semibold ring-1 ring-inset ring-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Draft
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <!-- Tanggal Buat -->
                                <td class="py-4 px-5 text-slate-500 whitespace-nowrap">
                                    <?= !empty($article['created_at']) ? esc($fmtTgl($article['created_at'])) : '-'; ?>
                                </td>

                                <!-- Aksi -->
                                <td class="py-4 px-6 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-1">
                                        <?php if (session()->get('role') === 'admin') : ?>
                                            <!-- Tombol Edit (Hanya Admin) -->
                                            <a href="<?= base_url('/admin/articles/edit/' . $article['id']); ?>" class="p-2 text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition" title="Edit Artikel">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <!-- Tombol Hapus (Hanya Admin) -->
                                            <form action="<?= base_url('/admin/articles/delete/' . $article['id']); ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');" class="inline">
                                                <?= csrf_field(); ?>
                                                <button type="submit" class="p-2 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition" title="Hapus Artikel">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        <?php else : ?>
                                            <!-- Akses User Biasa -->
                                            <span class="text-slate-400 italic text-[11px] bg-slate-100 px-2.5 py-1 rounded-md">Lihat Saja</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr id="emptyInitial">
                            <td colspan="5" class="py-14 text-center">
                                <div class="mx-auto w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                                <p class="text-slate-500 font-medium">Belum ada artikel yang tersedia.</p>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <tr id="noResult" class="hidden">
                        <td colspan="5" class="py-10 text-center text-slate-400 text-xs">
                            Tidak ada artikel yang cocok dengan pencarian atau filter.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Fitur Live Search & Filter Status
    (() => {
        const searchInput = document.getElementById('articleSearch');
        const statusFilter = document.getElementById('statusFilter');
        const rows = [...document.querySelectorAll('#articleBody .article-row')];
        const noResult = document.getElementById('noResult');

        if (!rows.length) return;

        function filterArticles() {
            const query = searchInput.value.trim().toLowerCase();
            const selectedStatus = statusFilter.value;
            let count = 0;

            rows.forEach(row => {
                const searchMatch = !query || row.dataset.search.includes(query);
                const statusMatch = !selectedStatus || row.dataset.status === selectedStatus;

                if (searchMatch && statusMatch) {
                    row.classList.remove('hidden');
                    count++;
                } else {
                    row.classList.add('hidden');
                }
            });

            if (noResult) {
                noResult.classList.toggle('hidden', count !== 0);
            }
        }

        if (searchInput) searchInput.addEventListener('input', filterArticles);
        if (statusFilter) statusFilter.addEventListener('change', filterArticles);
    })();
</script>

<?= $this->endSection(); ?>