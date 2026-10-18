<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArticleModel;

class ArticleController extends BaseController
{
    protected $articleModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
    }

    // Fungsi helper privat untuk mengecek apakah user yang sedang login adalah admin
    private function checkAdmin()
    {
        $role = session()->get('role');

        if ($role !== 'admin') {
            return redirect()->to('/admin/articles')->with('error', 'Akses ditolak! Anda tidak memiliki izin untuk melakukan aksi ini.');
        }
    }

    public function index()
    {
        $data = [
            'title'    => 'Articles',
            'articles' => $this->articleModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('articles/index', $data);
    }

    public function create()
    {
        if ($res = $this->checkAdmin()) return $res;

        $data = ['title' => 'Tambah Artikel'];
        return view('articles/create', $data);
    }

    public function store()
    {
        if ($res = $this->checkAdmin()) return $res;

        // Ambil file gambar yang di-upload
        $fileImage = $this->request->getFile('image');
        $imageName = null;

        if ($fileImage && $fileImage->isValid() && !$fileImage->hasMoved()) {
            $imageName = $fileImage->getRandomName(); // Buat nama file unik
            $fileImage->move('uploads/articles', $imageName); // Pindahkan ke folder public/uploads/articles/
        }

        $this->articleModel->save([
            'title'    => $this->request->getPost('title'),
            'slug'     => url_title($this->request->getPost('title'), '-', true),
            'category' => $this->request->getPost('category'),
            'image'    => $imageName, // Simpan nama file gambar ke database
            'content'  => $this->request->getPost('content'),
            'status'   => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/articles')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if ($res = $this->checkAdmin()) return $res;

        $article = $this->articleModel->find($id);
        if (empty($article)) {
            return redirect()->to('/admin/articles')->with('error', 'Artikel tidak ditemukan.');
        }

        $data = [
            'title'   => 'Edit Artikel',
            'article' => $article
        ];
        return view('articles/edit', $data);
    }

    public function update($id)
    {
        if ($res = $this->checkAdmin()) return $res;

        $article = $this->articleModel->find($id);
        $fileImage = $this->request->getFile('image');
        $imageName = $article['image']; // Default pakai gambar lama

        if ($fileImage && $fileImage->isValid() && !$fileImage->hasMoved()) {
            $imageName = $fileImage->getRandomName();
            $fileImage->move('uploads/articles', $imageName);

            // Hapus file gambar lama jika ada
            if ($article['image'] && file_exists('uploads/articles/' . $article['image'])) {
                unlink('uploads/articles/' . $article['image']);
            }
        }

        $this->articleModel->update($id, [
            'title'    => $this->request->getPost('title'),
            'slug'     => url_title($this->request->getPost('title'), '-', true),
            'category' => $this->request->getPost('category'),
            'image'    => $imageName, // Perbarui nama file gambar di database
            'content'  => $this->request->getPost('content'),
            'status'   => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/articles')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function delete($id)
    {
        if ($res = $this->checkAdmin()) return $res;

        $article = $this->articleModel->find($id);

        // Hapus file fisik gambar jika ada saat artikel dihapus
        if (!empty($article['image']) && file_exists('uploads/articles/' . $article['image'])) {
            unlink('uploads/articles/' . $article['image']);
        }

        $this->articleModel->delete($id);

        return redirect()->to('/admin/articles')->with('success', 'Artikel berhasil dihapus!');
    }
}
