<?php
$current  = '/' . trim(uri_string(), '/');
$loggedIn = (bool) session()->get('isLoggedIn');
$username = session()->get('username') ?? 'Tamu';
$email    = session()->get('email') ?? '';
$initial  = strtoupper(substr($username, 0, 1));

$is = static fn(string $url) => $current === $url || ($url !== '/pages' && str_starts_with($current, $url));

// [label, url, path icon]
$kiri  = [
    ['About',   '/pages/about',   'M16 7a4 4 0 11-8 0 4 4 0 018 0zM4 21a8 8 0 0116 0'],
    ['Contact', '/pages/contact', 'M3 8l9 6 9-6M4 6h16a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7a1 1 0 011-1z'],
];
$kanan = [
    ['Profil',  '/profil',        'M5.1 17.8A9 9 0 1118.9 17.8M12 12a3 3 0 100-6 3 3 0 000 6z'],
];
$item = 'flex flex-col items-center justify-center gap-1 py-2.5 text-xs font-medium transition-colors ';
?>

<!-- Sheet "Lainnya" -->
<div id="more-sheet" class="lg:hidden hidden fixed inset-x-4 bottom-24 z-50 bg-white rounded-2xl shadow-2xl border border-slate-100 p-4">
    <?php if ($loggedIn) : ?>
        <div class="flex items-center gap-3">
            <span class="w-11 h-11 rounded-full bg-indigo-100 text-indigo-600 font-semibold flex items-center justify-center"><?= esc($initial); ?></span>
            <div class="min-w-0">
                <p class="text-sm font-semibold text-slate-900 truncate"><?= esc($username); ?></p>
                <p class="text-xs text-slate-500 truncate"><?= esc($email); ?></p>
            </div>
        </div>
        <a href="/logout" onclick="return confirm('Apakah Anda yakin ingin keluar?');"
            class="mt-4 block text-center px-4 py-2.5 text-sm font-medium text-rose-600 bg-rose-50 hover:bg-rose-500 hover:text-white rounded-lg transition-colors">Logout</a>
    <?php else : ?>
        <a href="/login" class="block text-center px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg">Masuk</a>
    <?php endif; ?>
</div>

<!-- Bottom navigation (HP) -->
<nav class="lg:hidden fixed bottom-0 inset-x-0 z-40 bg-white rounded-t-3xl shadow-[0_-4px_20px_rgba(15,23,42,0.08)] pb-[env(safe-area-inset-bottom)]">
    <!-- Garis gradasi di tepi atas -->
    <div class="absolute top-0 inset-x-6 h-0.5 rounded-full bg-gradient-to-r from-sky-400 to-indigo-700"></div>

    <!-- Tombol tengah: logo -->
    <a href="/pages" aria-label="Beranda"
        class="absolute left-1/2 -top-8 -translate-x-1/2 w-[76px] h-[76px] rounded-full bg-white shadow-xl flex items-center justify-center ring-1 ring-slate-100">
        <span class="w-12 h-12 rounded-xl flex items-center justify-center text-xl font-bold text-white bg-gradient-to-br from-indigo-600 to-sky-500 <?= $current === '/pages' ? 'ring-4 ring-indigo-200' : ''; ?>">A</span>
    </a>

    <div class="grid grid-cols-5">
        <?php foreach ($kiri as [$label, $url, $icon]) : $on = $is($url); ?>
            <a href="<?= $url; ?>" class="<?= $item . ($on ? 'text-indigo-600' : 'text-slate-500'); ?>">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="<?= $on ? 2.2 : 1.8; ?>" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="<?= $icon; ?>" />
                </svg>
                <?= $label; ?>
            </a>
        <?php endforeach; ?>

        <span aria-hidden="true"></span><!-- ruang untuk logo -->

        <?php foreach ($kanan as [$label, $url, $icon]) : $on = $is($url); ?>
            <a href="<?= $url; ?>" class="<?= $item . ($on ? 'text-indigo-600' : 'text-slate-500'); ?>">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="<?= $on ? 2.2 : 1.8; ?>" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="<?= $icon; ?>" />
                </svg>
                <?= $label; ?>
            </a>
        <?php endforeach; ?>

        <button id="more-btn" type="button" class="<?= $item; ?>text-slate-500 focus:outline-none" aria-expanded="false">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            Lainnya
        </button>
    </div>
</nav>

<script>
    (function() {
        const btn = document.getElementById('more-btn');
        const sheet = document.getElementById('more-sheet');
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const open = sheet.classList.toggle('hidden') === false;
            btn.setAttribute('aria-expanded', open);
            btn.classList.toggle('text-indigo-600', open);
        });
        document.addEventListener('click', function(e) {
            if (!sheet.contains(e.target)) {
                sheet.classList.add('hidden');
                btn.setAttribute('aria-expanded', 'false');
                btn.classList.remove('text-indigo-600');
            }
        });
    })();
</script>