<?php
// PembelianModel.php
namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model
{
    protected $table = 'visa_pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $returnType = 'object';
    protected $allowedFields = [
        'id_invoice',
        'kurs_idr',
        'jenis_visa',
        'jumlah_pax',
        'harga_unit_usd',
        'total_harga_unit_usd',
        'total_harga_unit_idr',
        'keterangan',
        'total_pembelian_pax',
        'total_pembelian_visa_idr',
        'total_pembelian_visa_usd',
    ];


    public function getPembelianData($id_invoice)
    {
        return $this->db->table($this->table)->where('id_invoice', $id_invoice)->get()->getResult();
    }

    public function getIdsByInvoiceId($invoiceId)
    {
        $query = $this->db->table($this->table)
            ->select('id_pembelian')
            ->where('id_invoice', $invoiceId)
            ->get();

        $result = $query->getResultArray();
        $ids = array_column($result, 'id_pembelian');
        return $ids;
    }

    public function deleteByInvoiceId($idPembelian)
    {
        $this->where('id_pembelian', $idPembelian)->delete();
    }
}
