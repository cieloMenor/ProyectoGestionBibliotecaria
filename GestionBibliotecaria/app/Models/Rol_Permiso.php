<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol_Permiso extends Model
{
    use HasFactory;
    protected $table='rol_permiso';
    protected $primaryKey='Rol_permisoID';
    protected $fillable=['PermisoID','RolID'];
    public $timestamps=false;
}
