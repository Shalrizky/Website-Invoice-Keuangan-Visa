    <!-- invoice_detail.php -->
    <?= $this->extend('layout/template') ?>
    <?= $this->section('content') ?>
    <style>
        .invoice-info th,
        .billed-to th {
            background-color: #f8f9fc;
            color: #5a5c69;
        }

        .invoice-info td,
        .billed-to td {
            color: #444;
        }

        .total-label {
            font-weight: bold;
        }

        .summary th {
            background-color: #f8f9fc;
        }

        .summary td {
            font-weight: bold;
            color: #444;
        }

        .invoice-table th,
        .invoice-table td {
            text-align: center;
        }

        .invoice-separator {
            border-top: 2px solid #ccc;
            margin-top: 10px;
            padding-top: 15px;
        }

        .invoice-separator h5 {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .invoice-table .td-penjualan .tr-penjualan:nth-child(odd) {
            background-color: #f8f8f8;
        }

        .invoice-table .td-penjualan .tr-penjualan:nth-child(even) {
            background-color: #eaf1f6;
        }
    </style>
    <div class="container-fluid">
        <div class="card border-left-primary shadow h-100 py-1 mb-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-primary mb-1 d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-0">Invoice Details</h1>
                                <p class="mb-0 text-gray-500 font-weight-bold"><?= $customerData->nama_customer ?></p>
                            </div>
                            <div>
                                <a href="#" id="kembaliButton" class="text-white btn btn-primary"><i class="fas fa-solid fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4  border-bottom-primary">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Invoice</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Invoice Info</h5>
                        <table class="table invoice-table invoice-info">
                            <tbody>
                                <tr>
                                    <th>Invoice Number:</th>
                                    <td><?= $invoiceData->no_invoice ?></td>
                                </tr>
                                <tr>
                                    <th>Kasa:</th>
                                    <td><?= $invoiceData->kasa ?></td>
                                </tr>
                                <tr>
                                    <th>Type Invoice:</th>
                                    <td><?= $invoiceData->jenis_invoice ?></td>
                                </tr>
                                <tr>
                                    <th>Issue Date:</th>
                                    <td><?= $invoiceData->created_at ?></td>
                                </tr>
                                <tr>
                                    <th>Updated Date:</th>
                                    <td><?= $invoiceData->updated_at ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Billed To</h5>
                        <table class="table invoice-table billed-to">
                            <tbody>
                                <tr>
                                    <th>Customer Name:</th>
                                    <td><?= $customerData->nama_customer ?></td>
                                </tr>
                                <tr>
                                    <th>Phone Number:</th>
                                    <td><?= $customerData->telepon_country . $customerData->no_telepon ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="font-weight-bold mt-2 mb-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0">Item Details</h5>
                        </div>
                        <div class="col-auto ml-auto mr-3">
                            <a href="<?= base_url('/invoice_edit/' . $invoiceData->id_invoice); ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Customize</a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table invoice-table">
                        <thead>
                            <tr>
                                <th>Kurs IDR</th>
                                <th>Visa Types</th>
                                <th>Pax Quantity</th>
                                <th>Unit Price USD</th>
                                <th>Amount USD</th>
                                <th>Amount IDR</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody class="td-penjualan">
                            <?php foreach ($pembelianData as $index => $pembelian) : ?>
                                <tr class="tr-penjualan">
                                    <td>Rp<?= number_format($pembelian->kurs_idr, 2, ',', '.') ?></td>
                                    <td><?= $pembelian->jenis_visa ?></td>
                                    <td><?= $pembelian->jumlah_pax ?></td>
                                    <td>$<?= number_format($pembelian->harga_unit_usd, 2, ',', '.') ?></td>
                                    <td>$<?= number_format($pembelian->total_harga_unit_usd, 2, ',', '.') ?></td>
                                    <td>Rp<?= number_format($pembelian->total_harga_unit_idr, 2, ',', '.') ?></td>
                                    <td><?= $pembelian->keterangan ? $pembelian->keterangan : "-" ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="invoice-separator">
                    <table class="table summary">
                        <tbody>
                            <tr>
                                <th>Total Pax Quantity:</th>
                                <td><?= $totalPembelianData->total_pembelian_pax ?></td>
                            </tr>
                            <tr>
                                <th>Total Amount USD:</th>
                                <td><?= number_format($totalPembelianData->total_pembelian_visa_usd, 2, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <th>Total Amount IDR:</th>
                                <td><?= number_format($totalPembelianData->total_pembelian_visa_idr, 2, ',', '.') ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalPembayaranVisa" tabindex="-1" aria-labelledby="modalPembayaranVisa" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-primary text-uppercase" id="modalPembayaranVisa">Add Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/invoice/savePembayaran <?= $invoiceData->id_invoice ?>" class="invoicePembayaranForm" method="post">
                            <?= csrf_field(); ?>
                                
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="uang_masuk" class="col-form-label font-weight-bold">Admission Fee</label>
                                        <input type="text" name="uang_masuk" id="uang_masuk" class="form-control" placeholder="Admission Fee" aria-label="noInvoice" aria-describedby="addon-wrapping" value="<?= htmlspecialchars(set_value('uang_masuk')) ?>" autofocus>
                                        <div class="invalid-feedback errorUangMasuk"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_ref" class="col-form-label font-weight-bold">Reference Number</label>
                                        <input type="text" name="no_ref" id="no_ref" class="form-control" placeholder="Reference Number" aria-label="no_ref" aria-describedby="addon-wrapping" value="<?= htmlspecialchars(set_value('no_ref')) ?>">
                                        <div class="invalid-feedback errorNoRef"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bukti_gambar_pembayaran" class="col-form-label font-weight-bold">Payment Image</label>
                                        <div class="custom-file">
                                            <input type="file" name="bukti_gambar_pembayaran" id="bukti_gambar_pembayaran" class="custom-file-input" value="<?= htmlspecialchars(set_value('bukti_gambar_pembayaran')) ?>">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        <div class="invalid-feedback errorBuktiGambarPembayaran"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="created_at" class="col-form-label font-weight-bold">Issue Date</label>
                                        <input type="date" name="created_at" class="form-control" id="created_at" aria-label="created_at" aria-describedby="addon-wrapping" value="<?= htmlspecialchars(set_value('created_at', $created_at)) ?>" readonly>
                                        <div class="invalid-feedback errorCreatedAt"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pemberi" class="col-form-label font-weight-bold">Paid By</label>
                                        <input type="text" name="pemberi" id="pemberi" class="form-control" placeholder="Paid By" aria-label="noInvoice" aria-describedby="addon-wrapping" value="<?= htmlspecialchars(set_value('pemberi')) ?>">
                                        <div class="invalid-feedback errorPemberi"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="penerima" class="col-form-label font-weight-bold">Received By</label>
                                        <input type="text" name="penerima" id="penerima" class="form-control" placeholder="Received By" aria-label="noInvoice" aria-describedby="addon-wrapping" value="<?= htmlspecialchars(set_value('penerima')) ?>">
                                        <div class="invalid-feedback errorPenerima"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="keterangan_pembelian" class="col-form-label font-weight-bold">Add Description</label>
                                        <textarea class="form-control" aria-label="With textarea" id="keterangan_pembelian" placeholder="Add Description" name="keterangan_pembelian"></textarea>
                                        <div class="invalid-feedback errorKeteranganPembelian"></div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submitButtonPembayaran">Send message</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4 border-bottom-primary">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Payment</h6>
                <button type="button" class="btn btn-info button" id="addPaymentButton" data-toggle="modal" data-target="#modalPembayaranVisa" data-whatever="@mdo">
                    <i class="fas fa-solid fa-plus"></i> Add Payment
                </button>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table payment-table">
                        <thead>
                            <tr>
                                <th>Admission Fee</th>
                                <th>No.Ref</th>
                                <th>Payment Image</th>
                                <th>Issue Date</th>
                                <th>Paid By</th>
                                <th>Received By</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pembayaranData as $pembayaranData) : ?>
                                <tr>
                                    <td><?= $pembayaranData->uang_masuk ?></td>
                                    <td><?= $pembayaranData->no_ref ?></td>
                                    <td><?= $pembayaranData->bukti_gambar_pembayaran ?></td>
                                    <td><?= $pembayaranData->created_at ?></td>
                                    <td><?= $pembayaranData->pemberi ?></td>
                                    <td><?= $pembayaranData->penerima ?></td>
                                    <td><?= $pembayaranData->keterangan_pembelian ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>



    </div>
    <?= $this->endSection() ?>