// active sidebar
$(document).ready(function () {
  "use strict";

  var url = window.location.href;
  var activePage = url;
  $(".sidebar li a").each(function () {
    var linkPage = this.href;
    if (activePage === linkPage) {
      $(this).closest("li a").addClass("active");
      $(this).closest(".collapse").addClass("show");
      $(this).closest(".collapse").prev(".nav-link").addClass("collapsed");
    }
  });
  $(".sidebar li a").each(function () {
    var linkPage = this.href;
    if (activePage === linkPage) {
      $(this).closest("li").addClass("active");
      $(this).closest(".collapse").addClass("show");
      $(this).closest(".collapse").prev(".nav-link").addClass("collapsed");
    }
  });

  // button action kembali
  $("#kembaliButton").click(function () {
    window.history.back();
  });

  // Tampilan Loading
  document.addEventListener("DOMContentLoaded", function () {
    $("#loading").show();
  });

  $(window).on("load", function () {
    $("#loading").hide();
  });

  // // Halaman Interaktif No refresh Ajax
  // function handleInvoiceLinkClick(event) {
  //   event.preventDefault();

  //   var url = $(this).attr("href");

  //   $.ajax({
  //     url: url,
  //     method: "GET",
  //     success: function (response) {
  //       $("#wrapper").html(response);

  //       // Mengubah URL di browser
  //       history.pushState({}, "", url);

  //       // Mengambil title dari response
  //       var title = $(response).filter("title").text();

  //       // Mengatur title halaman
  //       document.title = title;
  //       $("#loading").hide();
  //     },
  //     error: function () {
  //       // Handle error case if the request fails
  //     },
  //   });
  // }

  // $("#invoiceTambahLink, #kelolaInvoiceLink, #dashboardLink").click(handleInvoiceLinkClick);

  //VALIDASI HALAMAN TAMBAH DAN EDIT KEYUP
  function validateInputField(fieldId, errorClass, errorMessage) {
    var fieldValue = $("#" + fieldId).val();

    if (fieldId === "no_telepon") {
      if (fieldValue && /^\d{12}$/.test(fieldValue)) {
        $("#" + fieldId)
          .removeClass("is-invalid")
          .addClass("is-valid");
        $("." + errorClass).html("");
      } else {
        $("#" + fieldId)
          .removeClass("is-valid")
          .addClass("is-invalid");
        $("." + errorClass).html(errorMessage);
      }
    } else {
      if (fieldValue) {
        $("#" + fieldId)
          .removeClass("is-invalid")
          .addClass("is-valid");
        $("." + errorClass).html("");
      } else {
        $("#" + fieldId)
          .removeClass("is-valid")
          .addClass("is-invalid");
        $("." + errorClass).html(errorMessage);
      }
    }
  }

  // Membuat event listener untuk setiap input field
  $(
    "#no_invoice, #kasa, #jenis_invoice, #created_at, #nama_customer, #no_telepon"
  ).on("input", function () {
    var fieldId = $(this).attr("id");
    var errorClass = "error" + fieldId.charAt(0).toUpperCase();

    if (fieldId === "no_telepon") {
      var errorMessage = "Nomor Telepon Harus Berisi Angka 11/12 Digit";
    }

    validateInputField(fieldId, errorClass, errorMessage);
  });

  // Menambahkan event listener keyup untuk input field no_telepon
  $("#no_telepon").on("input", function () {
    var fieldValue = $(this).val();
    var errorClass = "errorNoTelepon";
    var errorMessage = "Nomor Telepon Harus Berisi Angka 11/12 Digit";

    if (fieldValue && /^\d{11,12}$/.test(fieldValue)) {
      $(this).removeClass("is-invalid").addClass("is-valid");
      $("." + errorClass).html("");
    } else {
      if (!fieldValue) {
        $(this).removeClass("is-valid").addClass("is-invalid");
        $("." + errorClass).html("Nomor Telepon Tidak Boleh Kosong");
      } else {
        $(this).removeClass("is-valid").addClass("is-invalid");
        $("." + errorClass).html(errorMessage);
      }
    }
  });

  // CHEK INPUT APAKAH ADA YANG KOSONG ATAU TIDAK JIKA ADA MAKA IA AKAN IS VALID UNTUK BAGIAN EDIT INVOICE
  checkAndUpdateFields();
  function checkAndUpdateFields() {
    const inputFields = [
      { fieldId: "no_invoice" },
      { fieldId: "kasa" },
      { fieldId: "jenis_invoice" },
      { fieldId: "updated_at" },
      { fieldId: "nama_customer" },
      { fieldId: "no_telepon" },
    ];

    // Lakukan pengecekan pada setiap input field
    inputFields.forEach(function (field) {
      var fieldValue = $("#" + field.fieldId).val();
      if (fieldValue) {
        $("#" + field.fieldId).addClass("is-valid");
      }
    });
  }
});
