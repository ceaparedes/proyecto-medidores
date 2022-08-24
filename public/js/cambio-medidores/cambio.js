$(document).on('change', '#lectura-retiro', function(){
    let lectura = $(this).val();
    let orden = $(this).attr('rel');

    

    let response = await fetch('/', [options]);



});

$(document).on('change', '#medidor', function(){

});

$(document).on('click', '#continue-1', function(){

    /////////
    $('#cambio-1').hide();
    $('#cambio-2').show();
});


$(document).on('click', '#continue-2', function(){

    /////////
    $('#cambio-2').hide();
    $('#cambio-3').show();
});

$(document).on('click', '#continue-3', function(){

    /////////
    $('#cambio-3').hide();
    $('#cambio-4').show();
});