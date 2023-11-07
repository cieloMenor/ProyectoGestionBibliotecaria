<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoLector extends Model
{
    use HasFactory;
    protected $table='estado_lector';
    protected $primaryKey='Estado_lectorID';
    protected $fillable=['Estadolector'];
    public $timestamps=false;

}
