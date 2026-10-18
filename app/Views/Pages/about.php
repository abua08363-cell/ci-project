<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<?php
$stat = [
    ['2+',   'Years Exp.',           'bg-indigo-50 text-indigo-600 ring-indigo-100',   'M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z'],
    ['15+',  'Projects Completed',   'bg-emerald-50 text-emerald-600 ring-emerald-100', 'M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7z'],
    ['100%', 'Client Satisfaction',  'bg-amber-50 text-amber-600 ring-amber-100',       'M11.05 2.93a1 1 0 011.9 0l1.8 4.1 4.45.4a1 1 0 01.56 1.75l-3.36 2.9 1 4.35a1 1 0 01-1.49 1.08L12 14.8l-3.9 2.2a1 1 0 01-1.49-1.08l1-4.35-3.36-2.9a1 1 0 01.56-1.75l4.45-.4 1.79-4.1z'],
];

$skills = [
    'CodeIgniter 4' => 'bg-sky-50 text-sky-700 ring-sky-200',
    'PHP'           => 'bg-indigo-50 text-indigo-700 ring-indigo-200',
    'Tailwind CSS'  => 'bg-cyan-50 text-cyan-700 ring-cyan-200',
    'JavaScript'    => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
    'MySQL'         => 'bg-amber-50 text-amber-700 ring-amber-200',
];

$sertifikat = $sertifikat ?? [
    ['judul' => 'Belajar Dasar Pemrograman Web', 'penerbit' => 'Dicoding Indonesia', 'tanggal' => '2025-03-12', 'file' => 'html.jpeg'],
    ['judul' => 'Belajar Fundamental Back-End',   'penerbit' => 'Dicoding Indonesia', 'tanggal' => '2025-06-20', 'file' => 'goku.jpg'],
    ['judul' => 'Workshop CodeIgniter 4',         'penerbit' => 'Universitas Lambung Mangkurat', 'tanggal' => '2026-01-15', 'file' => 'workshop-ci4.pdf'],
    ['judul' => 'Workshop CodeIgniter 4',         'penerbit' => 'Universitas Lambung Mangkurat', 'tanggal' => '2026-01-15', 'file' => 'workshop-ci4.pdf'],
];

$bulan = ['Jan' => 'Jan', 'Feb' => 'Feb', 'Mar' => 'Mar', 'Apr' => 'Apr', 'May' => 'Mei', 'Jun' => 'Jun', 'Jul' => 'Jul', 'Aug' => 'Agu', 'Sep' => 'Sep', 'Oct' => 'Okt', 'Nov' => 'Nov', 'Dec' => 'Des'];
$tgl   = fn($t) => date('d', strtotime($t)) . ' ' . ($bulan[date('M', strtotime($t))] ?? date('M', strtotime($t))) . ' ' . date('Y', strtotime($t));
?>

<style>
    @keyframes aUp {
        from {
            opacity: 0;
            transform: translateY(18px);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    .a-up {
        opacity: 0;
        animation: aUp .7s cubic-bezier(.2, .8, .2, 1) forwards;
        animation-delay: calc(var(--i, 0) * 90ms);
    }

    /* Modal */
    #sertifikat-modal {
        opacity: 0;
        visibility: hidden;
        transition: opacity .25s, visibility .25s;
    }

    #sertifikat-modal.open {
        opacity: 1;
        visibility: visible;
    }

    #sertifikat-modal .m-box {
        transform: scale(.94);
        transition: transform .3s cubic-bezier(.2, .8, .2, 1);
    }

    #sertifikat-modal.open .m-box {
        transform: none;
    }

    @media (prefers-reduced-motion: reduce) {

        .a-up,
        #sertifikat-modal,
        #sertifikat-modal .m-box {
            animation: none;
            opacity: 1;
            transition: none;
        }

        #sertifikat-modal:not(.open) {
            opacity: 0;
        }
    }
</style>

