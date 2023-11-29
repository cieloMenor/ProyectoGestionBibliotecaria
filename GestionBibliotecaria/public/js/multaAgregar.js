$(document).ready(function () {

    $('#MultaID').click(function () {
        mostrarMulta();
        });
});

function mostrarMulta() {
    datosCliente = document.getElementById('MultaID').value.split('_');
    $('#idMulta').val(datosCliente[0]);
    $('#Porcentajemulta').val(datosCliente[1]);


}