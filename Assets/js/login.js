

$(document).ready(function() {  
    $('.carousel').carousel()  

    $('#login').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')})


});
