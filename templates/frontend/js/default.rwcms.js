$(window).load(function() {
    $("#ui-datepicker-div").hide();
});
$(document).ready( function(){
    $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat : "yy-mm-dd",
        yearRange: '1945:2010'
    });
});