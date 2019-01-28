$(document).ready(function() {
  if ($(".form-absensi")) {

    var _laporan = $("#laporan");
    var _date = $("#date");
    var _time = $("#time");

    var __date = new Date();

    $( "#nim" ).autocomplete({
      source: availableTags,
      change: function (event, ui) {
        if (!ui.item) {
          $(this).val('');
        }
      }
    });

    _date.val(__date.getFullYear() + '-' + ('0' + (__date.getMonth()+1)).slice(-2) + '-' + __date.getDate());
    _time.val(__date.toLocaleTimeString());

    var intv = setInterval(function() {
      _time.val((new Date()).toLocaleTimeString());
    }, 1000);

    $('input[name="tipe"]').on("change", function() {
      if ($(this).val() == "2") {
        _laporan.slideDown(500);
      } else {
        _laporan.slideUp(500);
      }
    });
  }
});
