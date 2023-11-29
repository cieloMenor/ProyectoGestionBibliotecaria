<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multa extends Model
{
    use HasFactory;
    protected $table='multa_lector';
    protected $primaryKey='Multa_lectorID';
    protected $fillable=['MontoMultaLector','FechamultaLector',
    'Estadohabmultalector','DevolucionID','Estado_multa_lectorID','MultaID','ServicioID'];
    public $timestamps=false;

    public function devoluciones()
    {
        return $this->hasOne(Devolucion::class,'DevolucionID','DevolucionID');
    }

    public function tiposmulta()
    {
        return $this->hasOne(TipoMulta::class,'MultaID','MultaID');
    }

    public function estadosmulta()
    {
        return $this->hasOne(EstadoMultaLector::class,'Estado_multa_lectorID','Estado_multa_lectorID');
    }

    public function servicios()
    {
        return $this->hasOne(Servicio::class,'ServicioID','ServicioID');
    }

}
