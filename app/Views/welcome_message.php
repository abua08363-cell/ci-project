<!DOCTYPE html>
<html lang="id" class="scroll-smooth motion-reduce:scroll-auto">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muhamad Albuhori | Portofolio Profesional</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        darkbg: '#090d16'
                    },
                    fontFamily: {
                        sans: ['Montserrat', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        hand: ['Caveat', 'cursive']
                    }
                }
            }
        }
    </script>
    <!-- Terapkan tema sedini mungkin agar tidak berkedip -->
    <script>
        try {
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        } catch (e) {}
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;600&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .nav-link {
            position: relative;
            display: inline-flex;
            height: 100%;
            align-items: center;
            transition: color .2s;
        }

        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 2px;
            background: #2563eb;
            border-radius: 2px;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .3s;
        }

        .nav-link:hover,
        .nav-link[data-active="true"] {
            color: #2563eb;
        }

        .nav-link[data-active="true"] {
            font-weight: 600;
        }

        .nav-link:hover::after,
        .nav-link[data-active="true"]::after {
            transform: scaleX(1);
        }

        /* ===== ANIMASI ===== */

        /* Progress bar scroll */
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

        /* Hero: huruf nama muncul satu per satu */
        .hero-word {
            display: inline-block;
            white-space: nowrap;
        }

        .hero-char {
            display: inline-block;
            opacity: 0;
            transform: translateY(0.6em) rotate(6deg);
            animation: charIn .7s cubic-bezier(.2, .8, .2, 1) forwards;
            animation-delay: calc(var(--i) * 45ms + 250ms);
        }

        @keyframes charIn {
            to {
                opacity: 1;
                transform: none;
            }
        }

        /* Hero: elemen kiri masuk berurutan */
        .hero-seq {
            opacity: 0;
            transform: translateY(24px);
            animation: seqIn .8s cubic-bezier(.2, .8, .2, 1) forwards;
            animation-delay: calc(var(--s) * 120ms + 100ms);
        }

        @keyframes seqIn {
            to {
                opacity: 1;
                transform: none;
            }
        }

        /* Hero: foto terbuka dengan clip-path lalu melayang pelan */
        .hero-photo {
            animation: photoIn 1.1s cubic-bezier(.2, .8, .2, 1) .3s both, floaty 6s ease-in-out 1.5s infinite;
        }

        @keyframes photoIn {
            from {
                clip-path: inset(0 0 100% 0 round 1rem);
                opacity: 0;
                transform: scale(.94);
            }

            to {
                clip-path: inset(0 0 0 0 round 1rem);
                opacity: 1;
                transform: none;
            }
        }

        @keyframes floaty {
            50% {
                transform: translateY(-10px);
            }
        }

        /* Blob gradient di belakang foto (FIX: inset 0 agar tidak keluar layar) */
        .hero-blob {
            position: absolute;
            inset: 0;
            z-index: -1;
            filter: blur(50px);
            opacity: .55;
            background: conic-gradient(from 0deg, #2563eb, #38bdf8, #818cf8, #2563eb);
            border-radius: 50%;
            animation: spin 14s linear infinite;
        }

        .dark .hero-blob {
            opacity: .35;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg) scale(1.05);
            }
        }

        /* Efek mengetik */
        .type-caret {
            display: inline-block;
            width: 2px;
            height: 1.1em;
            margin-left: 3px;
            background: #2563eb;
            vertical-align: -0.15em;
            animation: blink 1s steps(2) infinite;
        }

        @keyframes blink {
            50% {
                opacity: 0;
            }
        }

        /* Reveal saat scroll */
        html .rv {
            opacity: 0;
            transform: translateY(36px) scale(.97);
            transition: opacity .8s cubic-bezier(.2, .8, .2, 1), transform .8s cubic-bezier(.2, .8, .2, 1);
            transition-delay: var(--d, 0ms);
        }

        html .rv.rv-left {
            transform: translateX(-40px);
        }

        html .rv.rv-right {
            transform: translateX(40px);
        }

        html .rv.rv-in {
            opacity: 1;
            transform: none;
        }

        /* Spotlight mengikuti kursor pada kartu */
        .spot {
            position: relative;
        }

        .spot::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 1;
            border-radius: inherit;
            opacity: 0;
            transition: opacity .3s;
            background: radial-gradient(260px circle at var(--mx, 50%) var(--my, 50%), rgba(37, 99, 235, .16), transparent 70%);
        }

        .spot:hover::before {
            opacity: 1;
        }

        /* Ikon skill bergoyang saat hover */
        #skills .group:hover i {
            animation: wiggle .6s ease;
        }

        @keyframes wiggle {
            25% {
                transform: rotate(-12deg) scale(1.1);
            }

            60% {
                transform: rotate(10deg) scale(1.1);
            }
        }

        /* Tombol magnetik */
        .magnetic {
            transition: transform .25s cubic-bezier(.2, .8, .2, 1);
            will-change: transform;
        }

        /* Hormati pengguna yang mematikan animasi */
        @media (prefers-reduced-motion: reduce) {

            .hero-char,
            .hero-seq,
            .hero-photo,
            .hero-blob {
                animation: none !important;
                opacity: 1;
                transform: none;
                clip-path: none;
            }

            html .rv {
                opacity: 1;
                transform: none;
                transition: none;
            }

            .type-caret {
                animation: none;
            }
        }

        /* ===== FIX: horizontal overflow (letakkan paling bawah) ===== */
        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
            /* fallback browser lama */
        }

        @supports (overflow: clip) {

            html,
            body {
                overflow-x: clip;
                /* clip tidak merusak navbar sticky */
            }
        }

        /* Potong animasi geser (rv-left / rv-right) di tiap section */
        section {
            overflow-x: clip;
        }

        /* Kolom grid boleh menyusut, tidak memaksa lebar */
        #home .grid>*,
        #about .grid>*,
        #contact .grid>* {
            min-width: 0;
        }

        img {
            max-width: 100%;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-700 dark:bg-[#090d16] dark:text-zinc-300 font-sans transition-colors duration-300 antialiased selection:bg-primary selection:text-white">

    <!-- NAVBAR -->
    <header class="sticky top-0 z-50 bg-white/80 dark:bg-[#090d16]/80 backdrop-blur-md border-b border-slate-200/80 dark:border-zinc-800/80">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 h-20 flex items-center justify-between">
            <a href="#home" class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight">Albu Project<span class="text-primary">.</span></a>

            <nav class="hidden md:flex items-center gap-8 h-full text-sm font-medium text-slate-600 dark:text-zinc-400">
                <a href="#home" data-active="true" class="nav-link">Home</a>
                <a href="#about" class="nav-link">About</a>
                <a href="#skills" class="nav-link">Skills</a>
                <a href="#projects" class="nav-link">Projects</a>
                <a href="#articles" class="nav-link">Articles</a>
                <a href="#contact" class="nav-link">Contact</a>
            </nav>

            <div class="flex items-center gap-3">
                <button id="theme-toggle" aria-label="Ganti tema" class="w-10 h-10 rounded-full flex items-center justify-center text-slate-600 dark:text-zinc-300 bg-slate-100 dark:bg-zinc-900 hover:bg-slate-200 dark:hover:bg-zinc-800 transition">
                    <i id="theme-icon" class="fa-regular fa-moon text-sm"></i>
                </button>
                <button id="menu-toggle" aria-label="Menu" aria-expanded="false" class="md:hidden w-10 h-10 rounded-full flex items-center justify-center text-slate-600 dark:text-zinc-300 bg-slate-100 dark:bg-zinc-900 hover:bg-slate-200 dark:hover:bg-zinc-800 transition">
                    <i class="fa-solid fa-bars text-sm"></i>
                </button>
                <a href="<?= base_url('/login'); ?>" class="hidden sm:inline-block px-5 py-2.5 text-xs font-semibold text-primary border border-primary/40 rounded-xl hover:bg-primary hover:text-white transition shadow-sm">Login Admin</a>
            </div>
        </div>

        <!-- Menu mobile -->
        <nav id="mobile-menu" class="hidden md:hidden border-t border-slate-200 dark:border-zinc-800 px-6 py-4 flex-col gap-4 text-sm font-medium text-slate-700 dark:text-zinc-300 bg-white/95 dark:bg-[#090d16]/95">
            <a href="#home" class="hover:text-primary">Home</a>
            <a href="#about" class="hover:text-primary">About</a>
            <a href="#skills" class="hover:text-primary">Skills</a>
            <a href="#projects" class="hover:text-primary">Projects</a>
            <a href="#articles" class="hover:text-primary">Articles</a>
            <a href="#contact" class="hover:text-primary">Contact</a>
            <a href="<?= base_url('/login'); ?>" class="text-primary font-semibold">Login Admin</a>
        </nav>
    </header>

    <!-- HERO -->
    <section id="home" class="py-12 lg:py-20 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 grid md:grid-cols-12 gap-10 lg:gap-16 items-center">

            <div class="md:col-span-7 space-y-5 min-w-0">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-slate-100 dark:bg-zinc-800 text-slate-700 dark:text-zinc-300 text-xs font-medium">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Mahasiswa &amp; Web Developer
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                    Halo, saya <span class="text-primary">Muhamad Albuhori</span>
                </h1>

                <p class="text-lg font-semibold text-slate-700 dark:text-zinc-200">
                    Web Developer &amp; UI/UX Enthusiast
                </p>

                <p class="text-sm sm:text-base leading-relaxed text-slate-600 dark:text-zinc-400 max-w-xl">
                    Saya seorang pelajar dan pengembang web yang fokus membangun aplikasi web yang bersih, responsif, dan mudah digunakan menggunakan PHP, CodeIgniter, dan Tailwind CSS.
                </p>

                <div class="flex flex-wrap items-center gap-3 pt-3">
                    <a href="#projects" class="px-6 py-3 bg-primary hover:bg-blue-700 text-white text-xs font-semibold rounded-lg inline-flex items-center gap-2 transition shadow-sm">
                        <i class="fa-regular fa-folder-open"></i> Lihat Proyek
                    </a>
                    <a href="#contact" class="px-6 py-3 bg-slate-100 dark:bg-zinc-800 hover:bg-slate-200 dark:hover:bg-zinc-700 text-slate-800 dark:text-zinc-200 text-xs font-semibold rounded-lg inline-flex items-center gap-2 transition">
                        <i class="fa-regular fa-envelope"></i> Hubungi Saya
                    </a>
                </div>
            </div>

            <div class="md:col-span-5 flex justify-center md:justify-end min-w-0">
                <div class="relative w-full max-w-xs sm:max-w-sm">
                    <div class="relative bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 rounded-2xl p-3 shadow-md">
                        <div class="w-full h-80 sm:h-96 rounded-xl overflow-hidden bg-slate-100 dark:bg-zinc-800 relative">
                            <img src="<?= base_url('img/albuhori.jpeg'); ?>" alt="Muhamad Albuhori"
                                class="w-full h-full object-cover object-top"
                                onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full flex flex-col items-center justify-center gap-2 bg-slate-100 dark:bg-zinc-800 text-slate-400 dark:text-zinc-600\'><i class=\'fa-solid fa-user text-6xl\'></i><p class=\'text-xs font-medium\'>Muhamad Albuhori</p></div>';">
                        </div>
                        <div class="pt-3 pb-1 px-1">
                            <p class="text-sm font-bold text-slate-900 dark:text-white">Muhamad Albuhori</p>
                            <p class="text-xs text-slate-500 dark:text-zinc-400">Teknik Informatika — Universitas La Tansa Mashiro</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ABOUT -->
    <section id="about" class="py-24 bg-white dark:bg-zinc-900/50 border-y border-slate-200/60 dark:border-zinc-800/60 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 grid md:grid-cols-12 gap-12 items-center">
            <div class="md:col-span-6 space-y-6">
                <div>
                    <span class="text-primary font-semibold text-xs tracking-wider uppercase">Tentang Saya</span>
                    <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">Dedikasi &amp; Passion di Dunia Pemrograman</h2>
                </div>
                <p class="text-base leading-relaxed text-slate-600 dark:text-zinc-400">
                    Saya adalah seorang mahasiswa Teknik Informatika yang memiliki ketertarikan tinggi pada pengembangan aplikasi web. Saya terbiasa merancang sistem dari nol, mulai dari perancangan database relasional hingga antarmuka pengguna yang interaktif dan nyaman dipandang.
                </p>
                <div class="pt-2">
                    <a href="<?= base_url('pdf/CV_Muhamad_Albuhori.pdf'); ?>"
                        download="CV_Muhamad_Albuhori.pdf"
                        class="px-6 py-3.5 bg-slate-900 dark:bg-white text-white dark:text-slate-900 text-xs font-semibold rounded-xl inline-flex items-center gap-2 hover:bg-primary dark:hover:bg-primary dark:hover:text-white transition shadow-md">
                        <i class="fa-solid fa-download"></i> Download Curriculum Vitae
                    </a>
                </div>
            </div>

            <div class="md:col-span-6 grid sm:grid-cols-2 gap-4">
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 shadow-sm flex flex-col justify-between">
                    <span class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center text-lg mb-4"><i class="fa-solid fa-graduation-cap"></i></span>
                    <div>
                        <p class="font-bold text-slate-900 dark:text-white text-sm mb-1">Pendidikan</p>
                        <p class="text-xs leading-relaxed text-slate-600 dark:text-zinc-400">Universitas La Tansa Mashiro<br>Teknik Informatika (2026)</p>
                    </div>
                </div>
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 shadow-sm flex flex-col justify-between">
                    <span class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center text-lg mb-4"><i class="fa-solid fa-location-dot"></i></span>
                    <div>
                        <p class="font-bold text-slate-900 dark:text-white text-sm mb-1">Domisili</p>
                        <p class="text-xs leading-relaxed text-slate-600 dark:text-zinc-400">Banten, Indonesia</p>
                    </div>
                </div>
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 shadow-sm flex flex-col justify-between">
                    <span class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center text-lg mb-4"><i class="fa-solid fa-envelope"></i></span>
                    <div class="min-w-0">
                        <p class="font-bold text-slate-900 dark:text-white text-sm mb-1">Email Utama</p>
                        <a href="mailto:abua08363@gmail.com" class="text-xs leading-relaxed text-slate-600 dark:text-zinc-400 hover:text-primary break-all">abua08363@gmail.com</a>
                    </div>
                </div>
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 shadow-sm flex flex-col justify-between">
                    <span class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center text-lg mb-4"><i class="fa-solid fa-phone"></i></span>
                    <div>
                        <p class="font-bold text-slate-900 dark:text-white text-sm mb-1">WhatsApp</p>
                        <a href="https://wa.me/6285715330893" target="_blank" rel="noopener" class="text-xs leading-relaxed text-slate-600 dark:text-zinc-400 hover:text-primary">+62 857 1533 0893</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SKILLS -->
    <section id="skills" class="py-24 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center max-w-xl mx-auto mb-16">
                <span class="text-primary font-semibold text-xs tracking-wider uppercase">Keahlian</span>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">Tech Stack &amp; Tools Profesional</h2>
                <p class="text-sm text-slate-600 dark:text-zinc-400 mt-2">Teknologi yang saya gunakan secara rutin untuk menghadirkan solusi digital berkualitas.</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6">
                <div class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 text-center hover:border-primary/50 transition group shadow-sm">
                    <div class="w-14 h-14 mx-auto rounded-xl bg-indigo-50 dark:bg-indigo-950/40 flex items-center justify-center mb-3 group-hover:scale-110 transition duration-300"><i class="fa-brands fa-php text-3xl text-indigo-600"></i></div>
                    <p class="font-bold text-sm text-slate-900 dark:text-white">PHP</p>
                    <p class="text-xs text-slate-500 mt-0.5">Backend Language</p>
                </div>
                <div class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 text-center hover:border-primary/50 transition group shadow-sm">
                    <div class="w-14 h-14 mx-auto rounded-xl bg-red-50 dark:bg-red-950/40 flex items-center justify-center mb-3 group-hover:scale-110 transition duration-300"><i class="fa-solid fa-fire text-2xl text-red-500"></i></div>
                    <p class="font-bold text-sm text-slate-900 dark:text-white">CodeIgniter</p>
                    <p class="text-xs text-slate-500 mt-0.5">Framework PHP</p>
                </div>
                <div class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 text-center hover:border-primary/50 transition group shadow-sm">
                    <div class="w-14 h-14 mx-auto rounded-xl bg-sky-50 dark:bg-sky-950/40 flex items-center justify-center mb-3 group-hover:scale-110 transition duration-300"><i class="fa-solid fa-database text-2xl text-sky-700 dark:text-sky-400"></i></div>
                    <p class="font-bold text-sm text-slate-900 dark:text-white">MySQL</p>
                    <p class="text-xs text-slate-500 mt-0.5">Database</p>
                </div>
                <div class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 text-center hover:border-primary/50 transition group shadow-sm">
                    <div class="w-14 h-14 mx-auto rounded-xl bg-orange-50 dark:bg-orange-950/40 flex items-center justify-center mb-3 group-hover:scale-110 transition duration-300"><i class="fa-brands fa-html5 text-3xl text-orange-600"></i></div>
                    <p class="font-bold text-sm text-slate-900 dark:text-white">HTML5</p>
                    <p class="text-xs text-slate-500 mt-0.5">Markup Language</p>
                </div>
                <div class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 text-center hover:border-primary/50 transition group shadow-sm">
                    <div class="w-14 h-14 mx-auto rounded-xl bg-blue-50 dark:bg-blue-950/40 flex items-center justify-center mb-3 group-hover:scale-110 transition duration-300"><i class="fa-brands fa-css3-alt text-3xl text-blue-600"></i></div>
                    <p class="font-bold text-sm text-slate-900 dark:text-white">CSS3</p>
                    <p class="text-xs text-slate-500 mt-0.5">Styling</p>
                </div>
                <div class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 text-center hover:border-primary/50 transition group shadow-sm">
                    <div class="w-14 h-14 mx-auto rounded-xl bg-yellow-50 dark:bg-yellow-950/40 flex items-center justify-center mb-3 group-hover:scale-110 transition duration-300"><i class="fa-brands fa-js text-3xl text-yellow-500"></i></div>
                    <p class="font-bold text-sm text-slate-900 dark:text-white">JavaScript</p>
                    <p class="text-xs text-slate-500 mt-0.5">Interactivity</p>
                </div>
                <div class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 text-center hover:border-primary/50 transition group shadow-sm">
                    <div class="w-14 h-14 mx-auto rounded-xl bg-purple-50 dark:bg-purple-950/40 flex items-center justify-center mb-3 group-hover:scale-110 transition duration-300"><i class="fa-brands fa-bootstrap text-3xl text-purple-600"></i></div>
                    <p class="font-bold text-sm text-slate-900 dark:text-white">Bootstrap</p>
                    <p class="text-xs text-slate-500 mt-0.5">CSS Framework</p>
                </div>
                <div class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 text-center hover:border-primary/50 transition group shadow-sm">
                    <div class="w-14 h-14 mx-auto rounded-xl bg-orange-50 dark:bg-orange-950/40 flex items-center justify-center mb-3 group-hover:scale-110 transition duration-300"><i class="fa-brands fa-git-alt text-3xl text-orange-600"></i></div>
                    <p class="font-bold text-sm text-slate-900 dark:text-white">Git</p>
                    <p class="text-xs text-slate-500 mt-0.5">Version Control</p>
                </div>
                <div class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 text-center hover:border-primary/50 transition group shadow-sm">
                    <div class="w-14 h-14 mx-auto rounded-xl bg-sky-50 dark:bg-sky-950/40 flex items-center justify-center mb-3 group-hover:scale-110 transition duration-300"><i class="fa-solid fa-code text-2xl text-sky-500"></i></div>
                    <p class="font-bold text-sm text-slate-900 dark:text-white">VS Code</p>
                    <p class="text-xs text-slate-500 mt-0.5">Code Editor</p>
                </div>
                <div class="p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 text-center hover:border-primary/50 transition group shadow-sm">
                    <div class="w-14 h-14 mx-auto rounded-xl bg-pink-50 dark:bg-pink-950/40 flex items-center justify-center mb-3 group-hover:scale-110 transition duration-300"><i class="fa-brands fa-figma text-3xl text-pink-500"></i></div>
                    <p class="font-bold text-sm text-slate-900 dark:text-white">Figma</p>
                    <p class="text-xs text-slate-500 mt-0.5">UI/UX Design</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PROJECTS -->
    <section id="projects" class="py-24 bg-white dark:bg-zinc-900/50 border-y border-slate-200/60 dark:border-zinc-800/60 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <span class="text-primary font-semibold text-xs tracking-wider uppercase">Portofolio</span>
                    <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">Proyek Terbaru</h2>
                    <p class="text-sm text-slate-600 dark:text-zinc-400 mt-2">Beberapa hasil karya terbaik yang saya kembangkan.</p>
                </div>
                <a href="https://github.com/abua08363-cell" target="_blank" rel="noopener" class="text-xs font-semibold text-primary inline-flex items-center gap-1.5 hover:underline">Lihat Semua Proyek <i class="fa-solid fa-arrow-right text-[10px]"></i></a>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <article class="bg-slate-50 dark:bg-zinc-900 rounded-2xl border border-slate-200/80 dark:border-zinc-800 overflow-hidden shadow-sm hover:shadow-xl transition group">
                    <div class="h-48 overflow-hidden bg-slate-200 dark:bg-zinc-800 relative">
                        <img src="<?= base_url('img/portofolio.png'); ?>" alt="Website Portofolio" class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                            onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center bg-blue-50 dark:bg-blue-950/30\'><i class=\'fa-solid fa-laptop-code text-4xl text-primary\'></i></div>';">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-base text-slate-900 dark:text-white mb-2">Website Portofolio</h3>
                        <p class="text-xs leading-relaxed text-slate-600 dark:text-zinc-400 mb-6">Website portofolio pribadi responsif berdesain modern dengan fitur mode gelap (dark mode).</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-950/50 text-primary text-[11px] font-medium border border-blue-200/40 dark:border-blue-900/40">HTML</span>
                            <span class="px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-950/50 text-primary text-[11px] font-medium border border-blue-200/40 dark:border-blue-900/40">CSS</span>
                            <span class="px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-950/50 text-primary text-[11px] font-medium border border-blue-200/40 dark:border-blue-900/40">JavaScript</span>
                        </div>
                    </div>
                </article>

                <article class="bg-slate-50 dark:bg-zinc-900 rounded-2xl border border-slate-200/80 dark:border-zinc-800 overflow-hidden shadow-sm hover:shadow-xl transition group">
                    <div class="h-48 overflow-hidden bg-slate-200 dark:bg-zinc-800 relative">
                        <img src="<?= base_url('img/login.png'); ?>" alt="Aplikasi Login Admin" class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                            onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center bg-sky-50 dark:bg-sky-950/30\'><i class=\'fa-solid fa-list-check text-4xl text-sky-600\'></i></div>';">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-base text-slate-900 dark:text-white mb-2">Tampilan Login Admin</h3>
                        <p class="text-xs leading-relaxed text-slate-600 dark:text-zinc-400 mb-6">Sistem autentikasi dan panel login admin yang aman dan terintegrasi dengan database.</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-950/50 text-primary text-[11px] font-medium border border-blue-200/40 dark:border-blue-900/40">PHP</span>
                            <span class="px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-950/50 text-primary text-[11px] font-medium border border-blue-200/40 dark:border-blue-900/40">CodeIgniter</span>
                            <span class="px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-950/50 text-primary text-[11px] font-medium border border-blue-200/40 dark:border-blue-900/40">MySQL</span>
                        </div>
                    </div>
                </article>

                <article class="bg-slate-50 dark:bg-zinc-900 rounded-2xl border border-slate-200/80 dark:border-zinc-800 overflow-hidden shadow-sm hover:shadow-xl transition group">
                    <div class="h-48 overflow-hidden bg-slate-200 dark:bg-zinc-800 relative">
                        <img src="<?= base_url('img/dasboar.png'); ?>" alt="Website Dashboard" class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                            onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center bg-indigo-50 dark:bg-indigo-950/30\'><i class=\'fa-solid fa-blog text-4xl text-indigo-500\'></i></div>';">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-base text-slate-900 dark:text-white mb-2">Website Dashboard</h3>
                        <p class="text-xs leading-relaxed text-slate-600 dark:text-zinc-400 mb-6">Dashboard admin fungsional dengan fitur manajemen postingan blog dan kategori.</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-950/50 text-primary text-[11px] font-medium border border-blue-200/40 dark:border-blue-900/40">PHP</span>
                            <span class="px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-950/50 text-primary text-[11px] font-medium border border-blue-200/40 dark:border-blue-900/40">Bootstrap</span>
                            <span class="px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-950/50 text-primary text-[11px] font-medium border border-blue-200/40 dark:border-blue-900/40">MySQL</span>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- ARTICLES -->
    <section id="articles" class="py-24 scroll-mt-20 bg-slate-50/50 dark:bg-zinc-950 transition-colors">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <span class="text-indigo-600 dark:text-indigo-400 font-semibold text-xs tracking-wider uppercase">Blog &amp; Berita</span>
                    <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">Artikel Terbaru</h2>
                    <p class="text-sm text-slate-600 dark:text-zinc-400 mt-2">Catatan, tutorial, dan artikel yang saya publikasikan langsung dari dashboard.</p>
                </div>
            </div>

            <?php if (!empty($articles) && is_array($articles)): ?>
                <div class="grid md:grid-cols-3 gap-8">
                    <?php foreach ($articles as $article): ?>
                        <article class="bg-white dark:bg-zinc-900/90 rounded-2xl border border-slate-200/80 dark:border-zinc-800/80 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group flex flex-col justify-between p-6">
                            <div>
                                <!-- Thumbnail (pakai kolom 'image'; kalau kosong tampil placeholder) -->
                                <div class="h-40 mb-4 rounded-xl overflow-hidden bg-slate-100 dark:bg-zinc-800">
                                    <?php if (!empty($article['image'])): ?>
                                        <img src="<?= base_url('uploads/articles/' . esc($article['image'], 'url')); ?>" alt="<?= esc($article['title']); ?>" loading="lazy"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-100 to-sky-100 dark:from-indigo-950/60 dark:to-sky-950/40">
                                            <i class="fa-regular fa-newspaper text-4xl text-indigo-400 dark:text-indigo-500"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-3">
                                    <span class="inline-block px-3 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400 text-[11px] font-semibold border border-indigo-100 dark:border-indigo-900/50">
                                        <?= esc($article['category']); ?>
                                    </span>
                                </div>

                                <h3 class="font-bold text-lg text-slate-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition line-clamp-2">
                                    <?= esc($article['title']); ?>
                                </h3>

                                <p class="text-xs leading-relaxed text-slate-600 dark:text-zinc-400 mb-6 line-clamp-3">
                                    <?= esc(strip_tags($article['content'])); ?>
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-zinc-800 text-[11px] text-slate-400 dark:text-zinc-500">
                                <span><i class="fa-regular fa-calendar mr-1"></i><?= date('d M Y', strtotime($article['created_at'])); ?></span>

                                <a href="<?= base_url('/article/' . $article['slug']); ?>" class="text-indigo-600 dark:text-indigo-400 font-semibold hover:underline inline-flex items-center gap-1">
                                    Baca Selengkapnya &rarr;
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-16 bg-white dark:bg-zinc-900 rounded-2xl border border-slate-200/80 dark:border-zinc-800 shadow-sm">
                    <p class="text-sm text-slate-500 dark:text-zinc-400">Belum ada artikel yang dipublikasikan dari dashboard admin.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="py-24 scroll-mt-20 bg-white dark:bg-zinc-900/50 border-y border-slate-200/60 dark:border-zinc-800/60">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 grid md:grid-cols-12 gap-12 items-center">
            <div class="md:col-span-5 space-y-4">
                <span class="text-primary font-semibold text-xs tracking-wider uppercase">Kontak</span>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white">Mari Terhubung Bersama</h2>
                <p class="text-sm leading-relaxed text-slate-600 dark:text-zinc-400">
                    Punya pertanyaan, tawaran proyek menarik, atau sekadar ingin berdiskusi? Jangan ragu untuk mengirim pesan kepada saya melalui jalur kontak di samping.
                </p>
            </div>

            <div class="md:col-span-7 bg-slate-50 dark:bg-zinc-900 border border-slate-200/80 dark:border-zinc-800 rounded-3xl p-6 sm:p-8 shadow-sm">
                <div class="grid sm:grid-cols-2 gap-6 mb-8">
                    <a href="mailto:abua08363@gmail.com" class="flex items-start gap-4 p-4 rounded-2xl bg-white dark:bg-zinc-800/50 border border-slate-200/80 dark:border-zinc-800 hover:border-primary/50 transition">
                        <span class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0"><i class="fa-solid fa-envelope"></i></span>
                        <div class="text-xs min-w-0">
                            <p class="font-bold text-slate-900 dark:text-white mb-0.5">Email</p>
                            <p class="text-slate-500 dark:text-zinc-400 break-all">abua08363@gmail.com</p>
                        </div>
                    </a>
                    <a href="https://wa.me/6285715330893" target="_blank" rel="noopener" class="flex items-start gap-4 p-4 rounded-2xl bg-white dark:bg-zinc-800/50 border border-slate-200/80 dark:border-zinc-800 hover:border-primary/50 transition">
                        <span class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0"><i class="fa-solid fa-phone"></i></span>
                        <div class="text-xs">
                            <p class="font-bold text-slate-900 dark:text-white mb-0.5">Telepon / WhatsApp</p>
                            <p class="text-slate-500 dark:text-zinc-400">+62 857 1533 0893</p>
                        </div>
                    </a>
                </div>

                <div class="flex items-center justify-between border-t border-slate-200 dark:border-zinc-800 pt-6">
                    <p class="text-xs font-semibold text-slate-700 dark:text-zinc-300">Sosial Media:</p>
                    <div class="flex gap-3 text-lg text-slate-600 dark:text-zinc-400">
                        <a href="https://github.com/abua08363-cell" target="_blank" rel="noopener" aria-label="GitHub" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-zinc-800 flex items-center justify-center hover:bg-primary hover:text-white dark:hover:bg-primary transition"><i class="fa-brands fa-github"></i></a>
                        <a href="https://linkedin.com/in/Albu-Hori" target="_blank" rel="noopener" aria-label="LinkedIn" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-zinc-800 flex items-center justify-center hover:bg-primary hover:text-white dark:hover:bg-primary transition"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="https://www.instagram.com/m.albuhori_" target="_blank" rel="noopener" aria-label="Instagram" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-zinc-800 flex items-center justify-center hover:bg-primary hover:text-white dark:hover:bg-primary transition"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="py-8 bg-white dark:bg-zinc-950 border-t border-slate-200/80 dark:border-zinc-900 text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p>&copy; <?= date('Y'); ?> Muhamad Albuhori. All rights reserved.</p>
            <p class="flex items-center gap-1.5">Made with <i class="fa-solid fa-heart text-red-500"></i> using CodeIgniter 4 &amp; Tailwind CSS</p>
        </div>
    </footer>

    <script>
        // Dark / light mode toggle
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

        // Menu mobile
        const mm = document.getElementById('mobile-menu');
        const mt = document.getElementById('menu-toggle');
        const closeMenu = () => {
            mm.classList.add('hidden');
            mm.classList.remove('flex');
            mt.setAttribute('aria-expanded', 'false');
        };
        mt.addEventListener('click', () => {
            const open = mm.classList.toggle('hidden') === false;
            mm.classList.toggle('flex', open);
            mt.setAttribute('aria-expanded', String(open));
        });
        mm.querySelectorAll('a').forEach(a => a.addEventListener('click', closeMenu));
        window.matchMedia('(min-width: 768px)').addEventListener('change', e => {
            if (e.matches) closeMenu();
        });

        // Scroll spy
        const navLinks = document.querySelectorAll('header nav a.nav-link');
        const sections = [...navLinks].map(l => document.querySelector(l.getAttribute('href')));

        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navLinks.forEach(l => l.removeAttribute('data-active'));
                this.setAttribute('data-active', 'true');
            });
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');
                    navLinks.forEach(link => {
                        if (link.getAttribute('href') === `#${id}`) {
                            link.setAttribute('data-active', 'true');
                        } else {
                            link.removeAttribute('data-active');
                        }
                    });
                }
            });
        }, {
            root: null,
            rootMargin: '-20% 0px -70% 0px',
            threshold: 0
        });

        sections.forEach(section => {
            if (section) observer.observe(section);
        });
    </script>

    <!-- ANIMASI -->
    <script>
        (() => {
            const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
            const $ = (s, r = document) => r.querySelector(s);
            const $$ = (s, r = document) => [...r.querySelectorAll(s)];

            /* 1. Progress bar scroll */
            const bar = document.createElement('div');
            bar.id = 'scroll-progress';
            document.body.prepend(bar);
            const onScroll = () => {
                const max = document.documentElement.scrollHeight - innerHeight;
                bar.style.transform = `scaleX(${max > 0 ? scrollY / max : 0})`;
            };
            addEventListener('scroll', onScroll, {
                passive: true
            });
            onScroll();

            if (reduce) return;

            /* 2. Hero: nama muncul huruf per huruf */
            const name = $('#home h1 span.text-primary');
            if (name) {
                let i = 0;
                const words = name.textContent.trim().split(/\s+/);
                name.innerHTML = words.map(w =>
                    `<span class="hero-word">${[...w].map(c => `<span class="hero-char" style="--i:${i++}">${c}</span>`).join('')}</span>`
                ).join(' ');
            }

            /* 3. Hero: elemen lain masuk berurutan */
            const left = $('#home .md\\:col-span-7');
            if (left)[...left.children].forEach((el, n) => {
                if (el.tagName === 'H1') return;
                el.classList.add('hero-seq');
                el.style.setProperty('--s', n + 1);
            });

            /* 4. Hero: foto + blob */
            const photoWrap = $('#home .md\\:col-span-5 .relative');
            if (photoWrap) {
                const card = photoWrap.firstElementChild;
                if (card) card.classList.add('hero-photo');
                const blob = document.createElement('div');
                blob.className = 'hero-blob';
                photoWrap.prepend(blob);
            }

            /* 5. Efek mengetik pada subjudul */
            const role = $('#home .md\\:col-span-7 p.text-lg');
            if (role) {
                const roles = ['Web Developer & UI/UX Enthusiast', 'PHP & CodeIgniter Developer', 'Mahasiswa Teknik Informatika'];
                const text = document.createElement('span');
                const caret = document.createElement('span');
                caret.className = 'type-caret';
                role.textContent = '';
                role.append(text, caret);
                let r = 0,
                    c = 0,
                    del = false;
                const tick = () => {
                    const full = roles[r];
                    c += del ? -1 : 1;
                    text.textContent = full.slice(0, c);
                    let wait = del ? 35 : 70;
                    if (!del && c === full.length) {
                        del = true;
                        wait = 1800;
                    } else if (del && c === 0) {
                        del = false;
                        r = (r + 1) % roles.length;
                        wait = 400;
                    }
                    setTimeout(tick, wait);
                };
                setTimeout(tick, 1400);
            }

            /* 6. Reveal saat scroll, dengan stagger */
            const targets = [];
            const add = (els, cls = '', stagger = 90) =>
                els.forEach((el, n) => {
                    el.classList.add('rv');
                    if (cls) el.classList.add(cls);
                    el.style.setProperty('--d', `${n * stagger}ms`);
                    targets.push(el);
                });

            $$('#skills, #projects, #articles').forEach(sec => {
                const head = $('.max-w-7xl > div:first-child', sec);
                if (head) add([head]);
            });
            add($$('#about .md\\:col-span-6:first-child > *'), '', 120);
            add($$('#about .md\\:col-span-6.grid > div'), 'rv-right', 100);
            add($$('#skills .grid > div'), '', 60);
            add($$('#projects article'), '', 140);
            add($$('#articles article, #articles .text-center'), '', 120);
            add($$('#contact .md\\:col-span-5 > *'), 'rv-left', 100);
            add($$('#contact .md\\:col-span-7'), 'rv-right');

            const io = new IntersectionObserver(entries => {
                entries.forEach(e => {
                    if (!e.isIntersecting) return;
                    const el = e.target;
                    el.classList.add('rv-in');
                    io.unobserve(el);
                    // Lepas class animasi supaya tidak bentrok dengan hover/tilt
                    const d = parseInt(el.style.getPropertyValue('--d')) || 0;
                    setTimeout(() => el.classList.remove('rv', 'rv-in', 'rv-left', 'rv-right'), d + 900);
                });
            }, {
                threshold: 0.15,
                rootMargin: '0px 0px -40px 0px'
            });
            targets.forEach(el => io.observe(el));

            /* 7. Spotlight kursor di kartu */
            $$('#about .md\\:col-span-6.grid > div, #skills .grid > div, #projects article, #articles article, #contact a.flex').forEach(card => {
                card.classList.add('spot');
                card.addEventListener('pointermove', e => {
                    const b = card.getBoundingClientRect();
                    card.style.setProperty('--mx', `${e.clientX - b.left}px`);
                    card.style.setProperty('--my', `${e.clientY - b.top}px`);
                });
            });

            /* 8 & 9. Tilt 3D kartu proyek + tombol magnetik (hanya perangkat dengan mouse) */
            if (matchMedia('(hover: hover)').matches) {
                $$('#projects article').forEach(card => {
                    card.addEventListener('pointermove', e => {
                        const b = card.getBoundingClientRect();
                        const x = (e.clientX - b.left) / b.width - 0.5;
                        const y = (e.clientY - b.top) / b.height - 0.5;
                        card.style.transform = `perspective(800px) rotateY(${x * 8}deg) rotateX(${-y * 8}deg) translateY(-4px)`;
                    });
                    card.addEventListener('pointerleave', () => {
                        card.style.transform = '';
                    });
                });

                $$('#home a[href="#projects"], #home a[href="#contact"]').forEach(btn => {
                    btn.classList.add('magnetic');
                    btn.addEventListener('pointermove', e => {
                        const b = btn.getBoundingClientRect();
                        const x = (e.clientX - b.left - b.width / 2) * 0.25;
                        const y = (e.clientY - b.top - b.height / 2) * 0.35;
                        btn.style.transform = `translate(${x}px, ${y}px)`;
                    });
                    btn.addEventListener('pointerleave', () => {
                        btn.style.transform = '';
                    });
                });
            }
        })();
    </script>
</body>

</html>