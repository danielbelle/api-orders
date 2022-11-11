<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderMigration extends Migration
{
    public function up()
	{

		$this->forge->addField([
			"id" => [
				"type" => "INT",
				"unsigned" => true,
				"null" => false,
				"auto_increment" => true
			],
			"customer_id" => [
				"type" => "INT",
				"unsigned" => true,
			],
			"product_id" => [
				"type" => "INT",
				"unsigned" => true,
			],
			"status" => [
				"type" => "VARCHAR",
				"constraint" => 50,
				"null" => false
			]
		]);


		$this->forge->addPrimaryKey("id");

        $this->forge->addForeignKey('product_id','products','id', 'CASCADE');

		$this->forge->addForeignKey('customer_id', 'customers', 'id', 'CASCADE');

		$this->forge->createTable("orders");
		
	}

    public function down()
    {
		$this->forge->dropTable("orders");
    }
}
