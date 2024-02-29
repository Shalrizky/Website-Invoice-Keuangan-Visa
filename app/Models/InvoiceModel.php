<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
   protected $table = 'visa_invoice';
   protected $useTimestamps = true;
   protected $primaryKey = 'id_invoice';
   protected $returnType = 'object';
   protected $allowedFields = [
       'no_invoice',
       'jenis_invoice',
       'kasa',
       'id_customer',
       'nama_customer',
      
   ];

   public function getInvoiceData($id)
   {
      return $this->db->table($this->table)->where('id_invoice', $id)->get()->getRow();
   }

   public function getInvoiceList()
   {
      return $this->db->table($this->table)->get()->getResult();
   }
}
