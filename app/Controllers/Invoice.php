<?php

namespace App\Controllers;

use App\Models\InvoiceModel;
use App\Models\CustomerModel;
use App\Models\PembayaranModel;
use App\Models\PembelianModel;
use App\Models\TotalPembelianModel;


class Invoice extends BaseController
{
    protected $invoiceModel;
    protected $customerModel;
    protected $pembelianModel;
    protected $totalPembelianModel;
    protected $pembayaranModel;

    public function __construct()
    {
        $this->invoiceModel = new InvoiceModel();
        $this->customerModel = new CustomerModel();
        $this->pembelianModel = new PembelianModel();
        $this->totalPembelianModel = new TotalPembelianModel();
        $this->pembayaranModel = new PembayaranModel();
    }

    // KELOLA INVOICE
    public function kelola_invoice()
    {
        $allInvoice = $this->invoiceModel->getInvoiceList();
        $data = [
            'title' => 'Kelola - Invoice',
            'allInvoice' => $allInvoice
        ];
        return view('pages/v_kelola_invoice', $data);
    }

    // TAMBAH INVOICE
    public function invoice_tambah()
    {
        // $validation = session('validation') ?? \Config\Services::validation();
        $data = [
            'title' => 'tambah - invoice',
            // 'validation' => $validation,
            'created_at' => date('Y-m-d'),
        ];
        return view('pages/v_invoice_tambah', $data);
    }

    // SAVE INVOICE
    public function save()
    {
        if ($this->request->isAjax()) {
            $validation = \Config\Services::validation();

            // Aturan validasi
            $validationRules = [
                'no_invoice' => 'required',
                'kasa' => 'required',
                'jenis_invoice' => 'required',
                'created_at' => 'valid_date',
                'nama_customer' => 'required',
                'no_telepon' => 'required|numeric|exact_length[11,12]',
            ];

            $validationMessages = [
                'no_invoice' => [
                    'required' => 'No Invoice Tidak Boleh Kosong',
                ],
                'kasa' => [
                    'required' => 'Kasa Tidak Boleh Kosong',
                ],
                'jenis_invoice' => [
                    'required' => 'Silahkan Pilih Jenis Invoice Terlebih Dahulu',
                ],
                'created_at' => [
                    'valid_date' => 'Silahkan Pilih Tanggal Terlebih Dahulu',
                ],
                'nama_customer' => [
                    'required' => 'Nama Customer Tidak Boleh Kosong',
                ],
                'no_telepon' => [
                    'required' => 'Nomor Telepon Tidak Boleh Kosong',
                    'numeric' => "Nomor Telepon Harus Berisi Angka 11/12 Digit",
                    'exact_length' => "Nomor Telepon Harus Berisi Angka 11/12 Digit",
                ],
            ];

            if (!$this->validate($validationRules, $validationMessages)) {
                $msg = [
                    'error' => $validation->getErrors(),
                ];
                return $this->response->setStatusCode(200)->setJSON($msg);
            } else {
                try {

                    $simulatedError = false;
                    if ($simulatedError) {
                        throw new \Exception("Simulasi kegagalan menyimpan data ke database");
                    }


                    $previewData = $this->request->getVar('preview_data');

                    if (is_string($previewData) && !empty($previewData)) {
                        $previewData = json_decode($previewData, true);

                        if (is_array($previewData) && count($previewData) > 0) {
                            $customerData = [
                                'nama_customer' => $this->request->getVar('nama_customer'),
                                'telepon_country' => $this->request->getVar('telepon_country'),
                                'no_telepon' => $this->request->getVar('no_telepon'),
                            ];

                            $this->customerModel->insert($customerData);
                            $customerId = $this->customerModel->insertID();

                            $invoiceData = [
                                'id_customer' => $customerId,
                                'no_invoice' => $this->request->getVar('no_invoice'),
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                                'kasa' => $this->request->getVar('kasa'),
                                'jenis_invoice' => $this->request->getVar('jenis_invoice'),
                                'nama_customer' => $this->request->getVar('nama_customer'),
                            ];

                            $this->invoiceModel->insert($invoiceData);
                            $invoiceId = $this->invoiceModel->insertID();


                            foreach ($previewData as $row) {
                                $kursIDR = isset($row['kurs_idr']) ? $row['kurs_idr'] : '';
                                $jenisVisa = isset($row['jenis_visa']) ? $row['jenis_visa'] : '';
                                $jumlahPax = isset($row['jumlah_pax']) ? $row['jumlah_pax'] : '';
                                $hargaUnitUSD = isset($row['harga_unit_usd']) ? $row['harga_unit_usd'] : '';
                                $totalHargaUnitUSD = isset($row['total_harga_unit_usd']) ? $row['total_harga_unit_usd'] : '';
                                $totalHargaUnitIDR = isset($row['total_harga_unit_idr']) ? $row['total_harga_unit_idr'] : '';
                                $keterangan = isset($row['keterangan']) ? $row['keterangan'] : '';

                                $dataPembelian = [
                                    'kurs_idr' => $kursIDR,
                                    'jenis_visa' => $jenisVisa,
                                    'jumlah_pax' => $jumlahPax,
                                    'harga_unit_usd' => $hargaUnitUSD,
                                    'total_harga_unit_usd' => $totalHargaUnitUSD,
                                    'total_harga_unit_idr' => $totalHargaUnitIDR,
                                    'keterangan' => $keterangan,

                                    'id_invoice' => $invoiceId,
                                ];

                                $this->pembelianModel->insert($dataPembelian);
                            }

                            $totalPembelianIDR = 0;
                            $totalPembelianUSD = 0;
                            $totalPembelianPax = 0;
                            foreach ($previewData as $row) {
                                $totalPembelianIDR += isset($row['total_harga_unit_idr']) ? $row['total_harga_unit_idr'] : 0;
                                $totalPembelianUSD += isset($row['total_harga_unit_usd']) ? $row['total_harga_unit_usd'] : 0;
                                $totalPembelianPax += isset($row['jumlah_pax']) ? $row['jumlah_pax'] : 0;
                            }

                            $totalVisaPembelian = [
                                'id_total_pembelian' => $this->request->getVar('id_total_pembelian'),
                                'id_invoice' => $invoiceId,
                                'total_pembelian_pax' => $totalPembelianPax,
                                'total_pembelian_visa_usd' => $totalPembelianUSD,
                                'total_pembelian_visa_idr' => $totalPembelianIDR,
                            ];

                            $this->totalPembelianModel->insert($totalVisaPembelian);
                        }
                    }

                    $msg = [
                        'success' => "Invoice Berhasil Ditambah!",
                    ];

                    return $this->response->setStatusCode(200)->setJSON($msg);
                } catch (\Exception $e) {
                    $msg = [
                        'errorDatabase' => "Terjadi kesalahan Saat Menambahkan Data Invoice: " . $e->getMessage(),
                        'redirectUrl' => "/"
                    ];
                    return $this->response->setStatusCode(500)->setJSON($msg);
                }
            }
        }
    }

