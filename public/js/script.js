var input = document.querySelector("#phone");
var iti = window.intlTelInput(input, {
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
    initialCountry: "ph",
    separateDialCode: true,
});
iti.setNumber("+63"); 

$('#phone').on('keydown keyup', function(event) {
    var input = $(this);
    var value = input.val();
    var msgphone = $('.msgphone'); 
    value = value.replace(/[^\d-]/g, ''); 
    value = value.replace(/-{2,}/g, '-'); 
    value = value.replace(/^-+|-+$/g, '');

    input.val(value);
});  

$("#phone").on("input", function () {
    $(this).val($(this).val().replace(/\D/g, "").replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3"));
});  