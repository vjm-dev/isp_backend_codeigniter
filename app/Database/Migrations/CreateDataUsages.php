<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDataUsages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'primary' => true],
            'user_id' => ['type' => 'VARCHAR', 'constraint' => 50],
            'start_date' => ['type' => 'DATETIME'],
            'end_date' => ['type' => 'DATETIME'],
            'used' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'limit' => ['type' => 'DECIMAL', 'constraint' => '10,2']
        ]);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('data_usages');
    }

    public function down()
    {
        $this->forge->dropTable('data_usages');
    }
}