<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;
    protected $table='Libro';
    protected $primaryKey='LibroId';
    public $timestamps=false;
    protected $fillable=['Titulo','Stock','Precio','Paginas','Isbn','Idioma','Editorial','Añopublicacion','Estado_libroID'];
}
