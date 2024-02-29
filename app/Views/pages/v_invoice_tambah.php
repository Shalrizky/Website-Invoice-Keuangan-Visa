<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid ">
   <div class="card border-left-primary shadow h-100 py-1 mb-4">
      <div class="card-body">
         <div class="row no-gutters align-items-center">
            <div class="col mr-2">
               <div class=" text-primary mb-1">
                  <div class="d-flex align-items-center ">
                     <!-- <i class="fas fa-solid fa-file-invoice-dollar fa-2x text-gray-300 mr-3"></i> -->
                     <h5 class="h3 mb-0  " style="display: inline-block; margin-bottom: 0;">Add Invoices</h5>
                  </div>
               </div>
            </div>
            <div class="col-auto">
               <a href="#" id="kembaliButton" class="mr-3 text-white btn btn-primary"><i class="fas fa-solid  fa-arrow-left "></i></a>
            </div>
         </div>
      </div>
   </div>
   <?= form_open('invoice/save', ['class' => 'invoiceForm']) ?>
   <?= csrf_field() ?>
   <input type="hidden" name="preview_data" id="preview_data_input">
   <div class="row">
      <div class="col-xl-3 col-md-4 mb-4">
         <div class="card shadow h-100 py-2">
            <div class="card-body">
               <div class="row no-gutters align-items-center">
                  <div class="mr-2">
                     <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <label for="noInvoice"> NO INVOICE</label>
                     </div>
                     <input type="text" name="no_invoice" id="no_invoice" class="form-control" placeholder="No Invoice" aria-label="noInvoice" aria-describedby="addon-wrapping" value="<?= htmlspecialchars(set_value('no_invoice')) ?>" autofocus>
                     <div class="invalid-feedback errorNoInvoice">

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xl-3 col-md-4 mb-4">
         <div class="card shadow h-100 py-2">
            <div class="card-body">
               <div class="row no-gutters align-items-center">
                  <div class="mr-2">
                     <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <label for="noInvoice"> Tanggal</label>
                     </div>
                     <input type="date" name="created_at" class="form-control" id="created_at" aria-label="created_at" aria-describedby="addon-wrapping" value="<?= htmlspecialchars(set_value('created_at', $created_at)) ?>" readonly>
                  </div>
                  <div class="invalid-feedback errorCreatedAt">

                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xl-3 col-md-4 mb-4">
         <div class="card shadow h-100 py-2">
            <div class="card-body">
               <div class="row no-gutters align-items-center">
                  <div class="mr-2">
                     <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <label for="kasa"> KASA</label>
                     </div>
                     <input type="text" name="kasa" id="kasa" class="form-control" placeholder="Kasa" aria-label="kasa" aria-describedby="addon-wrapping" value="<?= htmlspecialchars(set_value('kasa')) ?>">
                     <div class="invalid-feedback errorKasa">

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xl-3 col-md-4 mb-4">
         <div class="card shadow h-100 py-2">
            <div class="card-body">
               <div class="row no-gutters align-items-center">
                  <div class="mr-2">
                     <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <label for="jenisInvoice">Invoice type</label>
                     </div>
                     <select class="custom-select" name="jenis_invoice" id="jenis_invoice">
                        <option disabled selected hidden>Select Invoice Type</option>
                        <option value="Invoice Visa" <?= set_value('jenis_invoice') == 'Invoice Visa' ? 'selected' : '' ?>>Invoice Visa</option>
                        <option value="Invoice KAS" <?= set_value('jenis_invoice') == 'Invoice KAS' ? 'selected' : '' ?>>Invoice KAS</option>
                        <option value="Invoice Gaji Karyawan" <?= set_value('jenis_invoice') == 'Invoice Gaji Karyawan' ? 'selected' : '' ?>>Invoice Gaji Karyawan</option>
                     </select>
                     <div class="invalid-feedback errorJenisInvoice">

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">ENTER CUSTOMER DATA</h6>
      </div>
      <div class="card-body">
         <h4 class="small font-weight-bold"><label for="nama_customer">Customer Name</label></h4>
         <div class="input-group mb-3">
            <input type="text" name="nama_customer" id="nama_customer" class="form-control" placeholder="Customer Name" aria-label="nama_customer" aria-describedby="addon-wrapping" value="<?= htmlspecialchars(set_value('nama_customer')) ?>">
            <div class="invalid-feedback errorNamaCustomer">

            </div>
         </div>
         <h4 class="small font-weight-bold">Phone Number</h4>
         <div class="input-group mb-3">
            <div class="input-group-prepend">
               <select class="custom-select btn btn-outline-secondary" name="telepon_country">
                  <option value="+62">+62</option>
                  <option value="+60">+60</option>
                  <option value="+65">+65</option>
                  <option value="+966">+966</option>
               </select>
            </div>
            <input type="text" name="no_telepon" id="no_telepon" class="form-control" placeholder="Phone Number" aria-label="no_telepon" aria-describedby="addon-wrapping" value="<?= htmlspecialchars(set_value('no_telepon')) ?>">
            <div class="invalid-feedback errorNoTelepon">

            </div>
         </div>
      </div>
   </div>

   <!-- pembelian visa -->
   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">ENTER VISA PURCHASE</h6>
      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-md-6">
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text" id="basic-addon1">Kurs IDR</span>
                  </div>
                  <input type="text" name="kurs_IDR" id="kursIDRInput" class="form-control" placeholder="Kurs Idr" aria-label="kurs_IDR" aria-describedby="addon-wrapping" value="<?= htmlspecialchars(set_value('kurs_IDR')) ?>">
                  <div class="invalid-feedback errorKursIdr">

                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text" id="basic-addon1">Visa Types</span>
                  </div>
                  <input type="text" name="jenis_visa" id="jenisVisaInput" class="form-control" placeholder="Visa Types" aria-label="jenis_visa" aria-describedby="addon-wrapping" value="<?= htmlspecialchars(set_value('jenis_visa')) ?>">
                  <div class="invalid-feedback errorJenisVisa">

                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text" id="basic-addon1">Pax Quantity</span>
                  </div>
                  <input type="text" name="jumlah_pax" id="paxInput" class="form-control" placeholder="Pax Quantity" aria-label="jumlah_pax" aria-describedby="addon-wrapping" value="<?= htmlspecialchars(set_value('jumlah_pax')) ?>">
                  <div class="invalid-feedback errorJumlahPax">

                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text" id="basic-addon1">$</span>
                  </div>
                  <input type="text" name="harga_USD" id="unitPriceUSDInput" class="form-control" placeholder="USD Unit Price" aria-label="harga_USD" aria-describedby="addon-wrapping" value="<?= htmlspecialchars(set_value('harga_USD')) ?>">
                  <div class="invalid-feedback errorHargaUsd">

                  </div>
               </div>
            </div>
            <div class="col-md-12">
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text">Description</span>
                  </div>
                  <textarea class="form-control" aria-label="With textarea" id="keterangan" placeholder="Add Description" name="keterangan"></textarea>
               </div>
            </div>
            <div class="col-md-12 justify-content-end">
               <button id="previewButton" class="btn btn-info" type="button"><i class="fas fa-solid fa-plus"></i> Add Purchase</button>
            </div>
         </div>
         <div class="table-responsive mt-4">
            <table id="previewTable" class="table table-striped text-center" name="preview_data">
               <thead>
                  <tr>
                     <th>Kurs IDR</th>
                     <th>Visa Types</th>
                     <th>Pax Quantity</th>
                     <th>Unit Price USD</th>
                     <th>Amount USD</th>
                     <th>Amount IDR</th>
                     <th>Description</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody></tbody>
               <tfoot></tfoot>
            </table>
         </div>
      </div>
   </div>

   <div class="row mx-2">
      <div class="col-md-6">
         <button type="submit" class="btn btn-success" id="submitButton"><i class="fas fa-paper-plane"></i> Save</button>
         <button type="reset" class="btn btn-secondary"><i class="fas fa-sync" style="color: #ffffff;"></i> Refresh</button>
      </div>

   </div>

   <?= form_close() ?>


</div>




<?= $this->endsection() ?>