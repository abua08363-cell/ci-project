<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 py-6">
    <!-- Section Header (Judul & Tombol) -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-100"><?= $title ?></h1>
            <p class="text-gray-200 text-sm mt-1">Daftar koleksi komik yang tersedia dalam database.</p>
        </div>

        <div>
            <a href="/komik/create" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition-colors duration-150">
                + Tambah Komik
            </a>
        </div>
    </div>

    <!-- Notifikasi (Dipisah di luar container flex header) -->
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="mb-6 w-full bg-green-100 border border-green-200 text-green-800 px-4 py-2 rounded-lg shadow-sm">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <th scope="col" class="py-3 px-4">No</th>
                        <th scope="col" class="py-3 px-4">Gambar</th>
                        <th scope="col" class="py-3 px-4">Judul</th>
                        <th scope="col" class="py-3 px-4">Penulis</th>
                        <th scope="col" class="py-3 px-4">Penerbit</th>
                        <th scope="col" class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                    <?php $no = 1; ?>
                    <?php foreach ($komik as $k) : ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-4 font-medium text-gray-900"><?= $no++; ?></td>
                            <td class="py-3 px-4">
                                <img src="/img/<?= $k['gambar']; ?>" alt="<?= $k['judul']; ?>" class="w-12 h-12 rounded-full object-cover shadow-sm">
                            </td>
                            <td class="py-3 px-4 font-semibold text-gray-900"><?= $k['judul']; ?></td>
                            <td class="py-3 px-4"><?= $k['penulis']; ?></td>
                            <td class="py-3 px-4"><?= $k['penerbit']; ?></td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="/komik/<?= $k['slug']; ?>" class="px-3 py-1 bg-sky-100 text-sky-700 hover:bg-sky-200 text-xs font-medium rounded-md transition-colors">
                                        Detail
                                    </a>
                                    <a href="/komik/edit/<?= $k['slug']; ?>" class="px-3 py-1 bg-amber-100 text-amber-700 hover:bg-amber-200 text-xs font-medium rounded-md transition-colors">
                                        Edit
                                    </a>
                                    <form action="/komik/<?= $k['id']; ?>" method="post" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus komik ini?');">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-rose-50 text-rose-600 hover:bg-rose-100 border border-rose-200 text-xs font-semibold rounded-lg transition-colors">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>