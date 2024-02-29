<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TotalVisaPembelian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_total_pembelian' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_invoice' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'total_pembelian_pax' => [
                'type' => 'INT',
                'constraint' => 10,
            ],
            'total_pembelian_visa_usd' => [
                'type' => 'DECIMAL',
                'constraint' => '18,2',
            ],
            'total_pembelian_visa_idr' => [
                'type' => 'DECIMAL',
                'constraint' => '18,2',
            ],

        ]);

        $this->forge->addKey('id_total_pembelian', true);
        $this->forge->addForeignKey('id_invoice', 'visa_invoice', 'id_invoice', 'CASCADE', 'CASCADE');
        $this->forge->createTable('total_visa_pembelian');
    }

    public function down()
    {
        $this->forge->dropTable('total_visa_pembelian');
    }
}
