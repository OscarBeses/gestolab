<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Albaran extends Model
{
    /**
     * Le indico el nombre de la tabla
     */
    protected $table = 'albaran';
    /**
     * Con esta propiedad le indico a laravel
     * que mi PK no es id sino alb_id
     */
    protected  $primaryKey = 'alb_id';
    protected $fillable = [
        'alb_id', 
        'alb_numero', 
        'cli_id', 
        'lab_id',
        'alb_fecha_emision', 
        'alb_fecha_entrega',
        'fac_id'
    ];

}
