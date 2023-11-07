<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoLibro extends Model
{
    use HasFactory;
    protected $table='estado_libro';
    protected $primaryKey='Estado_libroID';
    protected $fillable=['Estadolibro'];
    public $timestamps=false;
}
