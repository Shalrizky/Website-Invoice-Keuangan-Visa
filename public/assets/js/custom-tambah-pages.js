$(document).ready(function () {
  "use strict";
  // let isValidationPassed = false;

  // INVOICE TAMBAH VISA FORM AJAX
  $(".invoiceForm").submit(function (e) {
    e.preventDefault(); 

    // Perform validation using Ajax
    $.ajax({
      type: "post",
      url: $(this).attr("action"), 
      data: $(this).serialize(),
      dataType: "json", 
      beforeSend: function () {
        $("#submitButton").prop("disabled", true);
        $("#submitButton").html('<i class="fas fa-spinner fa-spin"></i> Saving...');
      },
      complete: function () {
        $("#submitButton").prop("disabled", false);
        $("#submitButton").html('<i class="fas fa-paper-plane"></i> Save');
      },
      success: function (response) {
        if (response.error) {
          // Handle validation errors
          let data = response.error;

          // Clear previous validation error messages
          $(".error-message").empty();

          if (data.no_invoice) {
            $("#no_invoice").addClass("is-invalid");
            $(".errorNoInvoice").html(data.no_invoice);
          } else {
            $("#no_invoice").removeClass("is-invalid");
            $("#no_invoice").addClass("is-valid");
          }

          if (data.kasa) {
            $("#kasa").addClass("is-invalid");
            $(".errorKasa").html(data.kasa);
          } else {
            $("#kasa").removeClass("is-invalid");
            $("#kasa").addClass("is-valid");
          }

          if (data.jenis_invoice) {
            $("#jenis_invoice").addClass("is-invalid");
            $(".errorJenisInvoice").html(data.jenis_invoice);
          } else {
            $("#jenis_invoice").removeClass("is-invalid");
            $("#jenis_invoice").addClass("is-valid");
          }

          if (data.created_at) {
            $("#created_at").addClass("is-invalid");
            $(".errorCreatedAt").html(data.created_at);
          } else {
            $("#created_at").removeClass("is-invalid");
            $("#created_at").addClass("is-valid");
          }

          if (data.nama_customer) {
            $("#nama_customer").addClass("is-invalid");
            $(".errorNamaCustomer").html(data.nama_customer);
          } else {
            $("#nama_customer").removeClass("is-invalid");
            $("#nama_customer").addClass("is-valid");
          }

          if (data.no_telepon) {
            $("#no_telepon").addClass("is-invalid");
            $(".errorNoTelepon").html(data.no_telepon);
          } else {
            $("#no_telepon").removeClass("is-invalid");
            $("#no_telepon").addClass("is-valid");
          }

          const firstError = document.querySelector(".invalid-feedback");

          // Jika ada elemen error, arahkan jendela ke atas halaman
          if (firstError) {
            window.scrollTo({
              top: 0,
              behavior: "smooth",
            });
          }

          // Check semua validasi sudah dilakukan
          // isValidationPassed = !(
          //   data.no_invoice ||
          //   data.kasa ||
          //   data.jenis_invoice ||
          //   data.created_at ||
          //   data.nama_customer ||
          //   data.no_telepon
          // );
          
        } else if (response.success) {
          // if (isValidationPassed) {
            if ($("#previewTable tbody tr").length > 0) {
              sessionStorage.setItem("successMessage", response.success);
              window.location.replace("/kelola_invoice");
            }else {
              Swal.fire({
                icon: "info",
                title: "Informasi",
                text: "Mohon Tambahkan Pembelian Terlebih dahulu.",
              });
            }
          // } 
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        // console.log(xhr.responseText);
        if (xhr.responseJSON && xhr.responseJSON.errorDatabase) {
       
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: xhr.responseJSON.errorDatabase,
            footer: "Kode Kesalahan: " + thrownError,
            showConfirmButton: true,
          }).then(() => {
            window.location.href = xhr.responseJSON.redirectUrl;
          });
        } else {
         
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Terjadi Kesalahan Dalam Permintaan AJAX. Silakan coba lagi nanti atau hubungi dukungan.",
            footer: "Kode Kesalahan:" + thrownError,
            showConfirmButton: true,
          });
        }
      },
    });
  });


  // PREVIEW TABLE TAMBAH VISA 
  $("#kursIDRInput").on("input", function () {
    var kursIDR = $(this).val();
    var errorClass = ".errorKursIdr";
    var errorMessage = "";

    if (!kursIDR) {
      errorMessage = "Kurs Tidak Boleh Kosong";
      $(this).removeClass("is-valid").addClass("is-invalid");
    } else if (isNaN(kursIDR) || kursIDR <= 0) {
      errorMessage = "Harap Masukan Angka Lebih Besar Dari 0";
      $(this).removeClass("is-valid").addClass("is-invalid");
    } else {
      $(this).removeClass("is-invalid").addClass("is-valid");
    }

    $(errorClass).text(errorMessage);
  });

  $("#jenisVisaInput").on("input", function () {
    var jenisVisa = $(this).val();
    var errorClass = ".errorJenisVisa";
    var errorMessage = "";

    if (!jenisVisa) {
      errorMessage = "Jenis Visa Tidak Boleh Kosong";
      $(this).removeClass("is-valid").addClass("is-invalid");
    } else if (/\d/.test(jenisVisa)) {
      errorMessage = "Harap Masukan Huruf";
      $(this).removeClass("is-valid").addClass("is-invalid");
    } else {
      $(this).removeClass("is-invalid").addClass("is-valid");
    }

    $(errorClass).text(errorMessage);
  });

  $("#paxInput").on("input", function () {
    var pax = $(this).val();
    var errorClass = ".errorJumlahPax";
    var errorMessage = "";

    if (!pax) {
      errorMessage = "Jumlah Pax Tidak Boleh Kosong";
      $(this).removeClass("is-valid").addClass("is-invalid");
    } else if (isNaN(pax) || pax <= 0) {
      errorMessage = "Harap Masukan Angka Lebih Besar Dari 0";
      $(this).removeClass("is-valid").addClass("is-invalid");
    } else {
      $(this).removeClass("is-invalid").addClass("is-valid");
    }

    $(errorClass).text(errorMessage);
  });

  $("#unitPriceUSDInput").on("input", function () {
    var unitPriceUSD = $(this).val();
    var errorClass = ".errorHargaUsd";
    var errorMessage = "";

    if (!unitPriceUSD) {
      errorMessage = "Harga Tidak Boleh Kosong";
      $(this).removeClass("is-valid").addClass("is-invalid");
    } else if (isNaN(unitPriceUSD) || unitPriceUSD <= 0) {
      errorMessage = "Harap Masukan Angka Lebih Besar Dari 0";
      $(this).removeClass("is-valid").addClass("is-invalid");
    } else {
      $(this).removeClass("is-invalid").addClass("is-valid");
    }

    $(errorClass).text(errorMessage);
  });

  // PREVIEW TABLE TAMBAH VISA INVOICE BUTTON ACTION
  $("#previewButton").click(function () {
    var kursIDR = $("#kursIDRInput").val();
    var jenisVisa = $("#jenisVisaInput").val();
    var pax = $("#paxInput").val();
    var unitPriceUSD = $("#unitPriceUSDInput").val();
    var keterangan = $("#keterangan").val();

    if (!kursIDR) {
      $(".errorKursIdr").text("Kurs Tidak Boleh Kosong");
      $("#kursIDRInput").addClass("is-invalid");
      return;
    } else if (isNaN(kursIDR) || kursIDR <= 0) {
      $(".errorKursIdr").text(
        "Harap Masukan Angka Lebih Besar Dari 0"
      );
      $("#kursIDRInput").addClass("is-invalid");
      return;
    } else {
      $(".errorKursIdr").text("");
      $("#kursIDRInput").removeClass("is-invalid");
      $("#kursIDRInput").addClass("is-valid");
    }

    if (!jenisVisa) {
      $(".errorJenisVisa").text("Jenis Visa Tidak Boleh Kosong.");
      $("#jenisVisaInput").addClass("is-invalid");
      return;
    } else if (/\d/.test(jenisVisa)) {
      $(".errorJenisVisa").text("Harap Masukan Huruf");
      $("#jenisVisaInput").addClass("is-invalid");
      return;
    } else {
      $(".errorJenisVisa").text("");
      $("#jenisVisaInput").removeClass("is-invalid");
      $("#jenisVisaInput").addClass("is-valid");
    }

    if (!pax) {
      $(".errorJumlahPax").text("Jumlah Pax Tidak Boleh Kosong.");
      $("#paxInput").addClass("is-invalid");
      return;
    } else if (isNaN(pax) || pax <= 0) {
      $(".errorJumlahPax").text(
        "Harap Masukan Angka Lebih Besar Dari 0"
      );
      $("#paxInput").addClass("is-invalid");
      return;
    } else {
      $(".errorJumlahPax").text("");
      $("#paxInput").removeClass("is-invalid");
      $("#paxInput").addClass("is-valid");
    }

    if (!unitPriceUSD) {
      $(".errorHargaUsd").text("Harga Tidak Boleh Kosong.");
      $("#unitPriceUSDInput").addClass("is-invalid");
      return;
    } else if (isNaN(unitPriceUSD) || pax <= 0) {
      $(".errorHargaUsd").text(
        "Harap Masukan Angka Lebih Besar Dari 0"
      );
      $("#unitPriceUSDInput").addClass("is-invalid");
      return;
    } else {
      $(".errorHargaUsd").text("");
      $("#unitPriceUSDInput").removeClass("is-invalid");
      $("#unitPriceUSDInput").addClass("is-valid");
    }

    kursIDR = parseFloat(kursIDR);
    unitPriceUSD = parseFloat(unitPriceUSD);
    var row = $("<tr>");
    $("<td>").text(formatNumber(kursIDR, "Rp")).appendTo(row);
    $("<td>").text(jenisVisa).appendTo(row);
    $("<td>").text(pax).appendTo(row);
    $("<td>").text(formatNumber(unitPriceUSD, "$")).appendTo(row);
  
    // Hitung total amount USD
    var totalAmountUSD = pax * unitPriceUSD;
    $("<td>").text(formatNumber(totalAmountUSD, "$")).appendTo(row);
  
    var totalAmountIDR = kursIDR * totalAmountUSD;
    $("<td>").text(formatNumber(totalAmountIDR, "Rp")).appendTo(row);
    
    if (!keterangan) {
      keterangan = "-";
    }
    $("<td>").text(keterangan).appendTo(row);


    // Tombol Delete
    var deleteButton = $("<button>")
      .addClass("btn btn-danger btn-sm delete-row-insert")
      .click(function () {
        $(this).closest("tr").remove();
        calculateOverallTotal();
      });
    var deleteIcon = $("<i>").addClass("fa fa-trash");
    deleteButton.append(deleteIcon);
    $("<td>").append(deleteButton).appendTo(row);

    // Menambahkan data baru ke dalam tabel preview
    $("#previewTable tbody").append(row);

    // Mengosongkan input setelah ditambahkan ke dalam tabel
    $("#jenisVisaInput").val("").removeClass("is-valid");
    $("#paxInput").val("").removeClass("is-valid");
    $("#unitPriceUSDInput").val("").removeClass("is-valid");
    $("#keterangan").val("").removeClass("is-valid");

    // Menghitung total keseluruhan
    calculateOverallTotal();
  });

  function formatNumber(number, currency) {
    return currency + number.toLocaleString(undefined, {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2,
    });
  }

  function calculateOverallTotal() {
    var totalPax = 0;
    var totalAmountUSD = 0;
    var totalAmountIDR = 0;
    var previewData = [];

    $("#previewTable tbody tr").each(function () {
      var pax = parseInt($(this).find("td:nth-child(3)").text());
      var amountUSD = parseFloat(
        $(this).find("td:nth-child(5)").text().replace(/[^0-9.-]+/g, "")
      );
      var amountIDR = parseFloat(
        $(this).find("td:nth-child(6)").text().replace(/[^0-9.-]+/g, "")
      );
      var row = {};
      row.kurs_idr = parseFloat(
        $(this).find("td:nth-child(1)").text().replace(/[^0-9.-]+/g, "")
      );
      row.jenis_visa = $(this).find("td:nth-child(2)").text();
      row.jumlah_pax = parseInt($(this).find("td:nth-child(3)").text());
      row.harga_unit_usd = parseFloat(
        $(this).find("td:nth-child(4)").text().replace(/[^0-9.-]+/g, "")
      );
      row.total_harga_unit_usd = amountUSD
      row.total_harga_unit_idr = amountIDR
      row.keterangan = $(this).find("td:nth-child(7)").text();

      totalPax += pax;
      totalAmountUSD += amountUSD;
      totalAmountIDR += amountIDR;
      previewData.push(row);
    });

    // Update the overall total in the table footer
    $("#previewTable tfoot").remove(); // Remove any existing footer
    var footer = $("<tfoot>").appendTo($("#previewTable"));
    var row = $("<tr>").appendTo(footer);
    $("<td>").text("Total Visa Payment").attr("colspan", 2).appendTo(row);
    $("<td>").text(totalPax).appendTo(row);
    $("<td>").appendTo(row); // Empty cell for unitPriceUSD
    $("<td>").text(formatNumber(totalAmountUSD, "$")).appendTo(row);
    $("<td>").text(formatNumber(totalAmountIDR, "Rp")).appendTo(row);
    $("<td>").appendTo(row); // Empty cell for keterangan
    $("<td>").appendTo(row); // Empty cell for delete button

    // isValidationPassed = true;
    $("#preview_data_input").val(JSON.stringify(previewData));
  }
});
