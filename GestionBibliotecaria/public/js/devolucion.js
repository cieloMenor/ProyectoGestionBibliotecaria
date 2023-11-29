var cont = 0;
var total = 0;
var detalledevolucion = [];
var subtotal = [];
var controlproducto = [];

$(document).ready(function () {
    $('#btnbuscar').click(function () {
        mostrarPrestamo();
        });
    $('#LibroID').click(function () {
        mostrarLibro();
        });
    $('#btnadddet').click(function () {
        agregarDetalle();
        });
});

function mostrarPrestamo(){
    datosCliente = document.getElementById('PrestamoID').value.split('_');
    
    $('#id_prestamo').val(datosCliente[0]);
    $('#fechadevolucion').val(datosCliente[1]);
    $('#estado').val(datosCliente[3]);
    $('#tipo').val(datosCliente[2]);
    $('#lector').val(datosCliente[4]);
}

function mostrarLibro() {
    datosCliente = document.getElementById('LibroID').value.split('_');
    $('#Nrocopiasprestamo').val(datosCliente[3]);
    $('#Idioma').val(datosCliente[2]);
    $('#NroLibrosFaltaDevo').val(datosCliente[4]);
}

/* Mostrar Mensajes de Error */
function mostrarMensajeError(mensaje) {
    $(".alert").css('display', 'block');
    $(".alert").removeClass("hidden");
    $(".alert").addClass("alert-danger");
    $(".alert").html("<button type='button' class='close' dataclose='alert'>×</button>" + "<span><b>Error!</b> " + mensaje + ".</span>");
    $('.alert').delay(5000).hide(400);
}

function agregarDetalle() {

    tipo = $("#tipo").val();
    if (tipo == '') {
        mostrarMensajeError("Por favor seleccione el Prestamo");
        return false;
    }

    descripcion = $('#LibroID option:selected').text();
    if (descripcion == '- Seleccione libro -') {
        mostrarMensajeError("Por favor seleccione el Libro a devolver");
        return false;
    }

    let cantidadT=$("#Nrocopiasdevolucion").val();
    let cantidad_producto = parseInt($("#Nrocopiasdevolucion").val());
    let stock = parseInt($("#NroLibrosFaltaDevo").val());
    
    if (cantidadT == '' || cantidadT == 0 || cantidad_producto == null) {
        mostrarMensajeError("Por favor ingrese cantidad a devolver");
        return false;
    }
    else if (cantidad_producto <= 0) {
        mostrarMensajeError("Por favor debe escribir cantidad de libro a devolver mayor a 0 ");
        return false;
    }
    else if (cantidad_producto > stock) {
        mostrarMensajeError("No se tiene tal cantidad, solo hay " + stock + " libros por devolver");
        return false;
    }
    let fechadetalle = $("#fecha_detalle").val();
    if (fechadetalle == '') {
        mostrarMensajeError("Por favor ingrese fecha de devolucion del libro seleccionado");
        return false;
    }

    let Fechainiciodevolucion = $("#Fechainiciodevolucion").val();
    if (Fechainiciodevolucion == '') {
        mostrarMensajeError("Por favor ingrese fecha de inicio de devolucion");
        return false;
    }

    
    datosProducto = document.getElementById('LibroID').value.split('_');
    cod_producto = datosProducto[0];
     /* Buscar que codigo de producto no se repita */
    var i = 0;
    var band = false;
    while (i < cont) {
        if (controlproducto[i] == cod_producto) {
            band = true;
        }
        i = i + 1;
    }
    if (band == true) {
        mostrarMensajeError("No puede devolver el mismo libro");
        return false;
    }
    else { 
        stock = $("#NroLibrosFaltaDevo").val();
        fecha_detalle=$('#fecha_detalle').val();
        subtotal[cont] = cantidad_producto;
        controlproducto[cont] = cod_producto;
        total = total + subtotal[cont];
        var fila = '<tr class="selected" id="fila' + cont + '">'+
        '<td style="text-align:center;"><button type="button" class="btn btn-danger btn-xs" onclick="eliminardetalle(' + cod_producto + ',' + cont + ');"><i class="fa fa-times" ></i></button></td>'+
        '<td style="text-align:right;"><input type="text" name="cod_producto[]" value="' + cod_producto + '" readonly="readonly" style="width:50px; text-align:right;"></td>'+
        '<td><input type="text" name="descripcion[]" value="' + descripcion + '" readonly="readonly" style="width:100%; text-align:center;"></td><td><input type="number" name="stock[]" value="' + stock + '" readonly="readonly" style="width:140px; text-align:left;"></td>'+
        '<td style="text-align:center;"><input type="datetime" name="fecha_detalle[]" value="' + fecha_detalle + '" style="width:100%; text-align:right;"></td>'+
        '<td style="text-align:center;"><input type="number" name="cantidad_producto[]" value="' + cantidad_producto + '" style="width:100px; text-align:right;"></td>'+
        +'</tr>';
        $('#detalles').append(fila);
        detalledevolucion.push({
            cod_producto: cod_producto,
            stock: stock,
            cantidad_producto: cantidad_producto,
            fecha_detalle: fecha_detalle,
            descripcion : descripcion
        });
        cont++;


    }
    $('#total').val(total);
    limpiar();
}
function limpiar() { 
    $("#Nrocopiasdevolucion").val('1');
    $("#LibroID").val("0").change();
    $("#Nrocopiasprestamo").val("").change();
    $("#NroLibrosFaltaDevo").val("").change();
    $("#Idioma").val("").change();

}
    /* Eliminar productos */
function eliminardetalle(codigo, index) {
    total = total - subtotal[index];
    tam = detalledevolucion.length;
    var i = 0;
    var pos;
    while (i < tam) {
        if (detalledevolucion[i].codigo == codigo) {
            pos = i;
            break;
        }
        i = i + 1;
    }
    detalledevolucion.splice(pos, 1);
    $('#fila' + index).remove();
    controlproducto[index] = "";
    $('#total').val(total);
}
