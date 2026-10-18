<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/pages');
        }
        return view('auth/login');
    }

    public function loginProcess()
    {
        $session = session();
        $model   = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->orWhere('email', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {

                $sessionData = [
                    'user_id'    => $user['id'],
                    'username'   => $user['username'],
                    'email'      => $user['email'],
                    'role'       => $user['role'],
                    'foto'       => $user['photo'] ?? '',
                    'isLoggedIn' => true,
                ];

                $session->set($sessionData);
                return redirect()->to('/pages');
            } else {
                $session->setFlashdata('msg', 'Password salah!');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Username/Email tidak ditemukan!');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
