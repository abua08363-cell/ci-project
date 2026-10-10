<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class ProfilSeeder extends Seeder
{
    public function run()
    {

        $faker = Factory::create('id_ID');

        for ($i = 0; $i < 50; $i++) {
            $data = [
                'nama'          => $faker->name(),
                'alamat'        => $faker->address(),
                'tanggal_lahir' => $faker->date(),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'created_at'    => Time::createFromTimestamp($faker->unixTime()),
                'updated_at'    => Time::createFromTimestamp($faker->unixTime()),
            ];
            $this->db->table('profil')->insert($data);
        }


        // $data = [

        //     [
        //         'nama'          => $faker->name(),
        //         'alamat'        => $faker->address(),
        //         'tanggal_lahir' => $faker->date(),
        //         'jenis_kelamin' => $faker->randomElement(['L', 'P']),
        //         'created_at'    => Time::createFromTimestamp($faker->unixTime()),
        //         'updated_at'    => Time::createFromTimestamp($faker->unixTime()),
        //     ],
        // ];

        // $this->db->table('profil')->insertBatch($data);
    }
}
