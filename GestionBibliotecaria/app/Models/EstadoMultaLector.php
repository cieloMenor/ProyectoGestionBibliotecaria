<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoMultaLector extends Model
{
    use HasFactory;
    protected $table='estado_multa_lector';
    protected $primaryKey='Estado_multa_lectorID';
    protected $fillable=['Estadomultalector'];
    public $timestamps=false;
}
