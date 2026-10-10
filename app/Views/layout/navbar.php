<?php
$username = session()->get('username') ?? 'Tamu';
$email    = session()->get('email') ?? '';
$initial  = strtoupper(substr($username, 0, 1));
?>
<header class="h-[72px] bg-white border-b border-slate-200 px-4 sm:px-10 py-9 flex items-center justify-between sticky top-0 z-20 my-0.5">
    <h1 class="text-lg font-semibold text-slate-900"><?= esc($title ?? 'Dashboard'); ?></h1>

    <?php if (session()->get('isLoggedIn')) : ?>
        <div class="flex items-center gap-3">
            <div class="hidden sm:block text-right leading-tight">
                <p class="text-sm font-semibold text-slate-900"><?= esc($username); ?></p>
                <p class="text-sm text-slate-500"><?= esc($email); ?></p>
            </div>
            <span class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 font-semibold flex items-center justify-center"><?= esc($initial); ?></span>
            <!-- Di HP, Logout ada di menu "Lainnya" -->
            <a href="/logout" onclick="return confirm('Apakah Anda yakin ingin keluar?');"
                class="hidden lg:inline-block px-4 py-2 text-sm text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-red-400 hover:text-white transition-colors">Logout</a>
        </div>
    <?php endif; ?>
</header>