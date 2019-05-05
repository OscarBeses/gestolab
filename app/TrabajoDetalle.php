<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrabajoDetalle extends Model
{
    /** 
     * Le indico el nombre de la tabla,
     * podría detectarlo automaticamente si la tabla
     * se llamara trabajoDetalles
     */
    protected $table = 'trabajo_detalle';
    /**
     * Con esta propiedad le indico a laravel
     * que mi PK no es id sino trd_id
     */
    protected  $primaryKey = 'trd_id';
    /**
     * Propiedades que pueden ser rellenadas por el usuario
     */
    protected $fillable = [
        'trd_odontologo',
        'trd_paciente',
        'tra_id',
    ];
    /** Hay que poner este atributo a false para que no presuponga que tenemos fecha de creación y fecha de modificación */
    public $timestamps = false;

    public function __toString() {
        return $this->trd_odontologo . ' ' . $this->trd_paciente .' '.$this->tra_id;
    }
}
