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
});
