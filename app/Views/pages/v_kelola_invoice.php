<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- Begin Page Content -->
<div class="container-fluid">
   <div class="card shadow border-left-primary h-100 py-1 mb-4">
      <div class="card-body">
         <div class="row no-gutters align-items-center">
            <div class="col mr-2">
               <div class=" text-primary mb-1">
                  <div class="d-flex align-items-center ">
                     <!-- <i class="fas fa-clipboard-list fa-2x text-gray-300 mr-3"></i> -->
                     <h1 class="h3 mb-0 " style="display: inline-block; margin-bottom: 0;">Manage Invoices</h1>
                  </div>
               </div>
            </div>
            <div class="col-auto">
               <a href="<?= base_url('/invoice_tambah'); ?>" id="invoiceTambahLink" class="btn btn-info"><i class="fas fa-solid fa-plus"></i> Add Invoices</a>
               <a href="#" id="kembaliButton" class="mr-3 text-white btn btn-primary"><i class="fas fa-solid  fa-arrow-left "></i></a>
            </div>
         </div>
      </div>
   </div>

   <!-- DataTales Example -->
   <div class="card shadow  mb-4 ">
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered table-hover centered-table" id="dataTable" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Invoice Number</th>
                     <th>Customer Name</th>
                     <th>Type Invoice</th>
                     <th>Issue Date</th>
                     <th>Updated Date</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $count = 1 ?>
                  <?php foreach ($allInvoice as $invoice) : ?>

                     <tr>
                        <td><?= $count++ ?></td>
                        <td><?= esc($invoice->no_invoice) ?></td>
                        <td><?= esc($invoice->nama_customer) ?></td>
                        <td><?= esc($invoice->jenis_invoice) ?></td>
                        <td><?= esc($invoice->created_at) ?></td>
                        <td><?= esc($invoice->updated_at) ?></td>
                        <td>
                           <div class="d-flex justify-content-between">
                              <a href="<?= base_url('/invoice_detail/' . $invoice->id_invoice) ?>" class="btn btn-success btn-sm">
                                 <i class="fas fa-info-circle"></i>
                              </a>
                              <a href="<?= base_url('/invoice_edit/' . $invoice->id_invoice); ?>" class="btn btn-warning btn-sm mx-2">
                                 <i class="fas fa-edit"></i>
                              </a>
                              <a href="#" class="btn btn-danger btn-sm">
                                 <i class="fas fa-trash"></i>
                              </a>
                           </div>

                        </td>
                     </tr>
                  <?php endforeach; ?>

               </tbody>
            </table>
         </div>
      </div>
   </div>

</div>
<!-- /.container-fluid -->



<?= $this->endsection() ?>