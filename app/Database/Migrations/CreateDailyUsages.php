<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDailyUsages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'primary' => true],
            'data_usage_id' => ['type' => 'INT', 'constraint' => 11],
            'date' => ['type' => 'DATE'],
            'download' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'upload' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00]
        ]);
        $this->forge->addForeignKey('data_usage_id', 'data_usages', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('daily_usages');
    }

    public function down()
    {
        $this->forge->dropTable('daily_usages');
    }
}