    public function invoice_detail($id)
    {

        // Validasi Parameter
        if (!is_numeric($id)) {
            throw new \InvalidArgumentException("ID Invoice harus berupa angka.");
        }

        // Ambil data invoice
        $invoiceData = $this->invoiceModel->getInvoiceData($id);
        if ($invoiceData === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Invoice dengan ID ' . $id . ' tidak ditemukan.');
        }

        // Ambil data customer
        $customerData = $this->customerModel->getCustomerData($invoiceData->id_customer);
        if ($customerData === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data customer dengan ID ' . $invoiceData->id_customer . ' tidak ditemukan.');
        }

        // Ambil data pembelian
        $pembelianData = $this->pembelianModel->getPembelianData($id);

        // Ambil data total pembelian
        $totalPembelianData = $this->totalPembelianModel->getTotalPembelianData($id);

        $pembayaranData = $this->pembayaranModel->getPembayaranList($id);


        $data = [
            'title' => 'Detail Invoice',
            'invoiceData' => $invoiceData,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
            'customerData' => $customerData,
            'pembelianData' => $pembelianData,
            'pembayaranData' => $pembayaranData,
            'totalPembelianData' => $totalPembelianData
        ];

        return view('pages/v_detail_invoice', $data);
    }

    // EDIT INVOICE
    public function invoice_edit($id)
    {
        // Validasi Parameter
        if (!is_numeric($id)) {
            throw new \InvalidArgumentException("ID Invoice harus berupa angka.");
        }

        // Ambil data invoice
        $invoiceData = $this->invoiceModel->find($id);
        if ($invoiceData === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Invoice dengan ID ' . $id . ' tidak ditemukan.');
        }
        // Ambil data customer
        $customerData = $this->customerModel->getCustomerData($invoiceData->id_customer);
        if ($customerData === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data customer dengan ID ' . $invoiceData->id_customer . ' tidak ditemukan.');
        }

        // Ambil data pembelian
        $pembelianData = $this->pembelianModel->getPembelianData($id);

        // Ambil data total pembelian
        $totalPembelianData = $this->totalPembelianModel->getTotalPembelianData($id);

        $data = [
            'title' => 'Edit Invoice',
            'invoiceData' => $invoiceData,
            'customerData' => $customerData,
            'updated_at' => date('Y-m-d'),
            'pembelianData' => $pembelianData,
            'totalPembelianData' => $totalPembelianData
        ];

        return view('pages/v_edit_invoice', $data);
    }

