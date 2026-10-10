<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 py-6">
    <div class="max-w-2xl mx-auto">
        <!-- Header & Tombol Kembali -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-200"><?= $title; ?></h1>
                <p class="text-gray-500 text-sm mt-1">Isi formulir di bawah ini untuk menambahkan komik baru.</p>
            </div>
            <a href="/komik" class="inline-flex items-center px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition-colors">
                &larr; Kembali
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form action="/komik/save" method="post" enctype="multipart/form-data" class="space-y-5">
                <?= csrf_field(); ?>

                <!-- Judul Komik -->
                <div>
                    <label for="judul" class="block text-sm font-semibold text-gray-700 mb-1">Judul Komik</label>
                    <input type="text" id="judul" name="judul" value="<?= old('judul'); ?>" autofocus required
                        class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400"
                        placeholder="Masukkan judul komik">
                </div>

                <!-- Penulis -->
                <div>
                    <label for="penulis" class="block text-sm font-semibold text-gray-700 mb-1">Penulis</label>
                    <input type="text" id="penulis" name="penulis" value="<?= old('penulis'); ?>" required
                        class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400"
                        placeholder="Nama penulis komik">
                </div>

                <!-- Penerbit -->
                <div>
                    <label for="penerbit" class="block text-sm font-semibold text-gray-700 mb-1">Penerbit</label>
                    <input type="text" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>" required
                        class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-400"
                        placeholder="Nama penerbit">
                </div>

                <!-- Upload Gambar Sampul -->
                <div>
                    <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-1">Gambar Sampul</label>

                    <!-- Box Preview Foto di ATAS Input -->
                    <div class="mb-3 w-32 h-44 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden bg-gray-50">
                        <img id="img-preview" src="" alt="Preview Sampul" class="w-full h-full object-cover hidden">
                        <div id="preview-text" class="text-center p-2">
                            <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-xs text-gray-400 block mt-1">Preview Foto</span>
                        </div>
                    </div>

                    <!-- Input File Gambar -->
                    <input type="file" id="gambar" name="gambar" accept="image/*" onchange="previewImg()" required
                        class="block w-full text-sm text-gray-700 bg-white border border-gray-300 rounded-lg cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, JPEG, PNG (Maksimal 2MB).</p>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-4 flex justify-end gap-2 border-t border-gray-100">
                    <a href="/komik" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition-colors">
                        Simpan Data
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
        const previewText = document.querySelector('#preview-text');

        if (gambar.files && gambar.files[0]) {
            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(gambar.files[0]);

            fileGambar.onload = function(e) {
                imgPreview.src = e.target.result;
                imgPreview.classList.remove('hidden');
                previewText.classList.add('hidden');
            }
        }
    }
</script>
<?= $this->endSection() ?>