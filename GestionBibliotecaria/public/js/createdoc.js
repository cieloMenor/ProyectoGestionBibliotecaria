var cont = 0;
var total = 0;
var detalleprestamo = [];
var subtotal = [];
var controlproducto = [];
$(document).ready(function () {
    $('#LibroID').change(function () {
        mostrarLibro();
        });
        $('#LectorID').change(function () {
        mostrarLector();
        });
        $('#btnadddet').click(function () {
        agregarDetalle();
        });
        
});
function mostrarLibro() {
    datosCliente = document.getElementById('LibroID').value.split('_');
    $('#Stocklibro').val(datosCliente[1]);
    $('#Idioma').val(datosCliente[2]);
    /* cliente_id=$("#cliente_id").val();
    
    $.get('/EncontrarCliente/'+cliente_id, function(data){
    
    $('input[name=ruc]').val(data[0].ruc_dni);
    $('input[name=direccion]').val(data[0].direccion);
    
    });*/
}
function mostrarLector() {
    datosProducto = document.getElementById('LectorID').value.split('_');
    $('#Dni_lector').val(datosProducto[1]);
    $('#Correolector').val(datosProducto[2]);
    $('#Estadolector').val(datosProducto[3]);
    // idproducto = $("#idproducto").val();
    // $.get('/EncontrarProducto/' + idproducto, function (data) {
    // $('input[name=idproducto]').val(data[0].idproducto);
    // $('input[name=unidad]').val(data[1].unidad);
    // $('input[name=precio]').val(data[2].precio);
    // $('input[name=stock]').val(data[3].cantidad);
    // });
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
    ruc = $("#Dni_lector").val();
    if (ruc == '') {
        mostrarMensajeError("Por favor seleccione el Lector");
        return false;
    }
    tipo = $('#Tipo_prestamoID option:selected').text();
    if (tipo == '- Seleccione -') {
        mostrarMensajeError("Por favor seleccione el tipo de prestamo");
        return false;
    }

    descripcion = $('#LibroID option:selected').text();
    if (descripcion == '- Seleccione Libro -') {
        mostrarMensajeError("Por favor seleccione el Libro");
        return false;
    }

    let cantidadT=$("#Nrocopiasprestamo").val();
    let cantidad_producto = parseInt($("#Nrocopiasprestamo").val());
    let stock = parseInt($("#Stocklibro").val());
    if (cantidadT == '' || cantidadT == 0 || cantidad_producto == null) {
        mostrarMensajeError("Por favor ingrese cantidad del producto");
        return false;
    }
    else if (cantidad_producto <= 0) {
        mostrarMensajeError("Por favor debe escribir cantidad del lector mayor a 0 ");
        return false;
    }
    else if (cantidad_producto > stock) {
        mostrarMensajeError("No se tiene tal cantidad de libro solo hay " + stock);
        return false;
    }
    let fechaDevolucion = $("#Fechadevolucionesperadap").val();
    if (fechaDevolucion == '') {
        mostrarMensajeError("Por favor ingrese fecha de devolucion");
        return false;
    }
    let horaDevolucion = $("#Horadevolucionesperadap").val();
    if (horaDevolucion == '') {
        mostrarMensajeError("Por favor ingrese hora de devolucion");
        return false;
    }

    datosProducto = document.getElementById('LibroID').value.split('_');
    cod_producto = datosProducto[0];
    //cod_producto = $("#idproducto").val();
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
        mostrarMensajeError("No puede volver a prestar el mismo libro");
        return false;
    }
    else { 
        stock = $("#Stocklibro").val();
        subtotal[cont] = cantidad_producto;
        controlproducto[cont] = cod_producto;
        total = total + subtotal[cont];
        var fila = '<tr class="selected" id="fila' + cont + '">'+
        '<td style="text-align:center;"><button type="button" class="btn btn-danger btn-xs" onclick="eliminardetalle(' + cod_producto + ',' + cont + ');"><i class="fa fa-times" ></i></button></td>'+
        '<td style="text-align:right;"><input type="text" name="cod_producto[]" value="' + cod_producto + '" readonly="readonly" style="width:50px; text-align:right;"></td>'+
        '<td><input type="text" name="descripcion[]" value="' + descripcion + '" readonly="readonly" style="width:100%; text-align:center;"></td><td><input type="number" name="stock[]" value="' + stock + '" readonly="readonly" style="width:140px; text-align:left;"></td>'+
        '<td style="text-align:center;"><input type="number" name="cantidad_producto[]" value="' + cantidad_producto + '" style="width:50px; text-align:right;"></td>'+
        +'</tr>';
        $('#detalles').append(fila);
        detalleprestamo.push({
            cod_producto: cod_producto,
            stock: stock,
            cantidad_producto: cantidad_producto,
            descripcion : descripcion
        });
        cont++;
    }
    $('#total').val(total);
    limpiar();
}
function limpiar() { 
    $("#Nrocopiasprestamo").val('1');
    $("#LibroID").val("0").change(); 
}
    /* Eliminar productos */
function eliminardetalle(codigo, index) {
    total = total - subtotal[index];
    tam = detalleprestamo.length;
    var i = 0;
    var pos;
    while (i < tam) {
        if (detalleprestamo[i].codigo == codigo) {
            pos = i;
            break;
        }
        i = i + 1;
    }
    detalleprestamo.splice(pos, 1);
    $('#fila' + index).remove();
    controlproducto[index] = "";
    $('#total').val(total);
}
        