
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
            <?= form_open('invoice/savePembayaran', ['class' => 'invoicePembayaranForm']) ?>
            <?= csrf_field() ?>
            <input type="hidden" name="id_invoice" id="id_invoice" class="form-control" placeholder="Admission Fee" aria-label="noInvoice" aria-describedby="addon-wrapping" value="<?= htmlspecialchars(set_value('id_invoice')) ?>" autofocus>
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
            <button type="submitPembayaran" class="btn btn-primary">Send message</button>
         </div>
         <?= form_close() ?>
      </div>
   </div>
</div>
