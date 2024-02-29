<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'visa_pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $allowedFields = [
        'uang_masuk',
        'no_ref',
        'bukti_gambar_pembayaran',
        'pemberi',
        'penerima',
        'keterangan_pembelian',
    ];

    public function getPembayaranList()
    {
       return $this->db->table($this->table)->get()->getResult();
    }

}
