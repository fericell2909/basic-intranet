$(document).ready(function () {
    /*
     * Ocultamos inicialmente el contenedor para el cod. de decanatura/femision
     */
    if ($('input:radio[name=rbestado]:checked').val() != 'emitido') {
        $('#coddec-container').hide();
        $('#femision-container').hide();
    }

    /*
     * Mostramos el contenido correspondiente para el cod. de decanatura
     * en función de la opción seleccionada, añadiendo o removiendo
     * atributos segun convenga.
     */
    $('input:radio[name=rbestado]').change(function () {
        if (this.value == 'tramite') {
            $('#coddec-container').hide();
            $('#femision-container').hide();
            $("#coddec").removeAttr('required');
            $("#femision").removeAttr('required');
        } else if (this.value == 'emitido') {
            $('#coddec-container').show();
            $('#femision-container').show();
            $("#coddec").attr('required', true);
            $("#femision").attr('required', true);
        }
    });
    $("#coddec").inputmask();
    // Select 2
    $('.select-curso').select2({
        language: "es",
        placeholder: "Especifique un curso",
        allowClear: true,
        width: 'resolve'
    });
    $('.select-cliente').select2({
        language: "es",
        placeholder: "Especifique un cliente",
        allowClear: true,
        width: 'resolve'
    });






    /* Devuelve una lista de cursos en función a la modalidad y condición */
    $("#cbx_condicion").change(function () {
        $('#cbx_curso').find('option').remove();
        $("#cbx_condicion option:selected").each(function () {
            condicion = $(this).val();
            tipo_modalidad = $("#cbx_modalidad option:selected").val();
            $.post("elements/getCursosAll.php", {tipo_modalidad: tipo_modalidad, condicion: condicion}, function (data) {
                $("#cbx_curso").html(data);
            });
        });
    });
    /* Devuelve información del curso en función al id del curso*/
    $("#cbx_curso").change(function () {
        $("#cbx_curso option:selected").each(function () {
            id_curso = $(this).val();
            $.post("elements/getHorasCurso.php", {id_curso: id_curso}, function (data) {
                if (data) {
                    $("#horas_acad").html(data);
                } else {
                    $("#horas_acad").html('<i>No especificado</i>');
                }
            });
        });
    });
    $('#nuevo_certificado').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: this.action,
            type: this.method,
            data: $(this).serialize(),
            beforeSend: function () {
                waitingDialog.show('Enviando');
            }
        })
                .done(function (data) {
                    $("#contenidoCertificadoModal").html(
                            "<p>¡El certificado <span style='font-size:20px;font-weight:bold'>" + data + "</span>  ha sido satisfactoriamente creado!. </p>\n\
                            <div class='qr-field'>\n\
                                <h3 style='text-align:center'>Codigo QR Generado: </h3>\n\
                                <center>\n\
                                    <div id='qr-div' class='qrframe' style='border:2px solid black; width:210px; height:210px;'>\n\
                                        <img src='media/crt/" + data + ".png' style = 'width:200px; height:200px;' >\n\
                                    </div>\n\
                                    <a class='btn btn-primary submitBtn' style='width:210px; margin:5px 0;' href='modulos/certificado/acciones.php?accion=descargar&file=" + data + ".png' > Descargar código QR </a>\n\
                                    <button class='btn copiar-qr' style='margin:5px 0;' data-clipboard-target='#qr-div'>Copiar</button>\n\
                                </center>\n\
                            </div>");
                    $('#CertificadoSuccessAddModal').modal();

                    //Clipboard
                    new Clipboard('.copiar-qr');
                })
                .always(function () {
                    waitingDialog.hide();
                });
        //return false;
    });
    $('#editar_certificado').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: this.action,
            type: this.method,
            data: $(this).serialize(),
            beforeSend: function () {
                waitingDialog.show('Enviando');
            }
        })
                .done(function () {
                    $(location).attr('href', 'certificado.php?id=' + $('#certificado_id').val());
                })
                .always(function () {
                    waitingDialog.hide();
                });
        //return false;
    });
});
