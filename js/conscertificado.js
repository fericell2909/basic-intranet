$(document).ready(function () {
    // Select 2
    $('.select-cliente').select2({
        language: "es",
        placeholder: "Especifique un cliente",
        allowClear: true,
        width: 'resolve'
    });

    $("#cbx_cliente").change(function () {
        $("#cbx_cliente option:selected").each(function () {
            cliente_id = $(this).val();
            $('#consulta5-container').load('modulos/consultas/consulta5.php?idCliente=' + cliente_id);
        });
    });
});