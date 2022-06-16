jQuery(function ($) {
    $('#wcdd-datepicker').datepicker({
        dateFormat: 'dd.mm',
        minDate: 0
    });

    $('.wcdd-delivery__clock select').select2({
        dropdownAutoWidth: true,
        width: '100%',
    });
});
