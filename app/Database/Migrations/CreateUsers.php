<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'VARCHAR', 'constraint' => 50, 'primary' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'phone' => ['type' => 'VARCHAR', 'constraint' => 20],
            'plan_id' => ['type' => 'INT', 'constraint' => 11],
            'monthly_payment' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'last_updated' => ['type' => 'DATETIME']
        ]);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}