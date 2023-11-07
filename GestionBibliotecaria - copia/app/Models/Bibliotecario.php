<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bibliotecario extends Model
{
    use HasFactory;
    protected $table='Bibliotecario';
    protected $primaryKey='BibliotecarioID';
    public $timestamps=false;
    protected $fillable=['Correoelectronico','Direccion','Dni','Nombre','Telefono'];
}
