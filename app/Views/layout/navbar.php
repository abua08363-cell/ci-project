<?php
$current  = '/' . trim(uri_string(), '/');
$loggedIn = (bool) session()->get('isLoggedIn');
$userId   = session()->get('user_id') ?? session()->get('id');

$dbUser = null;
if ($loggedIn && $userId) {
    $userModel = new \App\Models\UserModel();
    $dbUser    = $userModel->find($userId);
}

$username = $dbUser['username'] ?? session()->get('username') ?? 'Tamu';
$email    = $dbUser['email'] ?? session()->get('email') ?? '';
$initial  = strtoupper(substr($username, 0, 1));

$foto = $dbUser['photo'] ?? '';
$foto = trim((string)$foto);

$hasValidFoto = false;
if ($foto !== '' && strtolower($foto) !== 'foto' && strtolower($foto) !== 'photo' && preg_match('/\.(jpg|jpeg|png|webp|gif)$/i', $foto)) {
    if (is_file(FCPATH . 'uploads/users/' . $foto)) {
        $hasValidFoto = true;
    }
}

$is = static fn(string $url) => $current === $url || ($url !== '/pages' && str_starts_with($current, $url));

$kiri  = [
    ['About',   '/pages/about',   'M16 7a4 4 0 11-8 0 4 4 0 018 0zM4 21a8 8 0 0116 0'],
    ['Contact', '/pages/contact', 'M3 8l9 6 9-6M4 6h16a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7a1 1 0 011-1z'],
];
$kanan = [
    ['Profil',  '/profil',        'M5.1 17.8A9 9 0 1118.9 17.8M12 12a3 3 0 100-6 3 3 0 000 6z'],
];
$item = 'flex flex-col items-center justify-center gap-1 py-2.5 text-xs font-medium transition-colors ';

$iconUsers  = 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z';
$usersAktif = $loggedIn && $is('/users');

$iconDash      = 'M3 12l9-9 9 9M5 10v10h5v-6h4v6h5V10';
$dashAktif     = $loggedIn && ($current === '/pages' || $current === '/');
$articlesAktif = $loggedIn && $is('/admin/articles');
$lainnyaAktif  = $usersAktif || $dashAktif || $articlesAktif;
?>

<!-- 1. HEADER ATAS (Hanya tampil di Desktop/Laptop via lg:flex, di HP disembunyikan lewat flex lg:flex) -->
<header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 sticky py-4 top-0 z-30 shadow-sm">
    <div class="flex items-center gap-3">
        <h1 class="text-lg font-semibold text-slate-800"><?= esc($title ?? 'Dashboard'); ?></h1>
    </div>

    <div class="flex items-center gap-4">
        <div class="text-right hidden sm:block">
            <p class="text-sm font-medium text-slate-900"><?= esc($username); ?></p>
            <p class="text-xs text-slate-500"><?= esc($email); ?></p>
        </div>

        <!-- FOTO PROFIL NAVBAR ATAS -->
        <?php if ($hasValidFoto) : ?>
            <img src="/uploads/users/<?= esc($foto); ?>" alt="Foto Profil" class="w-10 h-10 rounded-full object-cover ring-2 ring-indigo-50">
        <?php else : ?>
            <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 font-bold flex items-center justify-center ring-2 ring-indigo-50">
                <?= esc($initial); ?>
            </div>
        <?php endif; ?>

        <!-- TOMBOL LOGOUT HANYA MUNCUL DI DESKTOP (hidden lg:inline-block) -->
        <a href="/logout" onclick="return confirm('Apakah Anda yakin ingin keluar?');"
            class="hidden lg:inline-block px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 hover:bg-red-400 hover:text-white rounded-lg transition-colors">
            Logout
        </a>
    </div>
</header>

