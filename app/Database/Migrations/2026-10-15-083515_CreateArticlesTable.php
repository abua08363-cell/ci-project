<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'slug'        => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'category'    => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'image'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true, // Dibuat nullable agar artikel tanpa foto tetap bisa dibuat
            ],
            'content'     => [
                'type' => 'TEXT',
            ],
            'status'      => [
                'type'       => 'ENUM',
                'constraint' => ['published', 'draft'],
                'default'    => 'published',
            ],
            'views'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'created_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('articles');
    }

    public function down()
    {
        $this->forge->dropTable('articles');
    }
}
