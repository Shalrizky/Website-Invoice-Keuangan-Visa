// active sidebar
$(document).ready(function () {
  "use strict";

  const successMessage = sessionStorage.getItem("successMessage");

  if (successMessage) {
    Swal.fire({
      icon: "success",
      title: "Berhasil!",
      text: successMessage,
      timer: 2000,
      timerProgressBar: true,
    });

    // Clear the success message from sessionStorage
    sessionStorage.removeItem("successMessage");
  }


   $(document).ready(function () {
        $('#submitButtonPembayaran').click(function (e) {
            e.preventDefault();

            let form = $('.invoicePembayaranForm');
            let formData = new FormData(form[0]);

            // Get the file input field and its selected file
            let fileInput = form.find('[name="bukti_gambar_pembayaran"]');
            let file = fileInput[0].files[0];

            // Append the file data to the formData object
            formData.append('bukti_gambar_pembayaran', file);

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message);

                    } else if (response.status === 'error') {
                        // Handle validation errors
                        for (const [key, value] of Object.entries(response.errors)) {
                            let inputField = form.find(`[name="${key}"]`);
                            inputField.addClass('is-invalid');
                            inputField.siblings('.invalid-feedback').text(value);
                        }
                    }
                },
                error: function (xhr, status, error) {
                    // Handle other errors if any
                    console.error(xhr.responseText);
                }
            });
        });
    });


});
