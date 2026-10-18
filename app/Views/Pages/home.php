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

$persenAktif = $stats['total'] > 0 ? round($stats['aktif'] / $stats['total'] * 100) : 0;

// [label, nilai, warna ikon, keterangan, path ikon]
$kartu = [
    ['Total User',       $stats['total'],     'bg-indigo-100 text-indigo-600',   'Seluruh akun terdaftar',            'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-4.13a4 4 0 100-8 4 4 0 000 8zm6 0a3 3 0 100-6M3 9a3 3 0 106 0'],
    ['User Aktif',       $stats['aktif'],     'bg-emerald-100 text-emerald-600', $persenAktif . '% dari total user',  'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
    ['Admin',            $stats['admin'],     'bg-amber-100 text-amber-600',     'Akses penuh dashboard',             'M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6l8-3z'],
    ['Daftar Bulan Ini', $stats['bulan_ini'], 'bg-sky-100 text-sky-600',         date('F Y'),                         'M12 4v16m8-8H4'],
];

$badgeRole = [
    'admin' => 'bg-amber-50 text-amber-700 ring-amber-200',
    'user'  => 'bg-slate-50 text-slate-600 ring-slate-200',
];

$badgeStatus = [
    1 => ['label' => 'Aktif',    'class' => 'bg-emerald-50 text-emerald-700 ring-emerald-200', 'dot' => 'bg-emerald-500'],
    0 => ['label' => 'Nonaktif', 'class' => 'bg-rose-50 text-rose-700 ring-rose-200',          'dot' => 'bg-rose-500'],
];

// Warna avatar berdasarkan huruf pertama (digunakan jika user tidak punya foto)
$warnaAvatar = ['bg-indigo-500', 'bg-sky-500', 'bg-emerald-500', 'bg-amber-500', 'bg-rose-500', 'bg-violet-500', 'bg-teal-500'];

// Perbaikan sapaan jam dengan zona waktu lokal dan rentang waktu yang sesuai
date_default_timezone_set('Asia/Jakarta');
$jam   = (int) date('G');
$sapa  = match (true) {
    $jam >= 5  && $jam < 11 => 'Selamat pagi',
    $jam >= 11 && $jam < 15 => 'Selamat siang',
    $jam >= 15 && $jam < 18 => 'Selamat sore',
    default                 => 'Selamat malam',
};

$bulan = ['Jan' => 'Jan', 'Feb' => 'Feb', 'Mar' => 'Mar', 'Apr' => 'Apr', 'May' => 'Mei', 'Jun' => 'Jun', 'Jul' => 'Jul', 'Aug' => 'Agu', 'Sep' => 'Sep', 'Oct' => 'Okt', 'Nov' => 'Nov', 'Dec' => 'Des'];
$tgl   = fn($t) => date('d', strtotime($t)) . ' ' . ($bulan[date('M', strtotime($t))] ?? date('M', strtotime($t))) . ' ' . date('Y', strtotime($t));
?>

<style>
    @keyframes dashUp {
        from {
            opacity: 0;
            transform: translateY(16px);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    .dash-up {
        opacity: 0;
        animation: dashUp .6s cubic-bezier(.2, .8, .2, 1) forwards;
        animation-delay: calc(var(--i, 0) * 80ms);
    }

    @media (prefers-reduced-motion: reduce) {
        .dash-up {
            animation: none;
            opacity: 1;
        }
    }
</style>

<div class="space-y-6 min-w-0">

    <!-- Banner -->
    <section class="dash-up relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-blue-600 to-sky-500 px-6 sm:px-10 py-8 sm:py-10 text-white shadow-xl shadow-indigo-500/20" style="--i:0">
        <span class="pointer-events-none absolute -top-16 -right-10 w-64 h-64 rounded-full bg-white/10"></span>
        <span class="pointer-events-none absolute -bottom-20 right-32 w-48 h-48 rounded-full bg-white/10"></span>
        <span class="pointer-events-none absolute inset-0 opacity-30" style="background-image:radial-gradient(rgba(255,255,255,.35) 1px,transparent 1px);background-size:22px 22px;-webkit-mask-image:linear-gradient(to right,transparent,#000);mask-image:linear-gradient(to right,transparent,#000)"></span>

        <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div>
                <p class="text-sm font-medium text-white/80"><?= date('d'); ?> <?= $bulan[date('M')] ?? date('M'); ?> <?= date('Y'); ?></p>
                <h2 class="mt-1 text-2xl sm:text-3xl font-extrabold tracking-tight"><?= $sapa; ?>, <?= esc($namaUser); ?> 👋</h2>
                <p class="mt-2 max-w-md text-white/90 text-sm sm:text-base">Selamat datang kembali di dashboard Albu Project. Berikut ringkasan pengguna hari ini.</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="<?= base_url('/'); ?>" target="_blank" rel="noopener"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-xs font-semibold rounded-xl bg-white text-indigo-600 shadow-md hover:-translate-y-0.5 hover:shadow-lg transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    Lihat Website
                </a>
            </div>
        </div>
    </section>

    <!-- Kartu statistik -->
    <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
        <?php foreach ($kartu as $n => [$label, $nilai, $warna, $ket, $ikon]) : ?>
            <div class="dash-up group bg-white rounded-2xl border border-slate-100 shadow-sm px-6 py-5 flex items-center gap-4 hover:-translate-y-1 hover:shadow-lg hover:border-slate-200 transition duration-300" style="--i:<?= $n + 1; ?>">
                <span class="w-12 h-12 shrink-0 rounded-xl flex items-center justify-center group-hover:scale-110 transition duration-300 <?= $warna; ?>">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="<?= $ikon; ?>" />
                    </svg>
                </span>
                <div class="min-w-0">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500"><?= esc($label); ?></p>
                    <p class="text-3xl font-extrabold text-slate-800 leading-tight"><?= (int) $nilai; ?></p>
                    <p class="text-[11px] text-slate-400 truncate"><?= esc($ket); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <!-- Tabel User -->
    <section class="dash-up bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden" style="--i:5">
        <div class="px-6 py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="font-bold text-slate-800">User Terbaru</h3>
                <p class="text-xs text-slate-500 mt-0.5"><span id="userCount"><?= count($users); ?></span> user ditampilkan</p>
            </div>

            <div class="relative w-full sm:w-72">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7" />
                    <path stroke-linecap="round" d="M21 21l-4.3-4.3" />
                </svg>
                <input id="userSearch" type="search" placeholder="Cari nama, email, atau role…" autocomplete="off"
                    class="w-full pl-10 pr-4 py-2.5 text-xs bg-slate-100/80 border border-transparent rounded-xl placeholder-slate-400 focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/15 transition">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 border-y border-slate-100 text-[11px] font-semibold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-6 py-3">Username / Nama</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Role</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 whitespace-nowrap">Terdaftar</th>
                    </tr>
                </thead>
                <tbody id="userBody" class="divide-y divide-slate-100">
                    <?php if (empty($users)) : ?>
                        <tr>
                            <td colspan="5" class="px-6 py-14 text-center">
                                <div class="mx-auto w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <p class="text-slate-400">Belum ada user terdaftar.</p>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($users as $u) : ?>
                        <?php
                        $nama       = (string) ($u['username'] ?? $u['nama'] ?? '-');
                        $role       = (string) ($u['role'] ?? 'user');
                        $statusInfo = $badgeStatus[(int) ($u['is_active'] ?? 0)] ?? $badgeStatus[0];
                        $inisial    = mb_strtoupper(mb_substr($nama, 0, 1)) ?: '?';
                        $warna      = $warnaAvatar[crc32($nama) % count($warnaAvatar)];

                        // Cek apakah ada kolom foto/avatar di database (sesuaikan nama kolom jika berbeda, misal: 'avatar', 'foto', 'photo')
                        $fotoUser   = $u['avatar'] ?? $u['foto'] ?? $u['photo'] ?? null;
                        ?>
                        <tr class="user-row hover:bg-slate-50/80 transition-colors"
                            data-search="<?= esc(mb_strtolower($nama . ' ' . ($u['email'] ?? '') . ' ' . $role . ' ' . $statusInfo['label']), 'attr'); ?>">
                            <td class="px-6 py-3.5">
                                <div class="flex items-center gap-3">
                                    <?php if (!empty($fotoUser)) : ?>
                                        <!-- Jika user memiliki foto profil -->
                                        <img src="<?= base_url('uploads/users/' . esc($fotoUser)); ?>" alt="<?= esc($nama); ?>" class="w-9 h-9 shrink-0 rounded-full object-cover border border-slate-200">
                                    <?php else : ?>
                                        <!-- Jika tidak ada foto, tampilkan inisial huruf dengan warna background otomatis -->
                                        <span class="w-9 h-9 shrink-0 rounded-full flex items-center justify-center text-xs font-bold text-white <?= $warna; ?>"><?= esc($inisial); ?></span>
                                    <?php endif; ?>
                                    <span class="font-semibold text-slate-800"><?= esc($nama); ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-3.5 text-slate-500"><?= esc($u['email'] ?? '-'); ?></td>
                            <td class="px-6 py-3.5">
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold ring-1 ring-inset <?= $badgeRole[$role] ?? 'bg-slate-50 text-slate-600 ring-slate-200'; ?>">
                                    <?= esc(ucfirst($role)); ?>
                                </span>
                            </td>
                            <td class="px-6 py-3.5">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold ring-1 ring-inset <?= $statusInfo['class']; ?>">
                                    <span class="w-1.5 h-1.5 rounded-full <?= $statusInfo['dot']; ?>"></span>
                                    <?= esc($statusInfo['label']); ?>
                                </span>
                            </td>
                            <td class="px-6 py-3.5 text-slate-500 whitespace-nowrap">
                                <?= !empty($u['created_at']) ? esc($tgl($u['created_at'])) : '-'; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <tr id="noResult" class="hidden">
                        <td colspan="5" class="px-6 py-10 text-center text-slate-400 text-sm">Tidak ada user yang cocok dengan pencarian.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Isi Session (hanya untuk debugging, tidak tampil di production) -->
    <?php if (ENVIRONMENT !== 'production') : ?>
        <details class="dash-up group bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden" style="--i:6">
            <summary class="flex items-center justify-between gap-3 px-6 py-5 cursor-pointer select-none list-none [&::-webkit-details-marker]:hidden">
                <span class="flex items-center gap-3">
                    <span class="w-9 h-9 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l-4 3 4 3m8-6l4 3-4 3m-3-9l-2 12" />
                        </svg>
                    </span>
                    <span>
                        <span class="block font-bold text-slate-800">Isi Session</span>
                        <span class="block text-[11px] text-slate-400">Mode debug, hanya tampil di development</span>
                    </span>
                </span>
                <svg class="w-4 h-4 text-slate-400 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <pre class="px-6 py-5 text-xs font-mono text-slate-100 bg-slate-900 overflow-x-auto"><?= esc(print_r(session()->get(), true)); ?></pre>
        </details>
    <?php endif; ?>

</div>

<script>
    // Pencarian cepat di tabel user
    (() => {
        const input = document.getElementById('userSearch');
        const rows = [...document.querySelectorAll('#userBody .user-row')];
        const none = document.getElementById('noResult');
        const count = document.getElementById('userCount');
        if (!input || !rows.length) return;

        input.addEventListener('input', () => {
            const q = input.value.trim().toLowerCase();
            let shown = 0;
            rows.forEach(r => {
                const hit = !q || r.dataset.search.includes(q);
                r.classList.toggle('hidden', !hit);
                if (hit) shown++;
            });
            none.classList.toggle('hidden', shown !== 0);
            count.textContent = shown;
        });
    })();
</script>

<?= $this->endSection() ?>