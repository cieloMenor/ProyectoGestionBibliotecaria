$(document).ready(function () {
    $('#btnbuscar').click(function () {
        mostrarPrestamo();
        });
    // $('#btnbuscar').click(function () {
    //     document.getElementById("fecha").value = "";
    //     document.getElementById("estado").value = "";
    //     document.getElementById("fecha").value = "";
    //     document.getElementById("lector").value = "";
    //     document.getElementById("id_prestamo").value = "";
    //     });
});

function mostrarPrestamo(){
    datosCliente = document.getElementById('PrestamoID').value.split('_');
    $('#fecha').val(datosCliente[1]);
    $('#estado').val(datosCliente[2]);
    $('#lector').val(datosCliente[3]);
    $('#id_prestamo').val(datosCliente[0]);
    $('#fechaentrega').val(datosCliente[4]);
    
}
