<?php
// Menu sidebar: [label, url, path icon]
$menu = [
    ['Home',     '/pages',         'M3 12l9-9 9 9M5 10v10h5v-6h4v6h5V10'],
    ['About Me', '/pages/about',   'M16 7a4 4 0 11-8 0 4 4 0 018 0zM4 21a8 8 0 0116 0'],
    ['Contact',  '/pages/contact', 'M3 8l9 6 9-6M4 6h16a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7a1 1 0 011-1z'],
    ['Profil',   '/profil',        'M5.1 17.8A9 9 0 1118.9 17.8M12 12a3 3 0 100-6 3 3 0 000 6z'],
];
$current = '/' . trim(uri_string(), '/');
?>
<aside id="sidebar" class="hidden lg:flex fixed inset-y-0 left-0 z-40 w-64 bg-slate-900 text-slate-300 flex-col">
    <a href="/pages" class="h-[72px] flex items-center gap-3 px-6 border-b border-slate-800">
        <span class="w-9 h-9 rounded-lg bg-indigo-600 text-white font-bold flex items-center justify-center">A</span>
        <span class="text-lg font-semibold text-white">Albu Project</span>
    </a>

    <nav class="flex-1 p-3 space-y-1 text-sm">
        <?php foreach ($menu as [$label, $url, $icon]) :
            $active = ($current === $url) || ($url !== '/pages' && str_starts_with($current, $url)); ?>
            <a href="<?= $url; ?>"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors <?= $active ? 'bg-slate-800 text-white' : 'hover:bg-slate-800/60 hover:text-white'; ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="<?= $icon; ?>" />
                </svg>
                <?= $label; ?>
            </a>
        <?php endforeach; ?>
    </nav>
</aside>