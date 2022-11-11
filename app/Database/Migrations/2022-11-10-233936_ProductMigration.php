<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductMigration extends Migration
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
			"title" => [
				"type" => "VARCHAR",
				"constraint" => 50,
				"null" => false
			],
			"price" => [
				"type" => "INT",
				"constraint" => 5,
				"null" => false
			]
		]);

		$this->forge->addPrimaryKey("id");

		$this->forge->createTable("products");
	}

	public function down()
	{
		$this->forge->dropTable("products");
	}
}
