<?php
// Estimasi waktu baca (±200 kata/menit)
$plain       = strip_tags($article['content']);
$readMinutes = max(1, (int) ceil(str_word_count($plain) / 200));
$excerpt     = mb_strimwidth(trim(preg_replace('/\s+/', ' ', $plain)), 0, 155, '…');
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title); ?> | Albu Project</title>
    <meta name="description" content="<?= esc($excerpt); ?>">
    <meta property="og:title" content="<?= esc($article['title']); ?>">
    <meta property="og:description" content="<?= esc($excerpt); ?>">
    <?php if (!empty($article['image'])): ?>
        <meta property="og:image" content="<?= base_url('uploads/articles/' . esc($article['image'], 'url')); ?>">
    <?php endif; ?>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb'
                    },
                    fontFamily: {
                        sans: ['Montserrat', 'ui-sans-serif', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <!-- Tema sama dengan beranda (disimpan di localStorage) -->
    <script>
        try {
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        } catch (e) {}
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        html,
        body {
            max-width: 100%;
            overflow-x: clip;
        }

        #scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            width: 100%;
            background: linear-gradient(90deg, #2563eb, #38bdf8, #818cf8);
            transform: scaleX(0);
            transform-origin: left;
            z-index: 100;
            pointer-events: none;
        }

        /* Isi artikel: paragraf nyaman dibaca */
        .article-body {
            font-size: 1.0625rem;
            line-height: 1.9;
            overflow-wrap: anywhere;
        }

        .article-body> :first-child::first-letter {
            float: left;
            font-size: 3.6rem;
            line-height: .85;
            font-weight: 800;
            padding: .3rem .6rem 0 0;
            color: #2563eb;
        }

        /* Animasi masuk */
        @keyframes up {
            from {
                opacity: 0;
                transform: translateY(22px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .up {
            opacity: 0;
            animation: up .8s cubic-bezier(.2, .8, .2, 1) forwards;
            animation-delay: calc(var(--s, 0) * 110ms);
        }

        @media (prefers-reduced-motion: reduce) {
            .up {
                animation: none;
                opacity: 1;
            }
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-700 dark:bg-[#090d16] dark:text-zinc-300 font-sans antialiased min-h-screen flex flex-col transition-colors duration-300 selection:bg-primary selection:text-white">

    <div id="scroll-progress"></div>

    <!-- NAVBAR -->
    <header class="sticky top-0 z-50 bg-white/80 dark:bg-[#090d16]/80 backdrop-blur-md border-b border-slate-200/80 dark:border-zinc-800/80">
        <div class="max-w-5xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="<?= base_url('/'); ?>" class="text-lg font-extrabold text-slate-900 dark:text-white tracking-tight">Albu Project<span class="text-primary">.</span></a>

            <div class="flex items-center gap-3">
                <a href="<?= base_url('/#articles'); ?>" class="hidden sm:inline-flex items-center gap-2 text-xs font-semibold text-slate-600 dark:text-zinc-400 hover:text-primary transition">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i> Semua Artikel
                </a>
                <button id="theme-toggle" aria-label="Ganti tema" class="w-10 h-10 rounded-full flex items-center justify-center text-slate-600 dark:text-zinc-300 bg-slate-100 dark:bg-zinc-900 hover:bg-slate-200 dark:hover:bg-zinc-800 transition">
                    <i id="theme-icon" class="fa-regular fa-moon text-sm"></i>
                </button>
            </div>
        </div>
    </header>

    <main class="flex-1 py-10 sm:py-14 px-6">
        <div class="max-w-3xl mx-auto min-w-0">

            <!-- Breadcrumb -->
            <nav class="up mb-8 flex items-center gap-2 text-xs text-slate-500 dark:text-zinc-500" style="--s:0" aria-label="Breadcrumb">
                <a href="<?= base_url('/'); ?>" class="hover:text-primary transition">Beranda</a>
                <i class="fa-solid fa-chevron-right text-[8px]"></i>
                <a href="<?= base_url('/#articles'); ?>" class="hover:text-primary transition">Artikel</a>
                <i class="fa-solid fa-chevron-right text-[8px]"></i>
                <span class="truncate text-slate-700 dark:text-zinc-300"><?= esc($article['category']); ?></span>
            </nav>

            <article>
                <!-- Header artikel -->
                <header class="mb-8">
                    <span class="up inline-block px-3 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400 text-[11px] font-semibold border border-indigo-100 dark:border-indigo-900/50" style="--s:1">
                        <?= esc($article['category']); ?>
                    </span>

                    <h1 class="up mt-4 text-3xl sm:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight" style="--s:2">
                        <?= esc($article['title']); ?>
                    </h1>

                    <div class="up mt-6 flex flex-wrap items-center gap-x-5 gap-y-2 text-xs text-slate-500 dark:text-zinc-400" style="--s:3">
                        <span class="inline-flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center text-xs font-bold">MA</span>
                            <span class="font-semibold text-slate-700 dark:text-zinc-200">Muhamad Albuhori</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5"><i class="fa-regular fa-calendar"></i><?= date('d M Y', strtotime($article['created_at'])); ?></span>
                        <span class="inline-flex items-center gap-1.5"><i class="fa-regular fa-clock"></i><?= $readMinutes; ?> menit baca</span>
                    </div>
                </header>

                <!-- Gambar sampul -->
                <?php if (!empty($article['image'])): ?>
                    <figure class="up mb-10 rounded-3xl overflow-hidden bg-slate-100 dark:bg-zinc-800 border border-slate-200/80 dark:border-zinc-800 shadow-lg" style="--s:4">
                        <img src="<?= base_url('uploads/articles/' . esc($article['image'], 'url')); ?>"
                            alt="<?= esc($article['title']); ?>"
                            class="w-full h-64 sm:h-[26rem] object-cover">
                    </figure>
                <?php endif; ?>

                <!-- Isi artikel -->
                <div class="up rounded-3xl bg-white dark:bg-zinc-900/70 border border-slate-200/80 dark:border-zinc-800 p-6 sm:p-10 shadow-sm" style="--s:5">
                    <div class="article-body text-slate-700 dark:text-zinc-300">
                        <?= nl2br(esc($article['content'])); ?>
                    </div>

                    <!-- Bagikan -->
                    <div class="mt-10 pt-6 border-t border-slate-100 dark:border-zinc-800 flex flex-wrap items-center justify-between gap-4">
                        <p class="text-xs font-semibold text-slate-700 dark:text-zinc-300">Bagikan artikel ini</p>
                        <div class="flex items-center gap-2 text-base">
                            <a href="https://wa.me/?text=<?= rawurlencode($article['title'] . ' ' . current_url()); ?>"
                                target="_blank" rel="noopener noreferrer" aria-label="Bagikan ke WhatsApp" title="WhatsApp"
                                class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-zinc-800 text-slate-600 dark:text-zinc-400 flex items-center justify-center hover:bg-emerald-500 hover:text-white dark:hover:bg-emerald-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary transition">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text=<?= rawurlencode($article['title']); ?>&url=<?= rawurlencode(current_url()); ?>"
                                target="_blank" rel="noopener noreferrer" aria-label="Bagikan ke X" title="X"
                                class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-zinc-800 text-slate-600 dark:text-zinc-400 flex items-center justify-center hover:bg-slate-900 hover:text-white dark:hover:bg-white dark:hover:text-slate-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary transition">
                                <!-- Ikon X (SVG inline, tidak bergantung versi Font Awesome) -->
                                <svg viewBox="0 0 24 24" class="w-4 h-4 fill-current" aria-hidden="true">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                </svg>
                            </a>
                            <button id="copy-link" type="button" data-url="<?= esc(current_url(), 'attr'); ?>" aria-label="Salin tautan"
                                class="h-10 px-4 rounded-xl bg-slate-100 dark:bg-zinc-800 text-slate-600 dark:text-zinc-400 text-xs font-semibold inline-flex items-center gap-2 hover:bg-primary hover:text-white dark:hover:bg-primary focus:outline-none focus-visible:ring-2 focus-visible:ring-primary transition">
                                <i class="fa-regular fa-copy"></i> <span id="copy-label">Salin Link</span>
                            </button>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Navigasi bawah -->
            <div class="mt-10 flex justify-center">
                <a href="<?= base_url('/#articles'); ?>" class="px-6 py-3 bg-slate-900 dark:bg-white text-white dark:text-slate-900 text-xs font-semibold rounded-xl inline-flex items-center gap-2 hover:bg-primary dark:hover:bg-primary dark:hover:text-white transition shadow-md">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="py-8 bg-white dark:bg-zinc-950 border-t border-slate-200/80 dark:border-zinc-900 text-xs text-slate-500">
        <div class="max-w-5xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p>&copy; <?= date('Y'); ?> Muhamad Albuhori. All rights reserved.</p>
            <p class="flex items-center gap-1.5">Made with <i class="fa-solid fa-heart text-red-500"></i> using CodeIgniter 4 &amp; Tailwind CSS</p>
        </div>
    </footer>

    <button id="to-top" aria-label="Ke atas" class="fixed bottom-6 right-6 w-11 h-11 rounded-full bg-primary text-white shadow-lg flex items-center justify-center opacity-0 pointer-events-none translate-y-2 transition hover:bg-blue-700">
        <i class="fa-solid fa-arrow-up text-sm"></i>
    </button>

    <script>
        const html = document.documentElement;
        const icon = document.getElementById('theme-icon');
        const setIcon = () => {
            icon.className = html.classList.contains('dark') ? 'fa-regular fa-sun text-sm' : 'fa-regular fa-moon text-sm';
        };
        setIcon();
        document.getElementById('theme-toggle').addEventListener('click', () => {
            html.classList.toggle('dark');
            try {
                localStorage.theme = html.classList.contains('dark') ? 'dark' : 'light';
            } catch (e) {}
            setIcon();
        });

        // Progress bar + tombol ke atas
        const bar = document.getElementById('scroll-progress');
        const top = document.getElementById('to-top');
        const onScroll = () => {
            const max = document.documentElement.scrollHeight - innerHeight;
            bar.style.transform = `scaleX(${max > 0 ? scrollY / max : 0})`;
            const show = scrollY > 400;
            top.classList.toggle('opacity-0', !show);
            top.classList.toggle('pointer-events-none', !show);
            top.classList.toggle('translate-y-2', !show);
        };
        addEventListener('scroll', onScroll, {
            passive: true
        });
        onScroll();
        top.addEventListener('click', () => scrollTo({
            top: 0,
            behavior: 'smooth'
        }));

        // Bagikan
        const copyBtn = document.getElementById('copy-link');
        const copyLabel = document.getElementById('copy-label');
        copyBtn.addEventListener('click', async () => {
            const text = copyBtn.dataset.url || location.href;
            let ok = false;
            try {
                await navigator.clipboard.writeText(text);
                ok = true;
            } catch (e) {
                // Fallback untuk http:// non-localhost atau browser lama
                const ta = document.createElement('textarea');
                ta.value = text;
                ta.style.cssText = 'position:fixed;opacity:0';
                document.body.appendChild(ta);
                ta.select();
                try {
                    ok = document.execCommand('copy');
                } catch (_) {}
                ta.remove();
            }
            copyLabel.textContent = ok ? 'Tersalin!' : 'Gagal menyalin';
            setTimeout(() => copyLabel.textContent = 'Salin Link', 1800);
        });
    </script>
</body>

</html>