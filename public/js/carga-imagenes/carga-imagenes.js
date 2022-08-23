function base64MimeType(encoded) {
    var result = null;
    if (typeof encoded !== 'string') {
        return result;
    }
    var mime = encoded.match(/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).*,.*/);
    if (mime && mime.length) {
        result = mime[1];
    }

    return result;
}


$(document).on('change', '.img_file', function () {
    let base_id = $(this).attr('rel');

    var files = $('#image-' + base_id).prop('files');
    var token = $('input[name="_token"]').val();
    if (files && files[0]) {
        var FR = new FileReader();
        FR.addEventListener("load", function (e) {
            var size = document.getElementById('image-' + base_id).files[0].size;
            if (size > 10000000) {
                swal("Oops", "Imagen no debe pesar mas de 10 mb", "error");
                return false;
            }

            var img = '';
            img = e.target.result;


            var cadena = base64MimeType(img);
            let ext = cadena.split('/')[1];

            if ((cadena.indexOf("image") > -1)) {
                img = img.split(',');

                $.ajax({
                    url: '/instalaciones/upload-image',
                    type: 'post',
                    dataType: 'json',
                    data: { img: e.target.result, ext: ext },
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function (response) {
                        if (response.result) {
                            $("#path-imagen-" + base_id).val(response.archivo);
                            document.getElementById('preview-image-' + base_id).src = e.target.result;


                        }
                        else {
                            swal("Oops", response.msg , "error");
                        }
                    },
                    error: function (j) {
                        swal("Oops", "Ha ocurrido un error, imagen no cargada. intente nuevamente", "error");
                    }
                });


            } else {
                swal("Oops", "¡Debe adjuntar una imagen!", "error");
            }

        });
        FR.readAsDataURL(this.files[0]);
    }

});



