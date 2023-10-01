<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMulta extends Model
{
    use HasFactory;
    protected $table='multa';
    protected $primaryKey='MultaID';
    protected $fillable=['Descripcionmulta','Estadomultahab',
    'Fecharegistromulta','Fechaupdatemulta','Porcentajemulta','UsuarioID'];
    public $timestamps=false;

    public function users()
    {
        return $this->hasOne(User::class,'UsuarioID','UsuarioID');
    }
    
}
