<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;
    protected $table='permiso';
    protected $primaryKey='PermisoID';
    protected $fillable=['Estadopermiso','Permiso'];
    public $timestamps=false;

}
