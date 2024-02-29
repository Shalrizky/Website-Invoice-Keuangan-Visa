<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PembayaranVisa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pembayaran' => [
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
            'uang_masuk' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'no_ref' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'bukti_gambar_pembayaran' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true
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
            'pemberi' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'penerima' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'keterangan_pembelian' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],


        ]);

        $this->forge->addKey('id_pembayaran', true);
        $this->forge->addForeignKey('id_invoice', 'visa_invoice', 'id_invoice', 'CASCADE', 'CASCADE');
        $this->forge->createTable('visa_pembayaran');
    }

    public function down()
    {
        $this->forge->dropTable('visa_pembayaran');
    }
}
