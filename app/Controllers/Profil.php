<?php

namespace App\Controllers;

use App\Models\ProfilModel;

class Profil extends BaseController
{
    protected ProfilModel $profilModel;

    public function __construct()
    {
        $this->profilModel = new ProfilModel();
    }

    public function index()
    {

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $profil = $this->profilModel->search($keyword);
        } else {
            $profil = $this->profilModel;
        }

        $data = [
            'title'   => 'Daftar Profil',
            'profil'  => $profil->paginate(7, 'profil'),
            'pager'   => $this->profilModel->pager,
            'keyword' => $keyword
        ];

        return view('profil', $data);
    }

    public function detail($id)
    {
        $data = [
            'title'  => 'Detail Profil',
            'profil' => $this->profilModel->getProfil($id)
        ];

        if (empty($data['profil'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Profil dengan ID "' . $id . '" tidak ditemukan.');
        }

        return view('profil/detail', $data);
    }

    public function create()
    {

        $data = [
            'title' => 'Form Tambah Data Profil'
        ];
        return view('create', $data);
    }

    public function save()
    {

        $this->profilModel->save([
            'nama'    => $this->request->getVar('nama'),
            'alamat'  => $this->request->getVar('alamat'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin')
        ]);

        session()->setFlashdata('pesan', 'Data profil berhasil ditambahkan.');

        return redirect()->to('/profil');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Form Ubah Data Profil',
            'profil' => $this->profilModel->getProfil($id)
        ];

        return view('editprofil', $data);
    }

    public function update($id)
    {

        $this->profilModel->save([
            'id'       => $id,
            'nama'     => $this->request->getVar('nama'),
            'alamat'   => $this->request->getVar('alamat'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin')
        ]);

        return redirect()->to('/profil');
    }

    public function delete($id)
    {
        $this->profilModel->delete($id);
        session()->setFlashdata('pesan', 'Data profil berhasil dihapus.');
        return redirect()->to('/profil');
    }
}
