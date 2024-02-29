<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VisaInvoice extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_invoice' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'no_invoice' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'jenis_invoice' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'kasa' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'id_customer' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nama_customer' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],


        ]);

        $this->forge->addKey('id_invoice', true);
        $this->forge->addForeignKey('id_customer', 'customer', 'id_customer', 'CASCADE', 'CASCADE');
        $this->forge->createTable('visa_invoice');
    }

    public function down()
    {
        $this->forge->dropTable('visa_invoice');
    }
}
