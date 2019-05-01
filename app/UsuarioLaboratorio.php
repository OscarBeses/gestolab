<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioLaboratorio extends Model
{
    /**
     * Le indico el nombre de la tabla
     */
    protected $table = 'usuario_laboratorio';
    /**
     * Con esta propiedad le indico a laravel la PK
     */
    protected  $primaryKey = 'usl_id';
    /**
     * Propiedades que pueden ser rellenadas por el usuario
     */
    protected $fillable = [
        'usu_id', 
        'lab_id'
    ];

    /** Hay que poner este atributo a false para que no presuponga que tenemos fecha de creación y fecha de modificación */
    public $timestamps = false;

    /**
     *  Si se hace referencia a cliente como si fuera un atributo más
     *  de la clase, se podrá acceder a los atributos de este
     */
    public function usuario() {
        return $this->belongsTo(User::class, 'usu_id');
    }

    /**
     *  Si se hace referencia al laboratorio como si fuera un atributo más
     *  de la clase, se podrá acceder a los atributos de este
     */
    public function laboratorio() {
        return $this->belongsTo(Laboratorio::class, 'lab_id');
    }

    /**
     * Muestra el nº albaran y el cliente, ciudad, fecha_emision
     */
    public function __toString() {
        return "usuLab";
    }
}
