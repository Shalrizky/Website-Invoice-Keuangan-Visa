<?php
// TotalPembelianModel.php
namespace App\Models;

use CodeIgniter\Model;

class TotalPembelianModel extends Model
{
    protected $table = 'total_visa_pembelian';
    protected $primaryKey = 'id_total_pembelian';
    protected $returnType = 'object';
    protected $allowedFields = [
        'id_invoice',
        'total_pembelian_pax',
        'total_pembelian_visa_usd',
        'total_pembelian_visa_idr'
    ];


    public function getTotalPembelianData($id_invoice)
    {
        return $this->db->table($this->table)->where('id_invoice', $id_invoice)->get()->getRow();
    }



    // TotalPembelianModel.php
    public function insertOrUpdate($data)
    {
        // Check if 'id_invoice' key exists in the array
        if (isset($data['id_invoice'])) {
            $idInvoice = $data['id_invoice'];

            // Check if the record already exists based on id_invoice
            $existingRecord = $this->getTotalPembelianData($idInvoice);

            if ($existingRecord) {
                // If the record exists, perform an update

                // Get the existing total values from the database
                $totalPembelianPax = $existingRecord->total_pembelian_pax;
                $totalPembelianUSD = $existingRecord->total_pembelian_visa_usd;
                $totalPembelianIDR = $existingRecord->total_pembelian_visa_idr;

                // Calculate the new total values from the preview data
                $totalPembelianPax += $data['total_pembelian_pax'];
                $totalPembelianUSD += $data['total_pembelian_visa_usd'];
                $totalPembelianIDR += $data['total_pembelian_visa_idr'];

                // Update the existing record with the new total values
                $updatedData = [
                    'total_pembelian_pax' => $totalPembelianPax,
                    'total_pembelian_visa_usd' => $totalPembelianUSD,
                    'total_pembelian_visa_idr' => $totalPembelianIDR,
                ];

                $this->update($existingRecord->id_total_pembelian, $updatedData);
            } else {
                // If the record does not exist, perform an insert
                $this->insert($data);
            }
        }
    }
    
}
