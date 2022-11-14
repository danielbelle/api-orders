<?php

namespace App\Database\Seeds;
use Faker\Factory;

use CodeIgniter\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 10; $i++){
            $this->db->table("orders")->insert($this->generateFakeOrder());
        }
    }    
    
    public function generateFakeOrder()
    {
        $faker = Factory::create();

        return[
            "customer_id" => $faker->numberBetween(1, 29),
            "product_id" => $faker->numberBetween(1, 29),
            "status" => $faker->numberBetween(1,3),
        ];

    }
}
