<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Albaran extends Model
{
    /**
     * Le indico el nombre de la tabla (sino busca 'albaranes' en la BD)
     */
    protected $table = 'albaran';
    /**
     * Con esta propiedad le indico a laravel
     * que mi PK no es id sino alb_id
     */
    protected  $primaryKey = 'alb_id';
    /**
     * Propiedades que pueden ser rellenadas por el usuario
     */
    protected $fillable = [
        'alb_id', 
        'alb_numero', 
        'cli_id', 
        'lab_id',
        'alb_fecha_emision', 
        'alb_fecha_entrega',
        'fac_id'
    ];
    /** Hay que poner este atributo a false para que no presuponga que tenemos fecha de creación y fecha de modificación */
    public $timestamps = false;

    /**
     *  Si se hace referencia a cliente como si fuera un atributo más
     *  de la clase, se podrá acceder a los atributos de este
     */
    public function cliente() {
        return $this->belongsTo(Cliente::class, 'cli_id');
    }

    /**
     *  Si se hace referencia al laboratorio como si fuera un atributo más
     *  de la clase, se podrá acceder a los atributos de este
     */
    public function laboratorio() {
        return $this->belongsTo(Laboratorio::class, 'lab_id');
    }

    /**
     *  Si se hace referencia a la factura como si fuera un atributo más
     *  de la clase, se podrá acceder a los atributos de esta (puede ser null)
     */
    public function factura() {
        return $this->belongsTo(Factura::class, 'fac_id');
    }

    /**
     * Un albarán está compuesto por varios trabajos
     */
    public function trabajos() {
        return $this->hasMany(Trabajo::class, 'alb_id');
    }

    public function __toString() {
        return $this->alb_numero . ' Cliente:' . $this->cliente->cli_nombre_corto .' '.$this->cli_ciudad .' '.$this->alb_fecha_emision;
    }
}
