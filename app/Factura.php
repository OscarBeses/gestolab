<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    /**
     * Le indico el nombre de la tabla (sino busca 'facturas' en la BD)
     */
    protected $table = 'factura';
    /**
     * Con esta propiedad le indico a laravel
     * que mi PK no es id sino fac_id
     */
    protected  $primaryKey = 'fac_id';
    /**
     * Propiedades que pueden ser rellenadas por el usuario
     */
    protected $fillable = [
        'fac_id',
	    'fac_numero',
        'fac_fecha_emision'
    ];
    /**
     * Con esto indico los campos que son fechas (instancias de Carbon)
     */
    protected $dates = ['fac_fecha_emision'];
    /** Hay que poner este atributo a false para que no presuponga que tenemos fecha de creación y fecha de modificación */
    public $timestamps = false;

    public function albaranes() {
        return $this->hasMany(Albaran::class, 'fac_id');
    }

    /**
     * Devuelve la suma de los importes de todos los albaranes
     */
    public function dameTotal() {
        $total = 0;
        foreach ($this->albaranes as $albaran) {
            $total += $albaran->dameTotal();
        }
        return $total;
    }

    public function __toString() {
        return $this->fac_numero . ' ' . $this->fac_fecha_emision;
    }

}
