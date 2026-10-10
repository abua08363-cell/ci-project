<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 py-6">
    <div class="max-w-2xl mx-auto">
        <!-- Header & Tombol Kembali -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-200"><?= $title; ?></h1>
                <p class="text-gray-500 text-sm mt-1">Ubah data komik di bawah ini.</p>
            </div>
            <a href="/komik" class="inline-flex items-center px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition-colors">
                &larr; Batal
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form action="/komik/update/<?= $komik['id']; ?>" method="post" enctype="multipart/form-data" class="space-y-5">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $komik['slug']; ?>">
                <input type="hidden" name="gambarLama" value="<?= $komik['gambar']; ?>">

                <!-- Judul Komik -->
                <div>
                    <label for="judul" class="block text-sm font-semibold text-gray-700 mb-1">Judul Komik</label>
                    <input type="text" id="judul" name="judul" value="<?= old('judul', $komik['judul']); ?>" autofocus required
                        class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="Masukkan judul komik">
                </div>

                <!-- Penulis -->
                <div>
                    <label for="penulis" class="block text-sm font-semibold text-gray-700 mb-1">Penulis</label>
                    <input type="text" id="penulis" name="penulis" value="<?= old('penulis', $komik['penulis']); ?>" required
                        class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="Nama penulis komik">
                </div>

                <!-- Penerbit -->
                <div>
                    <label for="penerbit" class="block text-sm font-semibold text-gray-700 mb-1">Penerbit</label>
                    <input type="text" id="penerbit" name="penerbit" value="<?= old('penerbit', $komik['penerbit']); ?>" required
                        class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="Nama penerbit">
                </div>

                <!-- Upload Gambar Sampul -->
                <div>
                    <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-1">Gambar Sampul</label>

                    <!-- Box Preview Foto Saat Ini -->
                    <div class="mb-3 w-32 h-44 rounded-lg border border-gray-300 overflow-hidden bg-gray-50 shadow-sm">
                        <img id="img-preview" src="/img/<?= $komik['gambar']; ?>" alt="Preview Sampul" class="w-full h-full object-cover">
                    </div>

                    <!-- Input File Gambar -->
                    <input type="file" id="gambar" name="gambar" accept="image/*" onchange="previewImg()"
                        class="block w-full text-sm text-gray-700 bg-white border border-gray-300 rounded-lg cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-4 flex justify-end gap-2 border-t border-gray-100">
                    <a href="/komik" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg shadow transition-colors">
                        Ubah Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script Javascript Preview Gambar -->
<script>
    function previewImg() {
        const gambar = document.querySelector('#gambar');
        const imgPreview = document.querySelector('#img-preview');

        if (gambar.files && gambar.files[0]) {
            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(gambar.files[0]);

            fileGambar.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    }
</script>
<?= $this->endSection() ?>