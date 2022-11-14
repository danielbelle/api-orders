<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ProductSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 30; $i++){
            $this->db->table("products")->insert($this->generateFakeProduct());
        }
    }

    public function generateFakeProduct()
    {
        $faker = Factory::create();

        return[
            "title" => $faker->numerify('Produto ##'),
            "price" => $faker->randomNumber(2, false)
        ];

    }
}
