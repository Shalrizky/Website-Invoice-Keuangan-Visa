<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customer extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_customer' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_customer' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'telepon_country' => [
                'type' => 'CHAR',
                'constraint' => 4,
            ],
            'no_telepon' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],
        ]);

        $this->forge->addKey('id_customer', true);
        $this->forge->createTable('customer');
    }

    public function down()
    {
        $this->forge->dropTable('customer');
    }
}