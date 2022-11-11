<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
			"id" => [
				"type" => "INT",
				"constraint" => 5,
				"unsigned" => true,
				"auto_increment" => true
			],
			"name" => [
				"type" => "VARCHAR",
				"constraint" => 50,
				"null" => false
			],
			"email" => [
				"type" => "VARCHAR",
				"constraint" => 50,
				"null" => false,
				"unique" => true
			],
			"password" => [
				"type" => "VARCHAR",
				"constraint" => 220
			]
		]);

		$this->forge->addPrimaryKey("id");

		$this->forge->createTable("users");
    }

    public function down()
    {
		$this->forge->dropTable("users");
    }
}
