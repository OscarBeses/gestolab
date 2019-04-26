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
    /**
     * Propiedades que pueden ser rellenadas por el usuario
     */
    protected $fillable = [
        'prd_id',
        'prd_descripcion',
        'prd_importe',
        'prd_observaciones',
        'prd_borrado',
    ];
    /** Hay que poner este atributo a false para que no presuponga que tenemos fecha de creación y fecha de modificación */
    public $timestamps = false;

    public function __toString() {
        return $this->prd_descripcion . ' ' . $this->prd_observaciones .' '.$this->prd_importe;
    }

}
