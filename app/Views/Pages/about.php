<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="bg-white rounded-2xl shadow-sm p-6 md:p-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 items-start">

        <!-- Foto & nama -->
        <div class="flex flex-col items-center text-center space-y-4">
            <div class="w-40 h-40 rounded-full p-1 bg-gradient-to-tr from-indigo-500 via-blue-500 to-sky-500">
                <img src="<?= base_url('img/albu.jpeg') ?>" alt="Foto profil" class="w-full h-full object-cover rounded-full border-4 border-white">
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-900">Muhamad Albuhori</h2>
                <p class="text-sm text-indigo-600 font-medium">Web Developer & Designer</p>
            </div>
        </div>

        <!-- Konten -->
        <div class="md:col-span-2 space-y-6">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">About Me</h1>
                <p class="mt-3 text-slate-600 leading-relaxed">
                    Halo! Saya seorang developer yang bersemangat dalam membangun aplikasi web modern, responsif, dan interaktif. Saya menikmati proses mengubah ide-ide kreatif menjadi baris kode yang bersih dan fungsional.
                </p>
            </div>

            <!-- Statistik -->
            <div class="grid grid-cols-3 gap-4">
                <?php
                $stat = [
                    ['2+', 'Years Exp.', 'bg-indigo-50 text-indigo-600'],
                    ['15+', 'Projects Completed', 'bg-emerald-50 text-emerald-600'],
                    ['100%', 'Client Satisfaction', 'bg-amber-50 text-amber-600'],
                ];
                foreach ($stat as [$angka, $label, $warna]) : ?>
                    <div class="rounded-xl p-4 text-center <?= $warna; ?>">
                        <span class="block text-2xl font-bold"><?= $angka; ?></span>
                        <span class="text-xs text-slate-500"><?= $label; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Skill -->
            <div>
                <h3 class="text-sm font-semibold text-slate-900 mb-3">Tech Stack & Skills</h3>
                <div class="flex flex-wrap gap-2">
                    <?php
                    $skills = [
                        'CodeIgniter 4' => 'bg-sky-100 text-sky-700',
                        'PHP' => 'bg-indigo-100 text-indigo-700',
                        'Tailwind CSS' => 'bg-cyan-100 text-cyan-700',
                        'JavaScript' => 'bg-emerald-100 text-emerald-700',
                        'MySQL' => 'bg-amber-100 text-amber-700',
                    ];
                    foreach ($skills as $nama => $warna) : ?>
                        <span class="px-3 py-1 text-xs font-medium rounded-full <?= $warna; ?>"><?= $nama; ?></span>
                    <?php endforeach; ?>
                </div>
            </div>

            <a href="<?= base_url('pages/contact') ?>" class="inline-flex px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors">
                Contact Me
            </a>
        </div>
    </div>
</div>

<?php
$sertifikat = $sertifikat ?? [
    ['judul' => 'Belajar Dasar Pemrograman Web', 'penerbit' => 'Dicoding Indonesia', 'tanggal' => '2025-03-12', 'file' => 'html.jpeg'],
    ['judul' => 'Belajar Fundamental Back-End',   'penerbit' => 'Dicoding Indonesia', 'tanggal' => '2025-06-20', 'file' => 'goku.jpg'],
    ['judul' => 'Workshop CodeIgniter 4',         'penerbit' => 'Universitas Lambung Mangkurat', 'tanggal' => '2026-01-15', 'file' => 'wa.jpeg'],
    ['judul' => 'Workshop CodeIgniter 4',         'penerbit' => 'Universitas Lambung Mangkurat', 'tanggal' => '2026-01-15', 'file' => 'workshop-ci4.pdf'],
];
?>

