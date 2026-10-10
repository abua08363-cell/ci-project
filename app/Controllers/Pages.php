<?php

namespace App\Controllers;

use App\Models\UserModel; // 1. Import UserModel

class Pages extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        // 2. Ambil semua data user dari database
        $data = [
            'title' => 'Dashboard | Albu Project',
            'users' => $userModel->orderBy('created_at', 'DESC')->findAll()
        ];

        // 3. Kirim $data ke view Pages/home
        return view('Pages/home', $data);
    }

    public function home()
    {
        return $this->index(); // Samakan dengan index
    }

    public function about()
    {
        $data = [
            'title' => 'About Me | Portfolio Saya'
        ];
        return view('Pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact | Portfolio Saya',
            'alamat' => [
                [
                    'tipe'      => 'Kantor / Studio',
                    'jalan'     => 'Jl. Asia Afrika No. 45',
                    'kota'      => 'Bandung',
                    'provinsi'  => 'Jawa Barat',
                    'kode_pos'  => '40111',
                    'telepon'   => '022-1234567'
                ],
                [
                    'tipe'      => 'Rumah',
                    'jalan'     => 'Jl. Soekarno Hatta No. 88',
                    'kota'      => 'Bandung',
                    'provinsi'  => 'Jawa Barat',
                    'kode_pos'  => '40286',
                    'telepon'   => '0812-3456-7890'
                ]
            ]
        ];
        return view('Pages/contact', $data);
    }

    public function kirimPesan()
    {
        $nama  = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $pesan = $this->request->getPost('pesan');

        session()->setFlashdata('pesan', 'Pesan Anda berhasil terkirim!');

        return redirect()->to('/pages/contact');
    }
}
