<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;
    protected $table='autor';
    protected $primaryKey='AutorID';
    protected $fillable=['Nombresautor','Apellidosautor'];
    public $timestamps=false;
}