    // UPDATE INVOICE
    public function update($id)
    {
        if ($this->request->isAjax()) {
            $validation = \Config\Services::validation();

            // Aturan validasi
            $validationRules = [
                'nama_customer' => 'required',
                'telepon_country' => 'required',
                'no_telepon' => 'required|numeric|exact_length[11,12]',
                'updated_at' => 'valid_date',
                'no_invoice' => 'required',
                'kasa' => 'required',
                'jenis_invoice' => 'required',
            ];

            $validationMessages = [
                'nama_customer' => [
                    'required' => 'Nama Customer Tidak Boleh Kosong',
                ],
                'telepon_country' => [
                    'required' => 'Telepon Country Tidak Boleh Kosong',
                ],
                'no_telepon' => [
                    'required' => 'Nomor Telepon Tidak Boleh Kosong',
                    'numeric' => "Nomor Telepon Harus Berisi Angka 11/12 Digit",
                    'exact_length' => "Nomor Telepon Harus Berisi Angka 11/12 Digit",
                ],
                'updated_at' => [
                    'valid_date' => 'Silahkan Pilih Tanggal Terlebih Dahulu',
                ],
                'no_invoice' => [
                    'required' => 'No Invoice Tidak Boleh Kosong',
                ],
                'kasa' => [
                    'required' => 'Kasa Tidak Boleh Kosong',
                ],
                'jenis_invoice' => [
                    'required' => 'Silahkan Pilih Jenis Invoice Terlebih Dahulu',
                ],
            ];

            if (!$this->validate($validationRules, $validationMessages)) {
                $msg = [
                    'error' => $validation->getErrors(),
                ];
                return $this->response->setStatusCode(200)->setJSON($msg);
            } else {
                try {

                    $simulatedError = false;
                    if ($simulatedError) {
                        throw new \Exception("Simulasi kegagalan menyimpan data ke database");
                    }

                    // Check if the ID is numeric
                    if (!is_numeric($id)) {
                        throw new \InvalidArgumentException("ID Invoice harus berupa angka.");
                    }


                    $customerData = [
                        'nama_customer' => $this->request->getVar('nama_customer'),
                        'telepon_country' => $this->request->getVar('telepon_country'),
                        'no_telepon' => $this->request->getVar('no_telepon'),
                    ];

                    $this->customerModel->update($id, $customerData);


                    $invoiceData = [
                        'id_customer' => $this->request->getVar('id_customer'),
                        'nama_customer' => $this->request->getVar('nama_customer'),
                        'no_invoice' => $this->request->getVar('no_invoice'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'kasa' => $this->request->getVar('kasa'),
                        'jenis_invoice' => $this->request->getVar('jenis_invoice'),
                    ];

                    $this->invoiceModel->update($id, $invoiceData);

                    $existingPembelianIds = $this->pembelianModel->getIdsByInvoiceId($id);
                    $previewData = $this->request->getVar('preview_data');

                    if (!empty($previewData)) {
                        $previewData = json_decode($previewData, true);

                        if (is_array($previewData) && count($previewData) > 0) {
                            $totalPembelianIDR = 0;
                            $totalPembelianUSD = 0;
                            $totalPembelianPax = 0;

                            foreach ($previewData as $row) {
                                // Periksa apakah data sudah ada di database berdasarkan 'id_pembelian'
                                if (!isset($row['id_pembelian']) || !in_array($row['id_pembelian'], $existingPembelianIds)) {
                                    // Data belum ada di database, tambahkan ke tabel preview dan koleksi untuk penambahan ke database nanti
                                    $dataPembelian = [
                                        'kurs_idr' => $row['kurs_idr'],
                                        'jenis_visa' => $row['jenis_visa'],
                                        'jumlah_pax' => $row['jumlah_pax'],
                                        'harga_unit_usd' => $row['harga_unit_usd'],
                                        'total_harga_unit_usd' => $row['total_harga_unit_usd'],
                                        'total_harga_unit_idr' => $row['total_harga_unit_idr'],
                                        'keterangan' => $row['keterangan'],
                                        'id_invoice' => $id,
                                        'id_pembelian' => $row['id_pembelian'],
                                    ];

                                    // Insert new pembelian data ke tabel preview
                                    $this->pembelianModel->insert($dataPembelian);

                                    // Hitung total untuk data yang akan ditambahkan ke database
                                    $totalPembelianIDR += isset($row['total_harga_unit_idr']) ? $row['total_harga_unit_idr'] : 0;
                                    $totalPembelianUSD += isset($row['total_harga_unit_usd']) ? $row['total_harga_unit_usd'] : 0;
                                    $totalPembelianPax += isset($row['jumlah_pax']) ? $row['jumlah_pax'] : 0;
                                }
                            }

                            // Insert or update total visa pembelian data
                            $totalVisaPembelian = [
                                'id_invoice' => $id,
                                'total_pembelian_pax' => $totalPembelianPax,
                                'total_pembelian_visa_usd' => $totalPembelianUSD,
                                'total_pembelian_visa_idr' => $totalPembelianIDR,
                            ];

                            $this->totalPembelianModel->insertOrUpdate($totalVisaPembelian);
                        }
                    }

                    $msg = [
                        'success' => "Invoice Berhasil Diupdate!",
                        'updatedInvoiceId' => $id, // Set the updated invoice ID here
                    ];

                    return $this->response->setStatusCode(200)->setJSON($msg);
                } catch (\Exception $e) {
                    $msg = [
                        'errorDatabase' => "Terjadi kesalahan saat mengupdate data Invoice: " . $e->getMessage(),
                        'redirectUrl' => "/"
                    ];
                    return $this->response->setStatusCode(500)->setJSON($msg);
                }
            }
        }
    }


    public function delete_data_pembelian($id)
    {
        if ($this->request->isAjax()) {
            try {
                // Check if the ID is numeric
                if (!is_numeric($id)) {
                    throw new \InvalidArgumentException("ID Invoice harus berupa angka.");
                }

                // Get invoice data by ID
                $pembelianData = $this->pembelianModel->find($id);

                if (!$pembelianData) {
                    throw new \InvalidArgumentException("Invoice dengan ID " . $id . " tidak ditemukan.");
                }

                // Delete pembelian data associated with this invoice
                $this->pembelianModel->delete($id);


                $msg = [
                    'success' => "Invoice dengan ID $id berhasil dihapus!",
                ];

                return $this->response->setStatusCode(200)->setJSON($msg);
            } catch (\Exception $e) {
                $msg = [
                    'errorDatabase' => "Terjadi kesalahan saat menghapus data Invoice: " . $e->getMessage(),
                    'redirectUrl' => "/"
                ];
                return $this->response->setStatusCode(500)->setJSON($msg);
            }
        }
    }

    public function savePembayaran($id_invoice)
    {
        if (empty($id_invoice)) {
            return redirect()->back();
        }

        if ($this->request->isAJAX()) {

            $data = [
                'id_invoice' => $this->request->getVar('id_invoice'),
                'uang_masuk' => $this->request->getVar('uang_masuk'),
                'no_ref' =>  $this->request->getVar('no_ref'),
                'bukti_gambar_pembayaran' =>  $this->request->getVar('bukti_gambar_pembayaran'),
                'created_at' =>  $this->request->getVar('created_at'),
                'pemberi' => $this->request->getVar('pemberi'),
                'penerima' => $this->request->getVar('penerima'),
                'keterangan_pembelian' => $this->request->getVar('keterangan_pembelian'),
            ];

            $pembayaranModel = new PembayaranModel();
            $pembayaranModel->insert($data);


            $response = [
                'status' => 'success',
                'message' => 'Payment data saved successfully!',
            ];


            return $this->response->setJSON($response);
        }
    }
}
