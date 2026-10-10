<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilModel extends Model
{
    protected $table         = 'profil';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'alamat', 'tanggal_lahir', 'jenis_kelamin', 'gambar'];

    public function getProfil($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function search($keyword)
    {
        $keyword = trim((string) $keyword);

        if ($keyword === '') {
            return $this;
        }

        $lower = strtolower($keyword);

        // 1. Kalau user ngetik kata yang artinya Laki-laki (L)
        if (in_array($lower, ['l', 'laki', 'laki-laki', 'pria'])) {
            return $this->where('jenis_kelamin', 'L');
        }

        // 2. Kalau user ngetik kata yang artinya Perempuan (P)
        if (in_array($lower, ['p', 'perempuan', 'wanita'])) {
            return $this->where('jenis_kelamin', 'P');
        }

        // 3. Kalau ngetik Nama atau Alamat biasa
        return $this->like('nama', $keyword)
            ->orLike('alamat', $keyword)
            ->orLike('tanggal_lahir', $keyword);
    }
}
