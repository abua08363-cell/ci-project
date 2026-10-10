<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProfilTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'tanggal_lahir' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => ['L', 'P'],
                'null'       => true, // Sesuaikan ke false jika wajib diisi
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Set Primary Key
        $this->forge->addKey('id', true);

        // Buat Tabel
        $this->forge->createTable('profil');
    }

    public function down()
    {
        // Menghapus tabel profil saat rollback
        $this->forge->dropTable('profil');
    }
}
