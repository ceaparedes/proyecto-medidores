let token = $('input[name="_token"]').val();

$(document).on('change', '#lectura-retiro', function () {
    let lectura = $(this).val();
    let orden = $(this).attr('rel');

    $.ajax({
        url: '/instalaciones/validar-lectura',
        type: 'post',
        dataType: 'json',
        data: { lectura: lectura, orden: orden },
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function (response) {
            if (response.result) {
                $('#informacion-lectura').empty();
                $('#informacion-lectura').append(`
                                    <span class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">`+ response.msg + `</span>
                                    </span>
                                    `);
            }
            else {
                $('#informacion-lectura').empty();
                $('#informacion-lectura').append(`
                                    <span class="btn btn-danger btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </span>
                                        <span class="text">`+ response.msg + `</span>
                                    </span>
                                    `);
            }
        },
        error: function (j) {
            $('#informacion-lectura').empty();
            swal("Ups", "Ha ocurrido un error, Rango no calculado", "error");
        }
    });


});



$(document).on('click', '#continue-1', function () {

    /////////
    if ($('#path-imagen-1').val() != '') {
        $('#cambio-1').hide();
        $('#cambio-2').show();
    } else {
        swal("Ups", "Debe adjuntar Fotografia", "error");
    }

});

$(document).on('change', '#medidor', function (e) {
    e.preventDefault();
    let medidor = $(this).val();
    $.ajax({
        url: '/medidores/get-medidor',
        type: 'post',
        dataType: 'json',
        data: { medidor: medidor },
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function (response) {
            if (response.id) {

                $('#informacion-medidores').empty();
                $('#informacion-medidores').append(`<ul class="list-group">
                                                    <li class="list-group-item active">Medidor Seleccionado</li>
                                                    <li class="list-group-item">Marcas: <b>`+response.marcas.nombre+`</b></li>
                                                    <li class="list-group-item">Número: <b>`+response.numero+`</b></li>
                                                    <li class="list-group-item">Diametro <b>`+response.diametro+`</b></li>
                                                    <li class="list-group-item">Año <b>`+response.ano+`</b></li>
                                                </ul>`);
            }else{
                $('#informacion-medidores').empty();
                $('#informacion-medidores').append(`<ul class="list-group">
                                                    <li class="list-group-item">Informacion de medidor no encontrada</li>
                                                </ul>`);
            }

        },
        error: function (j) {
            $('#informacion-medidores').empty();
            swal("Ups", "Ha ocurrido un error, Rango no calculado", "error");
        }
    });

});


$(document).on('click', '#continue-2', function () {

    /////////

    if($('#medidor').val() != '' && $('#path-imagen-2').val() != ''){
        $('#cambio-2').hide();
        $('#cambio-3').show();
    }else{

        swal("Ups", "Debe seleccionar un medidor y subir una fotografía", "error");
    }
    
});

$(document).on('click', '#continue-3', function () {

    if($('#varales').val() != '' && $('#nombre-cliente').val() != ''  && $('#rut-cliente').val() != '' && $('#path-imagen-3').val() ){
        if(Fn.validaRut($('#rut-cliente').val())){
            $('#cambio-3').hide();
            $('#cambio-4').show();
        }else{
            swal("Ups", "El rut ingresado no es valido", "error");   
        }
       
    }else{
        swal("Ups", "Debe seleccionar varales e ingresar informacion de cliente", "error");
    }
    
});

$(document).on('submit', '#form-cambio', function(){
    if($('#path-imagen-4').val() != ''){
        $('#cambio-1').show();
        $('#cambio-2').show();
        $('#cambio-3').show();

        return true;
    }
    swal("Ups", "Debe subir la orden de cambio", "error");
    return false
});