<!-- Sertifikat -->
<section class="mt-6 bg-white rounded-2xl shadow-sm p-6 md:p-10">
    <div class="flex items-end justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Sertifikat</h2>
            <p class="mt-1 text-sm text-slate-500">Kumpulan sertifikat pelatihan dan pencapaian yang pernah saya peroleh.</p>
        </div>
        <span class="shrink-0 px-3 py-1 text-xs font-medium rounded-full bg-indigo-50 text-indigo-600">
            <?= count($sertifikat); ?> Sertifikat
        </span>
    </div>

    <?php if (empty($sertifikat)) : ?>
        <div class="mt-6 rounded-xl border-2 border-dashed border-slate-200 py-12 text-center">
            <svg class="mx-auto w-10 h-10 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
            </svg>
            <p class="mt-3 text-sm text-slate-400">Belum ada sertifikat yang ditambahkan.</p>
        </div>
    <?php else : ?>
        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($sertifikat as $s) :
                // Path langsung mengarah ke public/img/
                $url = base_url('img/' . $s['file']);
                $ext = strtolower(pathinfo($s['file'], PATHINFO_EXTENSION));
                $isPdf = ($ext === 'pdf');
            ?>
                <article class="group rounded-xl border border-slate-100 overflow-hidden hover:shadow-md transition-shadow">
                    <!-- Pratinjau Gambar / Icon PDF -->
                    <?php if (!$isPdf) : ?>
                        <button type="button" data-preview="<?= esc($url, 'attr'); ?>" data-title="<?= esc($s['judul'], 'attr'); ?>"
                            class="block w-full aspect-[4/3] bg-slate-50 overflow-hidden">
                            <img src="<?= esc($url, 'attr'); ?>" alt="<?= esc($s['judul'], 'attr'); ?>" loading="lazy"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </button>
                    <?php else : ?>
                        <div class="w-full aspect-[4/3] bg-slate-50 flex flex-col items-center justify-center text-slate-400">
                            <svg class="w-12 h-12 stroke-current" fill="none" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="mt-2 text-xs font-medium">Dokumen PDF</span>
                        </div>
                    <?php endif; ?>

                    <!-- Info -->
                    <div class="p-4">
                        <h3 class="font-semibold text-slate-900 leading-snug"><?= esc($s['judul']); ?></h3>
                        <p class="mt-1 text-sm text-slate-500"><?= esc($s['penerbit']); ?></p>
                        <div class="mt-3 flex items-center justify-between">
                            <span class="text-xs text-slate-400"><?= date('d M Y', strtotime($s['tanggal'])); ?></span>
                            <?php if ($isPdf) : ?>
                                <a href="<?= esc($url, 'attr'); ?>" target="_blank" rel="noopener noreferrer"
                                    class="text-xs font-medium text-indigo-600 hover:text-indigo-800">Buka PDF &rarr;</a>
                            <?php else : ?>
                                <button type="button" data-preview="<?= esc($url, 'attr'); ?>" data-title="<?= esc($s['judul'], 'attr'); ?>"
                                    class="text-xs font-medium text-indigo-600 hover:text-indigo-800">Lihat &rarr;</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<!-- Modal pratinjau -->
<div id="sertifikat-modal" class="hidden fixed inset-0 z-50 bg-slate-900/80 p-4 flex items-center justify-center" role="dialog" aria-modal="true">
    <div class="relative max-w-4xl w-full">
        <button type="button" id="sertifikat-tutup" aria-label="Tutup"
            class="absolute -top-10 right-0 text-white/80 hover:text-white text-sm">Tutup &times;</button>
        <img id="sertifikat-gambar" src="" alt="" class="w-full max-h-[80vh] object-contain rounded-lg bg-white">
        <p id="sertifikat-judul" class="mt-3 text-center text-sm text-white/90"></p>
    </div>
</div>

<script>
    (function() {
        const modal = document.getElementById('sertifikat-modal');
        const gambar = document.getElementById('sertifikat-gambar');
        const judul = document.getElementById('sertifikat-judul');

        const buka = (src, title) => {
            gambar.src = src;
            gambar.alt = title;
            judul.textContent = title;
            modal.classList.remove('hidden');
        };
        const tutup = () => {
            modal.classList.add('hidden');
            gambar.src = '';
        };

        document.querySelectorAll('[data-preview]').forEach(el =>
            el.addEventListener('click', () => buka(el.dataset.preview, el.dataset.title)));
        document.getElementById('sertifikat-tutup').addEventListener('click', tutup);
        modal.addEventListener('click', e => {
            if (e.target === modal) tutup();
        });
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') tutup();
        });
    })();
</script>

<?= $this->endSection() ?>