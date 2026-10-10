<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
        // Cek login session jika diperlukan
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();

        // Ambil semua data user
        $data['users'] = $userModel->findAll();

        // PENTING: Kirim $data sebagai parameter kedua
        return view('dashboard', $data);
    }
}
