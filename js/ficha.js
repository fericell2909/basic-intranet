$(document).ready(function () {

    /****** CURSO ******/

    var NombreCurso;
    var CodigoCurso;
    $("#url_info").hide();
    $('#pago-container').hide();
    
    $('#cbx_modalidad').change(function () {
        const modalidad = $('#cbx_modalidad').val();
       if(modalidad == 'v'){
           $('#slc_tipo').hide();
       } else {
           $('#slc_tipo').show();
       }
    });

    /* Devuelve una lista de cursos en función a la modalidad y condición */
    $("#cbx_condicion").change(function () {
        $('#cbx_curso').find('option').remove();
        $("#url_info").hide(); //?
        $("#horas_acad").html('');
        $("#tiempo").html('');
        $('#cbx_horario').find('option').remove();
        $("#costo_mes2").html('');

        $("#cbx_condicion option:selected").each(function () {
            condicion = $(this).val();
            tipo_modalidad = $("#cbx_modalidad option:selected").val();

            $.post("elements/getCursos.php", {tipo_modalidad: tipo_modalidad, condicion: condicion}, function (data) {
                $("#cbx_curso").html(data);
            });
        });
    });


    /* Devuelve información del curso en función al id del curso*/
    $("#cbx_curso").change(function () {
        $("#cbx_curso option:selected").each(function () {
            id_curso = $(this).val();


            $.post("elements/getDatosCurso.php", {id_curso: id_curso}, function (data) {

                if (data.split("||")[0]) {
                    $("#url_info").show();
                    $("#url_info").prop("href", data.split("||")[0]);
                } else {
                    $("#url_info").hide();
                }

                if (data.split("||")[1]) {
                    $("#horas_acad").html(data.split("||")[1]);
                } else {
                    $("#horas_acad").html('<i>No especificado</i>');
                }

                if (data.split("||")[2]) {
                    if (data.split("||")[2] == 1) {
                        $("#tiempo").html(data.split("||")[2] + " mes");
                    } else {
                        $("#tiempo").html(data.split("||")[2] + " meses");
                    }
                } else {
                    $("#tiempo").html('<i>No especificado</i>');
                }

                if ($("#cbx_modalidad option:selected").val() == 'v') {
                    $('#cbx_horario').prop('disabled', true);
                } else {
                    $('#cbx_horario').prop('disabled', false);
                    $("#cbx_horario").html(data.split("||")[3]);
                    // $('#slc_tipo').show();
                }

                $("#costo_mes2").html("S/. " + data.split("||")[4]);
                $("#costo_mes").val(data.split("||")[4]);

                $("#cod_curso").html(data.split("||")[6]);


                /* Establecemos valores a variables que seran usadas a la hora de mostrar el modal de success */
                NombreCurso = data.split("||")[5];
                CodigoCurso = data.split("||")[6];
            });
        });
    });


    /* Cambia el contenido del pago-container en funcion a la opcion elegida */
    $('input:radio[name=rbpago]').change(function () {
        if (this.value == 'interior') {

            $("#pago-container").html(
                    '<p>Presentar lo siguiente a la hora de realizar el pago :  </p>\n\
                <ul>\n\
                <li><b>Código ALUMNO/DNI </b></li>\n\
                <li><b>Código de Curso</b></li>\n\
                </ul>');

            $('#pago-container').show();


        } else if (this.value == 'exterior') {
            $("#pago-container").html(
                    '<p>Presentar lo siguiente a la hora de realizar el pago :  </p>\n\
                <ul>\n\
                <li><b>Tasas Educativas:</b> Código 9135 </li>\n\
                <li><b>Universidad:</b> Código 29 "Código UNS" </li>\n\
                <li><b>Código ALUMNO/DNI </b></li>\n\
                <li><b>Código de Curso</b></li>\n\
                </ul>');

            $('#pago-container').show();
        }
    });



    $('.select-curso').select2({
        language: "es",
        placeholder: "Especifique un curso",
        allowClear: true,
        width: 'resolve'
    });






    /****** CLIENTE ******/
    /*
     * Ocultamos inicialmente los contenedore para la infor. del cliente
     */
    $('#list_cliente-container').hide();
    $('#new_cliente-container').hide();

    /*
     * Mostramos el contenido correspondiente para infor. del cliente
     * en función de la opción seleccionada, añadiendo o removiendo
     * atributos segun convenga.
     */
    $('input:radio[name=rbcliente]').change(function () {
        if (this.value == 'existe') {
            $('#list_cliente-container').show();
            $('#new_cliente-container').hide();

            $("#valor_cliente").val('existe');

            $("#apellidos").removeAttr('required');
            $("#nombres").removeAttr('required');
            $("#codigo").removeAttr('required');
            $("#fnacimiento").removeAttr('required');
            $("#domicilio").removeAttr('required');
            $("#cbx_departamento").removeAttr('required');
            $("#cbx_provincia").removeAttr('required');
            $("#cbx_distrito").removeAttr('required');
            $("#ocupacion_si").removeAttr('required');
            $("#email").removeAttr('required');
            $("#tcelular").removeAttr('required');

            $("#cbx_cliente").attr('required', true);

        } else if (this.value == 'nuevo') {
            $('#list_cliente-container').hide();
            $('#new_cliente-container').show();

            $("#valor_cliente").val('nuevo');

            /* Añadimos el atributo required a los inputs, selects, rb del la parte de Datos Cliente*/
            $("#apellidos").attr('required', true);
            $("#nombres").attr('required', true);
            $("#codigo").attr('required', true);
            $("#fnacimiento").attr('required', true);
            $("#domicilio").attr('required', true);
            $("#cbx_departamento").attr('required', true);
            $("#cbx_provincia").attr('required', true);
            $("#cbx_distrito").attr('required', true);
            $("#ocupacion_si").attr('required', true);
            $("#email").attr('required', true);
            $("#tcelular").attr('required', true);

            $("#cbx_cliente").removeAttr('required');
        }
    });



    // Select 2
    $('.select-cliente').select2({
        language: "es",
        placeholder: "Especifique un cliente",
        allowClear: true,
        width: 'resolve'
    });

    /* END CLIENTE */


    /* FICHA PUBLICA */

    $('#ficha').submit(function (e) {
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
                    // Socilitud ajax finalizada, mostramos el modal de success
                    if (($("#cod_voucher").val() == '') && ($("#fecha_voucher").val() == '')) {
                        $("#contenidoFichaModal").html(
                                '<p>¡Su ficha ha sido satisfactoriamente registrada!. </p>\n\
     <p>Usted actualmente está pre-inscrito al curso <b>' + NombreCurso + ' </b> , para completar su inscripción deberá realizar el pago del curso al código <b>' + CodigoCurso + ' </b> y acercarse a la dirección de CECOMP con lo siguiente: </p>\n\
     <ul>\n\
     <li>Voucher original del pago al código de curso correspondiente </li>\n\
     <li>Copia de Voucher original del pago al código de curso correspondiente</li>\n\
     <li>Dni</li>\n\
     <li>Copia de DNI</li>\n\
     </ul>');
                    } else {
                        $("#contenidoFichaModal").html(
                                '<p>¡Su ficha ha sido satisfactoriamente registrada!. </p>\n\
     <p>Usted actualmente está pre-inscrito al curso <b>' + NombreCurso + ' </b> , para completar su inscripción deberá acercarse a la dirección de CECOMP con lo siguiente: </p>\n\
     <ul>\n\
     <li>Voucher original del pago al código de curso correspondiente </li>\n\
     <li>Copia de Voucher original del pago al código de curso correspondiente</li>\n\
     <li>Dni</li>\n\
     <li>Copia de DNI</li>\n\
     </ul>');

                    }
                    $('#FichaModal').modal();
                })
                .always(function () {
                    waitingDialog.hide();
                });
        //return false;
    });




    /* END FICHA PUBLICA */

    /*  Logica Next Button */
    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn'),
            clienteNextBtn = $('.nextBtnCliente'),
            allPrevBtn = $('.prevBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url'],input[type='email'],input[type='radio'],input[type='tel'], select, textarea"),
                isValid = true;

        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            //nextStepWizard.removeAttr('disabled').trigger('click');
            nextStepWizard.removeClass('disabled').trigger('click');
    });


    clienteNextBtn.click(function () {
        isValid = false;
        if ($('input:radio[name=rbcliente]:checked').val() == 'existe') {
            var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("#cbx_cliente"),
                    isValid = true;

            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }
        }
        if ($('input:radio[name=rbcliente]:checked').val() == 'nuevo') {
            var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url'],input[type='email'],input[type='radio'],input[type='tel'], select, textarea"),
                    isValid = true;

            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }
        }

        if (isValid) {
            //nextStepWizard.removeAttr('disabled').trigger('click');
            nextStepWizard.removeClass('disabled').trigger('click');
        }

    });

    allPrevBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

        prevStepWizard.removeAttr('disabled').trigger('click');

    });

    $('div.setup-panel div a.btn-primary').trigger('click');


    /*  END Logica Next Button */
});