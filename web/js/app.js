$(document).ready(function() {
  if ($(".form-absensi")) {
    $('input[name="tipe"]').on("change", function() {
      if ($(this).val() == "2") {
        $("#laporan").slideDown(500);
      } else {
        $("#laporan").slideUp(500);
      }
    });
  }
});