<!-- 2. SHEET POP-UP "LAINNYA" (MOBILE) -->
<div id="more-sheet" class="lg:hidden hidden fixed inset-x-4 bottom-24 z-50 bg-white rounded-2xl shadow-2xl border border-slate-100 p-4">
    <?php if ($loggedIn) : ?>
        <div class="flex items-center gap-3 border-b border-slate-100 pb-3">
            <?php if ($hasValidFoto) : ?>
                <img src="/uploads/users/<?= esc($foto); ?>" alt="Foto Profil" class="w-11 h-11 rounded-full object-cover">
            <?php else : ?>
                <span class="w-11 h-11 rounded-full bg-indigo-100 text-indigo-600 font-semibold flex items-center justify-center"><?= esc($initial); ?></span>
            <?php endif; ?>

            <div class="min-w-0">
                <p class="text-sm font-semibold text-slate-900 truncate"><?= esc($username); ?></p>
                <p class="text-xs text-slate-500 truncate"><?= esc($email); ?></p>
            </div>
        </div>

        <a href="/pages"
            class="mt-3 flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-lg transition-colors <?= $dashAktif ? 'bg-indigo-50 text-indigo-600' : 'text-slate-700 hover:bg-slate-50'; ?>">
            <svg class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" stroke-width="<?= $dashAktif ? 2.2 : 1.8; ?>" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="<?= $iconDash; ?>" />
            </svg>
            Dashboard
        </a>

        <a href="/users"
            class="mt-1 flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-lg transition-colors <?= $usersAktif ? 'bg-indigo-50 text-indigo-600' : 'text-slate-700 hover:bg-slate-50'; ?>">
            <svg class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" stroke-width="<?= $usersAktif ? 2.2 : 1.8; ?>" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="<?= $iconUsers; ?>" />
            </svg>
            Users
        </a>

        <a href="/admin/articles"
            class="mt-1 flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-lg transition-colors <?= $articlesAktif ? 'bg-indigo-50 text-indigo-600' : 'text-slate-700 hover:bg-slate-50'; ?>">
            <svg class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6m-6 4h10" />
            </svg>
            Articles
        </a>

        <!-- TOMBOL LOGOUT KHUSUS MOBILE DI DALAM SHEET -->
        <a href="/logout" onclick="return confirm('Apakah Anda yakin ingin keluar?');"
            class="mt-3 block text-center px-4 py-2.5 text-sm font-medium text-rose-600 bg-rose-50 hover:bg-rose-500 hover:text-white rounded-lg transition-colors">Logout</a>
    <?php else : ?>
        <a href="/login" class="block text-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg">Masuk</a>
    <?php endif; ?>
</div>

<!-- 3. BOTTOM NAVIGATION (MOBILE) -->
<nav class="lg:hidden fixed bottom-0 inset-x-0 z-40 bg-white rounded-t-3xl shadow-[0_-4px_20px_rgba(15,23,42,0.08)] pb-[env(safe-area-inset-bottom)]">
    <div class="absolute top-0 inset-x-6 h-0.5 rounded-full bg-gradient-to-r from-sky-400 to-indigo-700"></div>

    <a href="/pages" aria-label="Beranda"
        class="absolute left-1/2 -top-8 -translate-x-1/2 w-[76px] h-[76px] rounded-full bg-white shadow-xl flex items-center justify-center ring-1 ring-slate-100 z-30">
        <span class="w-12 h-12 rounded-xl flex items-center justify-center text-xl font-bold text-white bg-gradient-to-br from-indigo-600 to-sky-500 <?= $current === '/pages' ? 'ring-4 ring-indigo-200' : ''; ?>">A</span>
    </a>

    <div class="grid grid-cols-5 relative z-20">
        <?php foreach ($kiri as [$label, $url, $icon]) : $on = $is($url); ?>
            <a href="<?= $url; ?>" class="<?= $item . ($on ? 'text-indigo-600' : 'text-slate-500'); ?>">
                <svg class="w-6 h-6 pointer-events-none" fill="none" stroke="currentColor" stroke-width="<?= $on ? 2.2 : 1.8; ?>" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="<?= $icon; ?>" />
                </svg>
                <?= $label; ?>
            </a>
        <?php endforeach; ?>

        <span aria-hidden="true"></span>

        <?php foreach ($kanan as [$label, $url, $icon]) : $on = $is($url); ?>
            <a href="<?= $url; ?>" class="<?= $item . ($on ? 'text-indigo-600' : 'text-slate-500'); ?>">
                <svg class="w-6 h-6 pointer-events-none" fill="none" stroke="currentColor" stroke-width="<?= $on ? 2.2 : 1.8; ?>" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="<?= $icon; ?>" />
                </svg>
                <?= $label; ?>
            </a>
        <?php endforeach; ?>

        <!-- TOMBOL LAINNYA DIBERI z-50 DAN relative AGAR BISA DIKLIK -->
        <button id="more-btn" type="button" data-active="<?= $lainnyaAktif ? '1' : '0'; ?>"
            class="<?= $item . ($lainnyaAktif ? 'text-indigo-600' : 'text-slate-500'); ?> focus:outline-none cursor-pointer relative z-50" aria-expanded="false">
            <svg class="w-6 h-6 pointer-events-none" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span class="pointer-events-none">Lainnya</span>
        </button>
    </div>
</nav>

<script>
    (function() {
        const btn = document.getElementById('more-btn');
        const sheet = document.getElementById('more-sheet');
        if (!btn || !sheet) return;

        const aktif = btn.dataset.active === '1';

        const warna = (open) => {
            btn.classList.toggle('text-indigo-600', open || aktif);
            btn.classList.toggle('text-slate-500', !(open || aktif));
        };

        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const open = sheet.classList.toggle('hidden') === false;
            btn.setAttribute('aria-expanded', open);
            warna(open);
        });

        sheet.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        document.addEventListener('click', function(e) {
            if (!sheet.contains(e.target) && !btn.contains(e.target)) {
                sheet.classList.add('hidden');
                btn.setAttribute('aria-expanded', 'false');
                warna(false);
            }
        });
    })();
</script>