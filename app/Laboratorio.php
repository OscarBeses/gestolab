<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    /**
     * Le indico el nombre de la tabla (sino busca 'laboratorios' en la BD)
     */
    protected $table = 'laboratorio';
    /**
     * Con esta propiedad le indico a laravel
     * que mi PK no es id sino lab_id
     */
    protected  $primaryKey = 'lab_id';
    /**
     * Propiedades que pueden ser rellenadas por el usuario
     */
    protected $fillable = [
        'lab_id',
        'lab_nif',
        'lab_nombre',
        'lab_nombre_corto',
        'lab_cod_pos',
        'lab_ciudad',
        'lab_municipio',
        'lab_direccion',
    ];
    /** Hay que poner este atributo a false para que no presuponga que tenemos fecha de creación y fecha de modificación */
    public $timestamps = false;

    public function __toString() {
        return $this->lab_nombre . ' ' . $this->lab_direccion .' '.$this->lab_ciudad .'-'.$this->lab_cod_pos .' '. $this->lab_nif;
    }

}
