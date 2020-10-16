

$(document).ready(function () {
    // Select 2
    $(".select-horario").select2({
        language: "es",
        placeholder: "Especifique el horario",
        allowClear: true,
        tags: true,
        width: 'resolve'
    });

    $(".select-horariof").select2({
        language: "es",
        placeholder: "Especifique el horario",
        allowClear: true,
        width: 'resolve'
    });

    $('.select-modalidad').select2({
        language: "es",
        placeholder: "Seleccione modalidad",
        allowClear: true,
        width: 'resolve'
    });

    $('.select-condicion').select2({
        language: "es",
        placeholder: "Seleccione condición",
        allowClear: true,
        width: 'resolve'
    });


    $("#cbx_modalidad").change(function () {
        //Para addficha.php
        $('#cbx_curso').find('option').remove();
        $("#horas_acad").html('');
        $("#tiempo").html('');
        $('#cbx_horario').find('option').remove();
        $("#costo_mes2").html('');
        //


        if ($("#cbx_modalidad option:selected").val() == 'v') {
            $cond = '<option></option> <option value="pgen">Público en general</option> ';
            $('#cbx_condicion').html($cond);
        } else {
            $cond = '<option></option> <option value="auns" >Alumno UNS</option> <option value="tuns">Trabajador UNS</option> <option value="pgen">Público en general</option>';
            $('#cbx_condicion').html($cond);
        }
    });

});
