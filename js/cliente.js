

$(document).ready(function () {
    // Select 2
    $('.select-condicion').select2({
        language: "es",
        placeholder: "Seleccione condici√≥n",
        allowClear: true,
        width: 'resolve'
    });

    $('.select-departamento').select2({
        language: "es",
        placeholder: "Departamento",
        allowClear: true,
        width: 'resolve'
    });

    $('.select-provincia').select2({
        language: "es",
        placeholder: "Provincia",
        allowClear: true,
        width: 'resolve'
    });

    $('.select-distrito').select2({
        language: "es",
        placeholder: "Distrito",
        allowClear: true,
        width: 'resolve'
    });

    $(".select-carreras").select2({
        language: "es",
        placeholder: "Especifique una carrera",
        allowClear: true,
        tags: true,
        width: 'resolve'
    });
    
    
    //Buscar nombres y apellido mediante DNI en RENIEC - API REST
    $('#dni-valid').hide();
    $('#btn-buscar-dni').click(function (e) {
        e.preventDefault();

        const dni = $('#codigo').val();
        if(dni.length == 8) {
            const token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImpvcmRhbjEyMTk5ODU2MTJAZ21haWwuY29tIn0.DC0nwFkb3ITXiFHqLxQgN0nTuH6mZeDfquvKVEh6NRI";
            const url = `https://dniruc.apisperu.com/api/v1/dni/${dni}?token=${token}`;
        
            $.ajax({
                url: url,
                type: "GET"
            })
                .done(function (data) {
                    if(data.nombres != ''){
                        // $('#nombres').attr("readonly","readonly");
                        // $('#apellidos').attr("readonly","readonly");
                        $('#nombres').val(data.nombres);
                        $('#apellidos').val(`${data.apellidoPaterno} ${data.apellidoMaterno}`);
                        $('#dni-valid').hide();
                        
                    } else {
                        // $('#nombres').removeAttr("readonly");
                        // $('#apellidos').removeAttr("readonly");
                        $('#dni-valid').show();
                        $('#nombres').val("");
                        $('#apellidos').val("");
                    }
                });
        } else {
            $('#dni-valid').show();
        }
        
    });
    
    //Validaci®Æn de Email
    $('#email-valid').hide();
    $('#email').change(function () {
        const email = $('#email').val();
        if(email.indexOf('@', 0) == -1 || email.indexOf('.', 0) == -1) {
            $('#email-valid').show();
        } else {
            $('#email-valid').hide();
        }
    });


    /*
     *  Ocultamos inicialmente los contenedores para la ocupaci√≥n
     */
    $('#carreras-container').hide();
    $('#otros-container').hide();

    /*
     * Devuelve una lista de provincias relacionadas a un departamento
     */
    $("#cbx_departamento").change(function () {
        $('#cbx_distrito').find('option').remove();
        $("#cbx_departamento option:selected").each(function () {
            id_departamento = $(this).val();
            $.post("elements/getProvincias.php", {id_departamento: id_departamento}, function (data) {
                $("#cbx_provincia").html(data);
            });
        });
    });

    /*
     * Devuelve una lista de distritos relacionadas a una provincia
     */
    $("#cbx_provincia").change(function () {
        $("#cbx_provincia option:selected").each(function () {
            id_provincia = $(this).val();
            $.post("elements/getDistritos.php", {id_provincia: id_provincia}, function (data) {
                $("#cbx_distrito").html(data);
            });
        });
    });

    /*
     * Muestra cb con lista de carreras o un input para que especifique, dependiendo de la elecci√≥n
     */
    $('input:radio[name=rbocupacion]').change(function () {
        $('#otros-container').hide();
        if (this.value == 'si') {
            $('#carreras-container').show();
            $('#otros-container').hide();

            $("#cbxcarreras").attr('required', true);
            $("#otra_ocupacion").removeAttr('required');

            /* Establece valor al input invisible cuando cambias de opcion al select */
            $("#cbxcarreras").change(function () {
                $("#cbxcarreras option:selected").each(function () {
                    ocupacion = $(this).val();
                    $("#ocupacion").val(ocupacion);
                });
            });
        } else if (this.value == 'no') {
            $('#carreras-container').hide();
            /*
            //Para que no muestre la opcion agregar ocupacion cuando se dice que NO
            $('#otros-container').show();

            $("#otra_ocupacion").attr('required', true);
            $("#cbxcarreras").removeAttr('required');

             Establece un valor al input invisible cuando cambias el valor del input otros 
            $("#otra_ocupacion").change(function () {
                ocupacion = $(this).val();
                $("#ocupacion").val(ocupacion);
            
            });*/
        }
    });
    
    //Validacion Tcelular
    $('#tcelular-valid').hide();
    $('#tcelular').change(function () {
        const tcelular = $('#tcelular').val();
        if(tcelular.length != 9) {
            $('#tcelular-valid').show();
        } else {
            $('#tcelular-valid').hide();
        }
    });
    
});
