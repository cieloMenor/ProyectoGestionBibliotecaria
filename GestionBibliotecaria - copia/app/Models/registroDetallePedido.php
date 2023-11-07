<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registroDetallePedido extends Model
{
    use HasFactory;
    protected $table='Detalle_pedido';
    protected $primaryKey='Detalle_pedidoID';
    public $timestamps=false;
    protected $fillable=['Cantidad','PedidoID','LibroID'];
}
