<?php

namespace App\Controllers;

use App\Models\UserModel;

class Pages extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $data = [
            'title' => 'Dashboard | Albu Project',
            'users' => $userModel->orderBy('created_at', 'DESC')->findAll()
        ];

        return view('Pages/home', $data);
    }

    public function home()
    {
        return $this->index();
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
                    'tipe'      => 'Universitas La Tansa Mashiro',
                    'jalan'     => 'Jl. Soekarno-Hatta (By Pass) Rangkasbitung',
                    'kota'      => 'Lebak',
                    'provinsi'  => 'Banten',
                    'kode_pos'  => '42312',
                    'telepon'   => '(0252) 201124'
                ],
                [
                    'tipe'      => 'Rumah',
                    'jalan'     => 'Jl. Raya Leuwidamar KM. 19, Kp. Talagasari',
                    'kota'      => 'Wantisari, Leuwidamar, Lebak',
                    'provinsi'  => 'Banten',
                    'kode_pos'  => '42362',
                    'telepon'   => '0857-1533-0893'
                ]
            ]
        ];
        return view('Pages/contact', $data);
    }

    public function kirimPesan()
    {
        return redirect()->to('/pages/contact');
    }
}
