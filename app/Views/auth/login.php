<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Albu Project</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
    <!-- Tema sama dengan beranda -->
    <script>
        try {
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        } catch (e) {}
    </script>
    <style>
        html,
        body {
            max-width: 100%;
            overflow-x: clip;
        }

        /* Latar bergradasi bergerak */
        .bg-mesh {
            background:
                radial-gradient(40rem 40rem at 10% 10%, rgba(37, 99, 235, .18), transparent 60%),
                radial-gradient(36rem 36rem at 90% 90%, rgba(129, 140, 248, .18), transparent 60%),
                #f8fafc;
        }

        .dark .bg-mesh {
            background:
                radial-gradient(40rem 40rem at 10% 10%, rgba(37, 99, 235, .22), transparent 60%),
                radial-gradient(36rem 36rem at 90% 90%, rgba(129, 140, 248, .16), transparent 60%),
                #090d16;
        }

        /* Panel brand */
        .brand-panel {
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 45%, #4f46e5 100%);
            background-size: 200% 200%;
            animation: shift 12s ease-in-out infinite;
        }

        @keyframes shift {
            50% {
                background-position: 100% 100%;
            }
        }

        .orb {
            position: absolute;
            border-radius: 9999px;
            filter: blur(2px);
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, .35), rgba(255, 255, 255, .05));
            animation: drift 9s ease-in-out infinite;
        }

        @keyframes drift {
            50% {
                transform: translate(14px, -22px) scale(1.06);
            }
        }

        .grid-dots {
            background-image: radial-gradient(rgba(255, 255, 255, .22) 1px, transparent 1px);
            background-size: 22px 22px;
            mask-image: linear-gradient(to bottom, #000 0%, transparent 85%);
            -webkit-mask-image: linear-gradient(to bottom, #000 0%, transparent 85%);
        }

        /* Animasi masuk */
        @keyframes up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .up {
            opacity: 0;
            animation: up .8s cubic-bezier(.2, .8, .2, 1) forwards;
            animation-delay: calc(var(--s, 0) * 90ms + 80ms);
        }

        @keyframes shake {

            20%,
            60% {
                transform: translateX(-6px);
            }

            40%,
            80% {
                transform: translateX(6px);
            }
        }

        .shake {
            animation: shake .45s ease;
        }

        .spin {
            animation: spin .8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (prefers-reduced-motion: reduce) {

            .brand-panel,
            .orb,
            .up,
            .shake,
            .spin {
                animation: none !important;
                opacity: 1;
            }
        }
    </style>
</head>

<body class="h-full bg-mesh font-sans antialiased text-slate-700 dark:text-zinc-300 transition-colors duration-300 selection:bg-primary selection:text-white">

    <!-- Tombol tema -->
    <button id="theme-toggle" type="button" aria-label="Ganti tema"
        class="fixed top-4 right-4 z-30 w-10 h-10 rounded-full flex items-center justify-center text-slate-600 dark:text-zinc-300 bg-white/80 dark:bg-zinc-900/80 backdrop-blur border border-slate-200 dark:border-zinc-800 shadow-sm hover:scale-105 transition">
        <svg id="icon-moon" class="w-4 h-4 dark:hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.8A9 9 0 1111.2 3a7 7 0 009.8 9.8z" />
        </svg>
        <svg id="icon-sun" class="w-4 h-4 hidden dark:block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="4" />
            <path stroke-linecap="round" d="M12 2v2m0 16v2M4.9 4.9l1.4 1.4m11.4 11.4l1.4 1.4M2 12h2m16 0h2M4.9 19.1l1.4-1.4m11.4-11.4l1.4-1.4" />
        </svg>
    </button>

    <div class="min-h-full flex items-center justify-center p-4 sm:p-6 lg:p-10">

        <div class="up relative w-full max-w-5xl bg-white/90 dark:bg-zinc-900/80 backdrop-blur-xl rounded-3xl overflow-hidden flex flex-col lg:flex-row border border-slate-200/80 dark:border-zinc-800 shadow-2xl shadow-blue-900/10 dark:shadow-black/40" style="--s:0">

            <!-- Tombol Beranda -->
            <a href="<?= base_url('/'); ?>" class="absolute top-4 left-4 z-20 group inline-flex items-center gap-1.5 px-3.5 py-1.5 text-xs font-semibold text-white lg:text-white bg-white/15 hover:bg-white/25 border border-white/30 rounded-full backdrop-blur transition">
                <svg class="w-3.5 h-3.5 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Beranda
            </a>

            <!-- PANEL BRAND -->
            <div class="brand-panel relative lg:w-[46%] shrink-0 text-white overflow-hidden flex flex-col items-center lg:items-start justify-center text-center lg:text-left px-8 sm:px-12 pt-20 pb-12 lg:py-14">
                <div class="grid-dots absolute inset-0 pointer-events-none"></div>
                <span class="orb w-40 h-40 -top-10 -right-10" style="animation-delay:-2s"></span>
                <span class="orb w-24 h-24 bottom-10 -left-8" style="animation-delay:-5s"></span>
                <span class="orb w-14 h-14 bottom-24 right-16 hidden lg:block" style="animation-delay:-7s"></span>

                <div class="relative z-10 w-full">
                    <div class="up flex items-center justify-center lg:justify-start gap-3" style="--s:2">
                        <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center shadow-lg">
                            <span class="text-2xl font-black text-primary">A</span>
                        </div>
                        <p class="text-lg font-extrabold tracking-tight">Albu Project<span class="text-sky-300">.</span></p>
                    </div>

                    <h2 class="up mt-8 text-3xl sm:text-4xl font-extrabold tracking-tight leading-tight" style="--s:3">
                        Kelola konten,<br class="hidden lg:block"> lebih mudah.
                    </h2>
                    <p class="up mt-3 text-sm text-blue-100 leading-relaxed max-w-xs mx-auto lg:mx-0" style="--s:4">
                        Masuk ke dashboard admin untuk mengatur artikel, kategori, dan konten portofolio Anda.
                    </p>

                    <ul class="up hidden lg:block mt-8 space-y-3 text-sm" style="--s:5">
                        <li class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-lg bg-white/15 flex items-center justify-center"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg></span>
                            Manajemen artikel &amp; kategori
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-lg bg-white/15 flex items-center justify-center"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg></span>
                            Tampil rapi di semua perangkat
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-lg bg-white/15 flex items-center justify-center"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg></span>
                            Autentikasi aman dengan CSRF
                        </li>
                    </ul>

                    <p class="hidden lg:block mt-12 text-xs text-blue-200">&copy; <?= date('Y'); ?> Albu Project</p>
                </div>
            </div>

            <!-- PANEL FORM -->
            <div class="relative flex-1 flex items-center justify-center px-6 sm:px-12 py-12 lg:py-14 min-w-0">
                <div class="w-full max-w-sm">

                    <div class="up" style="--s:2">
                        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Selamat Datang</h1>
                        <p class="mt-1.5 text-sm text-slate-500 dark:text-zinc-400">Masuk ke akun Anda untuk melanjutkan.</p>
                    </div>

                    <!-- Alert Flashdata -->
                    <?php if (session()->getFlashdata('msg')) : ?>
                        <div id="flash" class="shake mt-5 flex items-start gap-2.5 px-4 py-3 text-xs text-rose-700 dark:text-rose-300 bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-900/60 rounded-2xl" role="alert">
                            <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.3 3.9L2.4 18a2 2 0 001.7 3h15.8a2 2 0 001.7-3L13.7 3.9a2 2 0 00-3.4 0z" />
                            </svg>
                            <span><?= esc(session()->getFlashdata('msg')) ?></span>
                        </div>
                    <?php endif; ?>

                    <!-- Form -->
                    <form id="loginForm" action="<?= base_url('/loginProcess'); ?>" method="post" class="mt-7 space-y-5" novalidate>
                        <?= csrf_field() ?>
                        <?php $input = 'peer w-full py-3.5 text-sm font-medium text-slate-800 dark:text-zinc-100 placeholder-slate-400 dark:placeholder-zinc-500 bg-slate-100/80 dark:bg-zinc-800/70 border border-transparent rounded-2xl focus:outline-none focus:bg-white dark:focus:bg-zinc-900 focus:border-primary focus:ring-4 focus:ring-primary/15 transition duration-200'; ?>

                        <!-- Username -->
                        <div class="up" style="--s:3">
                            <label for="username" class="block mb-1.5 text-xs font-semibold text-slate-600 dark:text-zinc-400">Username / Email</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 dark:text-zinc-500 peer-focus:text-primary pointer-events-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM4 21a8 8 0 0116 0" />
                                    </svg>
                                </span>
                                <input type="text" name="username" id="username" required autofocus autocomplete="username"
                                    value="<?= esc(old('username')); ?>"
                                    class="<?= $input; ?> pl-11 pr-4" placeholder="Masukkan username atau email">
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="up" style="--s:4">
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="password" class="text-xs font-semibold text-slate-600 dark:text-zinc-400">Password</label>
                                <a href="#" class="text-xs font-medium text-primary hover:underline">Lupa password?</a>
                            </div>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 dark:text-zinc-500 pointer-events-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <rect x="4" y="11" width="16" height="10" rx="2" />
                                        <path stroke-linecap="round" d="M8 11V7a4 4 0 118 0v4" />
                                    </svg>
                                </span>
                                <input type="password" name="password" id="password" required autocomplete="current-password"
                                    class="<?= $input; ?> pl-11 pr-12" placeholder="Masukkan password">

                                <button type="button" id="togglePassword" aria-label="Tampilkan password" aria-pressed="false"
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-primary focus:outline-none focus-visible:text-primary">
                                    <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg id="eyeOffIcon" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a8.959 8.959 0 013.682-.813c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.168 5.488M9.88 9.88a3 3 0 104.243 4.243M9.88 9.88L3 3m18 18l-6.88-6.88" />
                                    </svg>
                                </button>
                            </div>
                            <p id="capsWarn" class="hidden mt-1.5 text-[11px] font-medium text-amber-600 dark:text-amber-400">Caps Lock sedang aktif.</p>
                        </div>

                        <!-- Submit -->
                        <div class="up pt-1" style="--s:5">
                            <button type="submit" id="submitBtn"
                                class="w-full py-3.5 text-sm bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold tracking-wide rounded-2xl shadow-lg shadow-blue-600/25 hover:shadow-xl hover:shadow-blue-600/30 hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus-visible:ring-4 focus-visible:ring-primary/30 disabled:opacity-70 disabled:cursor-not-allowed disabled:hover:translate-y-0 transition duration-200 inline-flex items-center justify-center gap-2">
                                <svg id="btnSpinner" class="spin w-4 h-4 hidden" fill="none" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="3" opacity=".3" />
                                    <path d="M21 12a9 9 0 00-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                                </svg>
                                <span id="btnText">Masuk</span>
                            </button>
                        </div>

                        <p class="up pt-1 text-center text-xs text-slate-500 dark:text-zinc-400" style="--s:6">
                            Belum punya akun?
                            <a href="<?= base_url('/register'); ?>" class="font-bold text-primary hover:underline">Daftar</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tema
        const html = document.documentElement;
        document.getElementById('theme-toggle').addEventListener('click', () => {
            html.classList.toggle('dark');
            try {
                localStorage.theme = html.classList.contains('dark') ? 'dark' : 'light';
            } catch (e) {}
        });

        // Tampilkan / sembunyikan password
        const pwd = document.getElementById('password');
        const tgl = document.getElementById('togglePassword');
        tgl.addEventListener('click', () => {
            const show = pwd.type === 'password';
            pwd.type = show ? 'text' : 'password';
            document.getElementById('eyeIcon').classList.toggle('hidden', show);
            document.getElementById('eyeOffIcon').classList.toggle('hidden', !show);
            tgl.setAttribute('aria-pressed', String(show));
            tgl.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
        });

        // Peringatan Caps Lock
        const caps = document.getElementById('capsWarn');
        ['keydown', 'keyup'].forEach(ev => pwd.addEventListener(ev, e => {
            caps.classList.toggle('hidden', !(e.getModifierState && e.getModifierState('CapsLock')));
        }));
        pwd.addEventListener('blur', () => caps.classList.add('hidden'));

        // Status loading saat submit (cegah klik ganda)
        const form = document.getElementById('loginForm');
        form.addEventListener('submit', e => {
            if (!form.checkValidity()) {
                e.preventDefault();
                form.reportValidity();
                return;
            }
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            document.getElementById('btnSpinner').classList.remove('hidden');
            document.getElementById('btnText').textContent = 'Memproses…';
        });

        // Kembalikan tombol jika halaman dipulihkan dari cache (tombol Back)
        addEventListener('pageshow', e => {
            if (e.persisted) {
                document.getElementById('submitBtn').disabled = false;
                document.getElementById('btnSpinner').classList.add('hidden');
                document.getElementById('btnText').textContent = 'Masuk';
            }
        });
    </script>
</body>

</html>