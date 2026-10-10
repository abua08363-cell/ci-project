<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
    protected $komikModel;

    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik()
        ];

        return view('komik/index', $data);
    }

    public function detail($slug)
    {

        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        // Jika komik tidak ditemukan, tampilkan halaman 404
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik "' . $slug . '" tidak ditemukan.');
        }

        return view('komik/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Komik'
        ];

        return view('komik/create', $data);
    }

    public function save()
    {
        //ambil file gambar dari form
        $fileGambar = $this->request->getFile('gambar');

        if ($fileGambar && $fileGambar->getError() == 4) {
            // Jika user tidak memilih file gambar, gunakan gambar bawaan
            $namaGambar = 'default.jpg';
        } else {
            // Buat nama file acak (unik) agar tidak bentrok
            $namaGambar = $fileGambar->getRandomName();

            // Pindahkan file gambar ke folder public/img
            $fileGambar->move('img', $namaGambar);
        }
        // Membuat slug otomatis dari judul
        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->komikModel->save([
            'judul'    => $this->request->getVar('judul'),
            'slug'     => $slug,
            'penulis'  => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'gambar'   => $namaGambar
        ]);

        session()->setFlashdata('pesan', 'Data komik berhasil ditambahkan.');

        return redirect()->to('/komik');
    }


    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data Komik',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        return view('komik/edit', $data);
    }

    public function update($id)
    {
        $fileGambar = $this->request->getFile('gambar');

        // Cek apakah user memilih gambar baru
        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambarLama');
        } else {
            // Generate nama file baru
            $namaGambar = $fileGambar->getRandomName();
            // Pindahkan file ke public/img
            $fileGambar->move('img', $namaGambar);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->komikModel->save([
            'id'       => $id,
            'judul'    => $this->request->getVar('judul'),
            'slug'     => $slug,
            'penulis'  => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'gambar'   => $namaGambar
        ]);

        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        // Cari komik berdasarkan ID
        $komik = $this->komikModel->find($id);

        // Hapus file gambar jika bukan default.jpg
        if ($komik['gambar'] !== 'default.jpg' && file_exists('img/' . $komik['gambar'])) {
            unlink('img/' . $komik['gambar']);
        }

        // Hapus data komik dari database
        $this->komikModel->delete($id);

        return redirect()->to('/komik');
    }
}