<div class="space-y-6 min-w-0">

    <!-- ===== PROFIL ===== -->
    <div class="a-up relative bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden" style="--i:0">

        <!-- Cover -->
        <div class="relative h-32 md:h-40 bg-gradient-to-r from-indigo-600 via-blue-600 to-sky-500 overflow-hidden">
            <span class="absolute -top-12 -right-8 w-56 h-56 rounded-full bg-white/10"></span>
            <span class="absolute -bottom-16 left-1/3 w-44 h-44 rounded-full bg-white/10"></span>
            <span class="absolute inset-0 opacity-30" style="background-image:radial-gradient(rgba(255,255,255,.4) 1px,transparent 1px);background-size:22px 22px"></span>
        </div>

        <div class="px-6 md:px-10 pb-8 md:pb-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10 items-start">

                <!-- Foto & nama -->
                <div class="flex flex-col items-center text-center -mt-20 md:-mt-24 space-y-4">
                    <div class="relative">
                        <div class="w-40 h-40 md:w-44 md:h-44 rounded-full p-1.5 bg-gradient-to-tr from-indigo-500 via-blue-500 to-sky-400 shadow-xl shadow-indigo-500/25">
                            <img src="<?= base_url('img/albu.jpeg') ?>" alt="Foto profil Muhamad Albuhori"
                                class="w-full h-full object-cover rounded-full border-4 border-white bg-slate-100"
                                onerror="this.onerror=null;this.src='data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 fill=%22%23e2e8f0%22/><circle cx=%2250%22 cy=%2238%22 r=%2216%22 fill=%22%2394a3b8%22/><path d=%22M18 90a32 32 0 0164 0z%22 fill=%22%2394a3b8%22/></svg>';">
                        </div>
                        <span class="absolute bottom-3 right-3 w-5 h-5 rounded-full bg-emerald-500 border-4 border-white" title="Tersedia untuk proyek"></span>
                    </div>

                    <div>
                        <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Muhamad Albuhori</h2>
                        <p class="mt-0.5 text-sm text-indigo-600 font-semibold">Web Developer &amp; Designer</p>
                        <span class="mt-3 inline-flex items-center gap-1.5 px-3 py-1 text-[11px] font-semibold rounded-full bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Terbuka untuk proyek
                        </span>
                    </div>
                </div>

                <!-- Konten -->
                <div class="md:col-span-2 space-y-7 md:pt-8 min-w-0">
                    <div>
                        <span class="text-xs font-semibold tracking-wider uppercase text-indigo-600">Tentang Saya</span>
                        <h1 class="mt-1 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">About Me</h1>
                        <p class="mt-3 text-slate-600 leading-relaxed">
                            Halo! Saya seorang developer yang bersemangat dalam membangun aplikasi web modern, responsif, dan interaktif. Saya menikmati proses mengubah ide-ide kreatif menjadi baris kode yang bersih dan fungsional.
                        </p>
                    </div>

                    <!-- Statistik -->
                    <div class="grid grid-cols-3 gap-3 sm:gap-4">
                        <?php foreach ($stat as $n => [$angka, $label, $warna, $ikon]) : ?>
                            <div class="a-up group rounded-2xl p-3 sm:p-4 text-center ring-1 ring-inset hover:-translate-y-1 hover:shadow-md transition duration-300 <?= $warna; ?>" style="--i:<?= $n + 2; ?>">
                                <svg class="mx-auto w-5 h-5 mb-1.5 opacity-80 group-hover:scale-110 transition" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="<?= $ikon; ?>" />
                                </svg>
                                <span class="block text-2xl sm:text-3xl font-extrabold leading-none" data-count="<?= esc($angka, 'attr'); ?>"><?= esc($angka); ?></span>
                                <span class="mt-1 block text-[11px] sm:text-xs text-slate-500 leading-snug"><?= esc($label); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Skill -->
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 mb-3">Tech Stack &amp; Skills</h3>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ($skills as $nama => $warna) : ?>
                                <span class="px-3.5 py-1.5 text-xs font-semibold rounded-full ring-1 ring-inset hover:-translate-y-0.5 hover:shadow-sm transition <?= $warna; ?>"><?= esc($nama); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <a href="<?= base_url('pages/contact') ?>"
                            class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white rounded-xl bg-gradient-to-r from-indigo-600 to-blue-600 shadow-lg shadow-indigo-500/25 hover:from-indigo-700 hover:to-blue-700 hover:-translate-y-0.5 transition focus:outline-none focus-visible:ring-4 focus-visible:ring-indigo-500/30">
                            Contact Me
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6" />
                            </svg>
                        </a>
                        <a href="#sertifikat" class="inline-flex items-center gap-2 px-5 py-3 text-sm font-semibold text-slate-700 rounded-xl bg-slate-100 hover:bg-slate-200 transition">
                            Lihat Sertifikat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== SERTIFIKAT ===== -->
    <section id="sertifikat" class="a-up scroll-mt-24 bg-white rounded-3xl border border-slate-100 shadow-sm p-6 md:p-10" style="--i:3">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <span class="text-xs font-semibold tracking-wider uppercase text-indigo-600">Pencapaian</span>
                <h2 class="mt-1 text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Sertifikat</h2>
                <p class="mt-1.5 text-sm text-slate-500">Kumpulan sertifikat pelatihan dan pencapaian yang pernah saya peroleh.</p>
            </div>
            <span class="self-start sm:self-auto shrink-0 inline-flex items-center gap-1.5 px-3.5 py-1.5 text-xs font-semibold rounded-full bg-indigo-50 text-indigo-600 ring-1 ring-inset ring-indigo-100">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <?= count($sertifikat); ?> Sertifikat
            </span>
        </div>

        <?php if (empty($sertifikat)) : ?>
            <div class="mt-8 rounded-2xl border-2 border-dashed border-slate-200 py-14 text-center">
                <svg class="mx-auto w-10 h-10 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
                <p class="mt-3 text-sm text-slate-400">Belum ada sertifikat yang ditambahkan.</p>
            </div>
        <?php else : ?>
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($sertifikat as $s) :
                    // Path langsung mengarah ke public/img/
                    $url   = base_url('img/' . $s['file']);
                    $ext   = strtolower(pathinfo($s['file'], PATHINFO_EXTENSION));
                    $isPdf = ($ext === 'pdf');
                ?>
                    <article class="group flex flex-col rounded-2xl bg-white border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-slate-200 transition duration-300">

                        <!-- Pratinjau Gambar / Icon PDF -->
                        <?php if (!$isPdf) : ?>
                            <button type="button" data-preview="<?= esc($url, 'attr'); ?>" data-title="<?= esc($s['judul'], 'attr'); ?>"
                                class="relative block w-full aspect-[4/3] bg-slate-50 overflow-hidden focus:outline-none focus-visible:ring-4 focus-visible:ring-indigo-500/30"
                                aria-label="Lihat sertifikat <?= esc($s['judul'], 'attr'); ?>">
                                <img src="<?= esc($url, 'attr'); ?>" alt="<?= esc($s['judul'], 'attr'); ?>" loading="lazy"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <span class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/40 transition flex items-center justify-center">
                                    <span class="opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-slate-900 bg-white rounded-full shadow-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.46 12C3.73 7.94 7.52 5 12 5s8.27 2.94 9.54 7c-1.27 4.06-5.06 7-9.54 7s-8.27-2.94-9.54-7z" />
                                        </svg>
                                        Lihat
                                    </span>
                                </span>
                            </button>
                        <?php else : ?>
                            <a href="<?= esc($url, 'attr'); ?>" target="_blank" rel="noopener noreferrer"
                                class="w-full aspect-[4/3] bg-gradient-to-br from-rose-50 to-orange-50 flex flex-col items-center justify-center text-rose-400 group-hover:text-rose-500 transition"
                                aria-label="Buka PDF <?= esc($s['judul'], 'attr'); ?>">
                                <svg class="w-14 h-14 stroke-current group-hover:scale-110 transition" fill="none" stroke-width="1.4" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="mt-2 px-2.5 py-0.5 text-[10px] font-bold tracking-wider rounded-md bg-rose-100 text-rose-600">PDF</span>
                            </a>
                        <?php endif; ?>

                        <!-- Info -->
                        <div class="flex flex-col flex-1 p-5">
                            <h3 class="font-bold text-slate-900 leading-snug"><?= esc($s['judul']); ?></h3>
                            <p class="mt-1 text-sm text-slate-500"><?= esc($s['penerbit']); ?></p>

                            <div class="mt-auto pt-4 flex items-center justify-between">
                                <span class="inline-flex items-center gap-1.5 text-xs text-slate-400">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <rect x="3" y="5" width="18" height="16" rx="2" />
                                        <path stroke-linecap="round" d="M16 3v4M8 3v4M3 11h18" />
                                    </svg>
                                    <?= esc($tgl($s['tanggal'])); ?>
                                </span>
                                <?php if ($isPdf) : ?>
                                    <a href="<?= esc($url, 'attr'); ?>" target="_blank" rel="noopener noreferrer"
                                        class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 hover:underline">Buka PDF &rarr;</a>
                                <?php else : ?>
                                    <button type="button" data-preview="<?= esc($url, 'attr'); ?>" data-title="<?= esc($s['judul'], 'attr'); ?>"
                                        class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 hover:underline">Lihat &rarr;</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</div>

