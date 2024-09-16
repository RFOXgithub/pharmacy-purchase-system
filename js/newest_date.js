document.addEventListener('DOMContentLoaded', function() {
    var datepicker = document.querySelector('#tanggal_perawatan');
    
    datepicker.addEventListener('focus', function() {
        var today = new Date();
        var minDate = today.toISOString().split('T')[0];
        
        var maxDate = new Date(today);
        maxDate.setMonth(today.getMonth() + 1);
        var maxDateString = maxDate.toISOString().split('T')[0];
        
        datepicker.setAttribute('min', minDate);
        datepicker.setAttribute('max', maxDateString);
    });
});
