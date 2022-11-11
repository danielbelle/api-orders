<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 30; $i++){
            $this->db->table("customers")->insert($this->generateFakeCustomer());
        }
    }

    public function generateFakeCustomer()
    {
        $faker = Factory::create();

        return[
            "name" => $faker->name(),
            "document" => $faker->randomNumber(9, true)
        ];

    }

}
