<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PembelianVisa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pembelian' => [
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
            'kurs_idr' => [
                'type' => 'DECIMAL',
                'constraint' => '18,2',
            ],
            'jenis_visa' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'jumlah_pax' => [
                'type' => 'INT',
                'constraint' => 10,
            ],
            'harga_unit_usd' => [
                'type' => 'DECIMAL',
                'constraint' => '18,2',
            ],
            'total_harga_unit_usd' => [
                'type' => 'DECIMAL',
                'constraint' => '18,2',
            ],
            'total_harga_unit_idr' => [
                'type' => 'DECIMAL',
                'constraint' => '18,2',
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
          
        ]);

        $this->forge->addKey('id_pembelian', true);
        $this->forge->addForeignKey('id_invoice', 'visa_invoice', 'id_invoice');
        $this->forge->createTable('visa_pembelian');
    }

    public function down()
    {
        $this->forge->dropTable('visa_pembelian');
    }
}