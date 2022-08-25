elemento = document.querySelector('.formato-rut');
elemento && elemento.addEventListener('input', (e) => {

    let rut = e.target;

    // Despejar Puntos
    var valor = rut.value.replace('.', '');
    // Despejar Guión
    valor = valor.replace('-', '');

    // Aislar Cuerpo y Dígito Verificador
    cuerpo = valor.slice(0, -1);
    dv = valor.slice(-1).toUpperCase();

    if (!cuerpo && !dv) {
        rut.value = '';
        return false;
    }
    // Formatear RUN
    rut.value = cuerpo + '-' + dv

});

elemento.addEventListener('change', (e) => {

    if (Fn.validaRut(e.target.value)) {
        $('#error-rut').empty();
    } else {
        $('#error-rut').empty();
        $('#error-rut').append(`<span class="btn btn-danger btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-exclamation-triangle"></i>
            </span>
            <span class="text">El rut ingresado no es valido</span>
        </span>`);
        
    }
})

var Fn = {
    // Valida el rut con su cadena completa "XXXXXXXX-X"
    validaRut: function (rutCompleto) {
        rutCompleto = rutCompleto.replace("‐", "-");
        if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto))
            return false;
        var tmp = rutCompleto.split('-');
        var digv = tmp[1];
        var rut = tmp[0];
        if (digv == 'K') digv = 'k';

        return (Fn.dv(rut) == digv);
    },
    dv: function (T) {
        var M = 0, S = 1;
        for (; T; T = Math.floor(T / 10))
            S = (S + T % 10 * (9 - M++ % 6)) % 11;
        return S ? S - 1 : 'k';
    }
}

