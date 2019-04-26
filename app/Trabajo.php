<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    /**
     * Le indico el nombre de la tabla (sino busca 'trabajos' en la BD)
     */
    protected $table = 'trabajo';
    /**
     * Con esta propiedad le indico a laravel
     * que mi PK no es id sino tra_id
     */
    protected  $primaryKey = 'tra_id';
    /**
     * Propiedades que pueden ser rellenadas por el usuario
     */
    protected $fillable = [
        'tra_id',
        'tra_descripcion',
        'tra_cantidad',
        'tra_precio_unidad',
        'prd_id',
        'alb_id'
    ];
    /** Hay que poner este atributo a false para que no presuponga que tenemos fecha de creación y fecha de modificación */
    public $timestamps = false;

    public function producto() {
        return $this->belongsTo(Producto::class, 'prd_id');
    }

    public function albaran() {
        return $this->belongsTo(Albaran::class, 'alb_id');
    }

    public function __toString() {
        return $this->producto . ' Cantidad' . $this->tra_cantidad .' Precio/unidad: '.$this->tra_precio_unidad;
    }

}
