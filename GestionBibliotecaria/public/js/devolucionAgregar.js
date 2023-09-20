$(document).ready(function () {

    $('#LibroID').click(function () {
        mostrarLibro();
        });
});

function mostrarLibro() {
    datosCliente = document.getElementById('LibroID').value.split('_');
    $('#Nrocopiasprestamo').val(datosCliente[3]);
    $('#Idioma').val(datosCliente[2]);
    $('#NroLibrosFaltaDevo').val(datosCliente[4]);
    $('#idLibro').val(datosCliente[0]);


}