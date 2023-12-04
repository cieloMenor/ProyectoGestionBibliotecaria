<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprobanteTienda extends Model
{
    use HasFactory;
    protected $table='comprobante_tienda';
    protected $primaryKey='idcomprobante';
    protected $fillable=['idcliente','monto','libroID',
    'fecha'];
    public $timestamps=false;

    public function clientes()
    {
        return $this->hasOne(User::class,'UsuarioID','idcliente');
    }

    public function libros()
    {
        return $this->hasOne(Libro::class,'libroID','libroID');
    }
}
