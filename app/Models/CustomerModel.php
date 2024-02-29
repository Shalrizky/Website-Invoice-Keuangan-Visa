<?php 

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id_customer';
    protected $returnType = 'object';
    protected $allowedFields = [
        'nama_customer',
        'telepon_country',
        'no_telepon'
    ];

    public function getCustomerData($id)
    {
        return $this->db->table($this->table)->where('id_customer', $id)->get()->getRow();
    }
    
    public function getCustomerList()
    {
        return $this->db->table($this->table)->get()->getResult();
    }
    
}
