<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePlans extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'primary' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'speed' => ['type' => 'VARCHAR', 'constraint' => 50],
            'data_limit' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'monthly_payment' => ['type' => 'DECIMAL', 'constraint' => '10,2']
        ]);
        $this->forge->createTable('plans');
    }

    public function down()
    {
        $this->forge->dropTable('plans');
    }
}