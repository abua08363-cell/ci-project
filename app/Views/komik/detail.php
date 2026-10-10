<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">

            <!-- Tombol Kembali -->
            <a href="/komik" class="btn btn-outline-secondary mb-3 btn-sm">
                <i class="bi bi-arrow-left"></i> &larr; Kembali ke Daftar Komik
            </a>

            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="row g-0 align-items-center">

                    <!-- Gambar Sampul -->
                    <div class="col-md-5 bg-light text-center p-3">
                        <img src="/img/<?= $komik['gambar']; ?>"
                            class="img-fluid rounded shadow-sm"
                            alt="<?= $komik['judul']; ?>"
                            style="max-height: 280px; object-fit: cover;">
                    </div>

                    <!-- Detail Informasi -->
                    <div class="col-md-7">
                        <div class="card-body p-4">
                            <span class="badge bg-primary bg-opacity-10 text-primary mb-2">Detail Komik</span>
                            <h3 class="card-title fw-bold text-dark mb-3"><?= $komik['judul']; ?></h3>

                            <div class="mb-4">
                                <p class="card-text mb-1">
                                    <span class="text-muted small d-block">Penulis</span>
                                    <strong class="text-dark"><?= $komik['penulis']; ?></strong>
                                </p>
                                <hr class="my-2 text-muted opacity-25">
                                <p class="card-text mb-0">
                                    <span class="text-muted small d-block">Penerbit</span>
                                    <strong class="text-dark"><?= $komik['penerbit']; ?></strong>
                                </p>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="d-flex align-items-center gap-2 pt-2 border-top">
                                <a href="/komik/edit/<?= $komik['slug']; ?>" class="btn btn-warning btn-sm fw-semibold">
                                    Edit
                                </a>

                                <form action="/komik/<?= $komik['id']; ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus komik ini?');">
                                        Delete
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>