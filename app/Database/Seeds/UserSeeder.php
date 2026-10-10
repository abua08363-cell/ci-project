<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();

        // Kosongkan tabel users
        $this->db->table('users')->truncate();

        $data = [
            [
                'username'  => 'admin',
                'email'     => 'admin@unilam.ac.id',
                'password'  => password_hash('password', PASSWORD_BCRYPT),
                'role'      => 'admin',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'  => 'albu',
                'email'     => 'albu@unilam.ac.id',
                'password'  => password_hash('password', PASSWORD_BCRYPT),
                'role'      => 'admin',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'  => 'rifki',
                'email'     => 'rifki@unilam.ac.id',
                'password'  => password_hash('password', PASSWORD_BCRYPT),
                'role'      => 'user',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'  => 'slaman',
                'email'     => 'slaman@unilam.ac.id',
                'password'  => password_hash('password', PASSWORD_BCRYPT),
                'role'      => 'user',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        /// Insert batch langsung via Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}
