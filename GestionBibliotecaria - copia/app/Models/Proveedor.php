<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table='Proveedor';
    protected $primaryKey='ProveedorID';
    public $timestamps=false;
    protected $fillable=['Correoelectronico','Direccion','Empresa','Telefono'];
}