<!-- ===== MODAL PRATINJAU ===== -->
<div id="sertifikat-modal" class="fixed inset-0 z-50 bg-slate-900/85 backdrop-blur-sm p-4 flex items-center justify-center" role="dialog" aria-modal="true" aria-labelledby="sertifikat-judul" aria-hidden="true">
    <div class="m-box relative max-w-4xl w-full">
        <button type="button" id="sertifikat-tutup" aria-label="Tutup"
            class="absolute -top-12 right-0 inline-flex items-center gap-1.5 px-3.5 py-1.5 text-xs font-semibold text-white bg-white/15 hover:bg-white/25 rounded-full transition focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
            Tutup <span aria-hidden="true">&times;</span>
        </button>

        <img id="sertifikat-gambar" src="" alt="" class="w-full max-h-[78vh] object-contain rounded-2xl bg-white shadow-2xl">

        <div class="mt-4 flex items-center justify-between gap-3">
            <button type="button" id="sertifikat-prev" aria-label="Sebelumnya"
                class="w-10 h-10 shrink-0 rounded-full bg-white/15 hover:bg-white/25 text-white flex items-center justify-center transition focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <div class="text-center min-w-0">
                <p id="sertifikat-judul" class="text-sm font-semibold text-white truncate"></p>
                <p id="sertifikat-urutan" class="text-xs text-white/60"></p>
            </div>
            <button type="button" id="sertifikat-next" aria-label="Berikutnya"
                class="w-10 h-10 shrink-0 rounded-full bg-white/15 hover:bg-white/25 text-white flex items-center justify-center transition focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
    (function() {
        const modal = document.getElementById('sertifikat-modal');
        const gambar = document.getElementById('sertifikat-gambar');
        const judul = document.getElementById('sertifikat-judul');
        const urutan = document.getElementById('sertifikat-urutan');
        const prev = document.getElementById('sertifikat-prev');
        const next = document.getElementById('sertifikat-next');
        const tutupBtn = document.getElementById('sertifikat-tutup');

        // Daftar gambar unik (satu entri per sertifikat gambar)
        const items = [];
        document.querySelectorAll('[data-preview]').forEach(el => {
            if (!items.some(i => i.src === el.dataset.preview && i.title === el.dataset.title)) {
                items.push({
                    src: el.dataset.preview,
                    title: el.dataset.title
                });
            }
        });

        let index = 0;
        let lastFocus = null;

        const tampil = () => {
            const it = items[index];
            gambar.src = it.src;
            gambar.alt = it.title;
            judul.textContent = it.title;
            urutan.textContent = (index + 1) + ' / ' + items.length;
            const single = items.length < 2;
            prev.classList.toggle('invisible', single);
            next.classList.toggle('invisible', single);
        };

        const buka = (src, title) => {
            index = Math.max(0, items.findIndex(i => i.src === src && i.title === title));
            lastFocus = document.activeElement;
            tampil();
            modal.classList.add('open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            tutupBtn.focus();
        };

        const tutup = () => {
            modal.classList.remove('open');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            setTimeout(() => {
                if (!modal.classList.contains('open')) gambar.src = '';
            }, 300);
            if (lastFocus) lastFocus.focus();
        };

        const geser = (d) => {
            if (items.length < 2) return;
            index = (index + d + items.length) % items.length;
            tampil();
        };

        document.querySelectorAll('[data-preview]').forEach(el =>
            el.addEventListener('click', () => buka(el.dataset.preview, el.dataset.title)));
        tutupBtn.addEventListener('click', tutup);
        prev.addEventListener('click', () => geser(-1));
        next.addEventListener('click', () => geser(1));
        modal.addEventListener('click', e => {
            if (e.target === modal) tutup();
        });
        document.addEventListener('keydown', e => {
            if (!modal.classList.contains('open')) return;
            if (e.key === 'Escape') tutup();
            if (e.key === 'ArrowLeft') geser(-1);
            if (e.key === 'ArrowRight') geser(1);
        });

        // Hitung naik untuk angka statistik
        if (!matchMedia('(prefers-reduced-motion: reduce)').matches && 'IntersectionObserver' in window) {
            const io = new IntersectionObserver(es => es.forEach(e => {
                if (!e.isIntersecting) return;
                io.unobserve(e.target);
                const raw = e.target.dataset.count;
                const target = parseInt(raw, 10);
                const suffix = raw.replace(/[0-9]/g, '');
                if (isNaN(target)) return;
                const t0 = performance.now();
                const dur = 1100;
                const step = t => {
                    const p = Math.min((t - t0) / dur, 1);
                    e.target.textContent = Math.round(target * (1 - Math.pow(1 - p, 3))) + suffix;
                    if (p < 1) requestAnimationFrame(step);
                };
                requestAnimationFrame(step);
            }), {
                threshold: .6
            });
            document.querySelectorAll('[data-count]').forEach(el => io.observe(el));
        }
    })();
</script>

<?= $this->endSection() ?>