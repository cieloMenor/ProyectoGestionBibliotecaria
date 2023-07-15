<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registroPedido extends Model
{
    use HasFactory;
    protected $table='Pedido';
    protected $primaryKey='PedidoID';
    public $timestamps=false;
    protected $fillable=['Fecha','BibliotecarioID','ProveedorID'];
}
