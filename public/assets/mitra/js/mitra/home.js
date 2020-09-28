$('#start_date').datepicker({
    language: 'en',
    dateFormat: 'dd M yyyy',
    autoClose: true,
    onSelect: function(fd, date) {
        $('#end_date').data('datepicker')
            .update('minDate', date);
        $('#end_date').focus();
    }
});

$('#end_date').datepicker({
    language: 'en',
    dateFormat: 'dd M yyyy',
    autoClose: true,
    onSelect: function(fd, date) {
        $('#start_date').data('datepicker')
            .update('maxDate', date);
    }
});