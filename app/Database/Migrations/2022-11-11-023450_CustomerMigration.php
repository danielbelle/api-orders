<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CustomerMigration extends Migration
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
			"name" => [
				"type" => "VARCHAR",
				"constraint" => 50,
				"null" => false
			],
			"document" => [
				"type" => "BIGINT",
				"constraint" => 14,
				"null" => false
			]
		]);

		$this->forge->addPrimaryKey("id");

		$this->forge->createTable("customers");
	}

    public function down()
    {
		$this->forge->dropTable("customers");
    }
}
