<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    protected UserModel $users;

    public function __construct()
    {
        $this->users = new UserModel();
    }

    /** Daftar user + pencarian */
    public function index()
    {
        $keyword = trim((string) $this->request->getGet('q'));

        $builder = $this->users;
        if ($keyword !== '') {
            $builder = $builder->groupStart()
                ->like('username', $keyword)
                ->orLike('email', $keyword)
                ->groupEnd();
        }

        return view('users/index', [
            'title'   => 'Users',
            'users'   => $builder->orderBy('created_at', 'DESC')->findAll(),
            'keyword' => $keyword,
        ]);
    }

    /** Form tambah */
    public function create()
    {
        $idLogin   = session()->get('user_id') ?? session()->get('id');
        $loginUser = $this->users->find($idLogin);
        $roleLogin = strtolower($loginUser['role'] ?? '');

        if ($roleLogin !== 'admin') {
            return redirect()->to('/users')->with('error', 'Akses ditolak: Hanya Admin yang dapat menambah user baru.');
        }

        return view('users/form', ['title' => 'Tambah Users', 'mode' => 'create']);
    }

    /** Simpan user baru */
    public function store()
    {
        $idLogin   = session()->get('user_id') ?? session()->get('id');
        $loginUser = $this->users->find($idLogin);
        $roleLogin = strtolower($loginUser['role'] ?? '');

        if ($roleLogin !== 'admin') {
            return redirect()->to('/users')->with('error', 'Akses ditolak: Hanya Admin yang dapat menambah user baru.');
        }

        $rules = [
            'username'         => 'required|min_length[3]|is_unique[users.username]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'phone'            => 'permit_empty|numeric|min_length[9]',
            'role'             => 'required|in_list[admin,user]',
            'is_active'        => 'required|in_list[0,1]',
            'password'         => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ];

        $file = $this->request->getFile('photo');
        if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
            $rules['photo'] = 'is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png,image/webp]|max_size[photo,2048]';
        }

        if (! $this->validate($rules, $this->pesan())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->users->insert([
            'username'  => $this->request->getPost('username'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone') ?: null,
            'role'      => $this->request->getPost('role'),
            'is_active' => $this->request->getPost('is_active'),
            'password'  => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'photo'     => $this->simpanFoto(),
        ]);

        return redirect()->to('/users')->with('success', 'User baru berhasil ditambahkan oleh Admin.');
    }

    /** Form edit */
    public function edit($id = null)
    {
        $idLogin   = session()->get('user_id') ?? session()->get('id');
        $loginUser = $this->users->find($idLogin);
        $roleLogin = strtolower($loginUser['role'] ?? '');

        // Jika BUKAN admin DAN ID yang diedit bukan miliknya sendiri, tolak
        if ($roleLogin !== 'admin' && (string) $id !== (string) $idLogin) {
            if ($roleLogin === 'user') {
                return redirect()->to('/users')->with('error', 'Akses edit ditolak: User biasa hanya dapat mengedit akun sendiri.');
            }
            return redirect()->to('/users')->with('error', 'Akses edit ditolak: Anda tidak memiliki izin.');
        }

        $user = $this->users->find($id);
        if (! $user) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan.');
        }

        return view('users/form', ['title' => 'Edit User', 'mode' => 'edit', 'user' => $user]);
    }

    /** Simpan perubahan */
    public function update($id = null)
    {
        $idLogin   = session()->get('user_id') ?? session()->get('id');
        $loginUser = $this->users->find($idLogin);
        $roleLogin = strtolower($loginUser['role'] ?? '');

        $user = $this->users->find($id);
        if (! $user) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan.');
        }

        // Jika BUKAN admin DAN ID yang di-update bukan miliknya sendiri, tolak
        if ($roleLogin !== 'admin' && (string) $id !== (string) $idLogin) {
            if ($roleLogin === 'user') {
                return redirect()->to('/users')->with('error', 'Update ditolak: User biasa tidak diizinkan mengubah data pengguna lain.');
            }
            return redirect()->to('/users')->with('error', 'Update ditolak: Anda tidak memiliki izin.');
        }

        $rules = [
            'username'         => "required|min_length[3]|is_unique[users.username,id,{$id}]",
            'email'            => "required|valid_email|is_unique[users.email,id,{$id}]",
            'phone'            => 'permit_empty|numeric|min_length[9]',
            'role'             => 'required|in_list[admin,user]',
            'is_active'        => 'required|in_list[0,1]',
            'password'         => 'permit_empty|min_length[8]',
            'password_confirm' => 'matches[password]',
        ];

        $file = $this->request->getFile('photo');
        if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
            $rules['photo'] = 'is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png,image/webp]|max_size[photo,2048]';
        }

        if (! $this->validate($rules, $this->pesan())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username'  => $this->request->getPost('username'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone') ?: null,
            'role'      => $this->request->getPost('role'),
            'is_active' => $this->request->getPost('is_active'),
        ];

        // Jika yang update adalah user biasa (bukan admin), kunci role & status aktifnya
        if ($roleLogin !== 'admin') {
            $data['role']      = $user['role'];
            $data['is_active'] = $user['is_active'];
        }

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $fotoBaru = $this->simpanFoto();
        if ($fotoBaru) {
            $this->hapusFoto($user['photo'] ?? null);
            $data['photo'] = $fotoBaru;
        } elseif ($this->request->getPost('remove_photo')) {
            $this->hapusFoto($user['photo'] ?? null);
            $data['photo'] = null;
        }

        $this->users->update($id, $data);

        // Notifikasi & update session jika akun sendiri yang diedit
        if ((string) $id === (string) $idLogin) {
            $updatedUser = $this->users->find($id);
            session()->set([
                'username' => $updatedUser['username'],
                'email'    => $updatedUser['email'],
                'foto'     => $updatedUser['photo'] ?? '',
                'role'     => $updatedUser['role'],
            ]);

            return redirect()->to('/users')->with('success', 'Profil Anda berhasil diperbarui.');
        }

        return redirect()->to('/users')->with('success', 'Data user berhasil diperbarui oleh Admin.');
    }

    /** Hapus user */
    public function delete($id = null)
    {
        $idLogin   = session()->get('user_id') ?? session()->get('id');
        $loginUser = $this->users->find($idLogin);
        $roleLogin = strtolower($loginUser['role'] ?? '');

        // Pengecekan spesifik untuk Hapus berdasarkan role
        if ($roleLogin === 'user') {
            return redirect()->to('/users')->with('error', 'Akses hapus ditolak: User biasa tidak diizinkan untuk menghapus data pengguna.');
        }

        if ($roleLogin !== 'admin') {
            return redirect()->to('/users')->with('error', 'Akses hapus ditolak: Anda tidak memiliki hak akses.');
        }

        // Admin mencoba menghapus akunnya sendiri yang sedang aktif
        if ((string) $id === (string) $idLogin) {
            return redirect()->to('/users')->with('error', 'Aksi dibatalkan: Anda tidak dapat menghapus akun Anda sendiri yang sedang digunakan.');
        }

        $user = $this->users->find($id);
        if (! $user) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan.');
        }

        $this->hapusFoto($user['photo'] ?? null);
        $this->users->delete($id);

        return redirect()->to('/users')->with('success', 'Akun user berhasil dihapus oleh Admin.');
    }

    private function simpanFoto(): ?string
    {
        $file = $this->request->getFile('photo');
        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return null;
        }

        $nama = $file->getRandomName();
        $file->move(FCPATH . 'uploads/users', $nama);

        return $nama;
    }

    private function hapusFoto(?string $nama): void
    {
        if ($nama) {
            $path = FCPATH . 'uploads/users/' . $nama;
            if (is_file($path)) {
                unlink($path);
            }
        }
    }

    private function pesan(): array
    {
        return [
            'username' => [
                'required'   => 'Username wajib diisi.',
                'min_length' => 'Username minimal 3 karakter.',
                'is_unique'  => 'Username sudah terdaftar.',
            ],
            'email' => [
                'required'    => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Email sudah terdaftar.',
            ],
            'phone' => [
                'numeric'    => 'No. HP hanya boleh angka.',
                'min_length' => 'No. HP minimal 9 digit.',
            ],
            'password' => [
                'required'   => 'Password wajib diisi.',
                'min_length' => 'Password minimal 8 karakter.',
            ],
            'photo' => [
                'is_image' => 'File harus berupa gambar.',
                'mime_in'  => 'Format foto harus JPG, PNG, atau WEBP.',
                'max_size' => 'Ukuran foto maksimal 2 MB.',
            ],
            'password_confirm' => [
                'required' => 'Konfirmasi password wajib diisi.',
                'matches'  => 'Konfirmasi password tidak sama.',
            ],
        ];
    }
}
