<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ArticleModel;

class Home extends BaseController
{
    public function index()
    {
        $articleModel = new ArticleModel();

        $data = [
            'articles' => $articleModel->where('status', 'published')
                ->orderBy('created_at', 'DESC')
                ->findAll()
        ];

        return view('welcome_message', $data); // (Atau sesuaikan nama file view Anda)
    }

    // Fungsi untuk menangani halaman detail saat "Baca Selengkapnya" diklik
    public function articleDetail($slug)
    {
        $articleModel = new ArticleModel();

        // Cari artikel berdasarkan slug
        $article = $articleModel->where('slug', $slug)->first();

        // Jika artikel tidak ditemukan, kembalikan ke halaman utama
        if (empty($article)) {
            return redirect()->to('/#articles')->with('error', 'Artikel tidak ditemukan.');
        }

        $data = [
            'title'   => $article['title'],
            'article' => $article
        ];

        // Mengarah ke folder articles/ di dalam Views
        return view('articles/article_detail', $data);
    }

    public function dashboard()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();

        return view('dashboard', $data);
    }
}
