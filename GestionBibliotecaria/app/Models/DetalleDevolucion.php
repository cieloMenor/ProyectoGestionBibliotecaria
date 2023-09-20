<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleDevolucion extends Model
{
    use HasFactory;
    protected $table = 'devolucion_detalle'; 
    protected $primaryKey='Devolucion_detalleID';
    public $timestamps = false;
    protected $fillable = ['Estadodevolucion','Fechadevolucionlibro','Nrocopiasdevolucion',
    'DevolucionID','LibroID','NroLibrosFaltaDevoD'];


    public function libros()
    {
        return $this->hasOne(Libroo::class,'LibroID','LibroID');
    }
    public function devoluciones()
    {
        return $this->hasOne(Devolucion::class,'DevolucionID','DevolucionID');
    }
}
