<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header / Navigasi Kembali -->
    <div class="flex items-center justify-between bg-white px-6 py-4 rounded-2xl border border-slate-100 shadow-sm">
        <div>
            <h1 class="text-base font-bold text-slate-900">Edit Artikel</h1>
            <p class="text-xs text-slate-500 mt-0.5">Perbarui informasi, kategori, atau isi konten artikel.</p>
        </div>
        <a href="<?= base_url('/admin/articles'); ?>" class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-semibold transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>

    <!-- Form Container -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden p-6 sm:p-8">

        <!-- Notifikasi Error Validasi jika ada -->
        <?php if (session()->has('errors')) : ?>
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl text-xs space-y-1">
                <p class="font-bold">Terjadi kesalahan validasi:</p>
                <ul class="list-disc list-inside">
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= esc($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/admin/articles/update/' . $article['id']); ?>" method="post" enctype="multipart/form-data" class="space-y-6">
            <?= csrf_field(); ?>

            <!-- Judul Artikel -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Judul Artikel <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="<?= old('title', $article['title']); ?>" placeholder="Masukkan judul artikel..."
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition" required>
            </div>

            <!-- Kategori & Status Publikasi -->
            <div class="grid sm:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Kategori <span class="text-rose-500">*</span></label>
                    <input type="text" name="category" value="<?= old('category', $article['category']); ?>" placeholder="Contoh: Teknologi, Tutorial..."
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition" required>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Status Publikasi <span class="text-rose-500">*</span></label>
                    <select name="status" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-xl text-xs text-slate-800 focus:bg-white focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition">
                        <option value="published" <?= old('status', $article['status']) === 'published' ? 'selected' : ''; ?>>Published</option>
                        <option value="draft" <?= old('status', $article['status']) === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    </select>
                </div>
            </div>

            <!-- Gambar Sampul (Thumbnail) -->
            <div class="space-y-3 pt-2">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Gambar Sampul (Thumbnail)</label>

                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <!-- Tampilkan gambar lama jika ada -->
                    <?php if (!empty($article['image'])): ?>
                        <div id="current-image-container" class="relative group">
                            <p class="text-[11px] font-medium text-slate-400 mb-1">Gambar Saat Ini:</p>
                            <img src="<?= base_url('uploads/articles/' . $article['image']); ?>" alt="Current Thumbnail" class="w-36 h-24 object-cover rounded-xl border border-slate-200 shadow-sm">
                        </div>
                    <?php endif; ?>

                    <!-- Pratinjau Gambar Baru (Awalnya tersembunyi) -->
                    <div id="image-preview-container" class="hidden relative">
                        <p class="text-[11px] font-bold text-indigo-600 mb-1">Pratinjau Gambar Baru:</p>
                        <img id="image-preview" src="#" alt="Preview Thumbnail" class="w-36 h-24 object-cover rounded-xl border-2 border-indigo-500 shadow-md">
                    </div>
                </div>

                <!-- Input File Kustom -->
                <div class="relative">
                    <input type="file" name="image" id="image-input" accept="image/*"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-xl text-xs text-slate-600 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 transition cursor-pointer">
                </div>
                <p class="text-[11px] text-slate-400">Format yang didukung: JPG, JPEG, PNG. Biarkan kosong jika tidak ingin mengubah gambar.</p>
            </div>

            <!-- Isi Konten Artikel -->
            <div class="space-y-1.5 pt-2">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Isi Konten Artikel <span class="text-rose-500">*</span></label>
                <textarea name="content" rows="10" placeholder="Tulis isi artikel di sini..."
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200/80 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition leading-relaxed" required><?= old('content', $article['content']); ?></textarea>
            </div>

            <!-- Tombol Aksi -->
            <div class="pt-5 flex items-center justify-end gap-3 border-t border-slate-100">
                <a href="<?= base_url('/admin/articles'); ?>" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-xl transition">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl transition shadow-md shadow-indigo-500/20 hover:shadow-lg">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript untuk Live Preview Gambar Baru -->
<script>
    const imageInput = document.getElementById('image-input');
    const imagePreview = document.getElementById('image-preview');
    const previewContainer = document.getElementById('image-preview-container');
    const currentImageContainer = document.getElementById('current-image-container');

    if (imageInput) {
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewContainer.classList.remove('hidden'); // Tampilkan preview gambar baru
                    if (currentImageContainer) {
                        currentImageContainer.style.opacity = '0.3'; // Redupkan gambar lama sebagai indikator
                    }
                }
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = '#';
                previewContainer.classList.add('hidden');
                if (currentImageContainer) {
                    currentImageContainer.style.opacity = '1';
                }
            }
        });
    }
</script>
<?= $this->endSection(); ?>