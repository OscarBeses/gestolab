<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /**
     * Le indico el nombre de la tabla
     */
    protected $table = 'producto';
    /**
     * Con esta propiedad le indico a laravel
     * que mi PK no es id sino prd_id
     */
    protected  $primaryKey = 'prd_id';
    protected $fillable = [
        'prd_id',
        'prd_descripcion',
        'prd_importe',
        'prd_observaciones',
        'prd_borrado',
    ];

}
