<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /** 
     * Le indico el nombre de la tabla,
     * podría detectarlo automaticamente si la tabla
     * se llamara clientes
     */
    protected $table = 'cliente';
    /**
     * Con esta propiedad le indico a laravel
     * que mi PK no es id sino cli_id
     */
    protected  $primaryKey = 'cli_id';
    /**
     * Propiedades que pueden ser rellenadas por el usuario
     */
    protected $fillable = [
        'cli_id', 
        'cli_nif', 
        'cli_nombre', 
        'cli_nombre_corto', 
        'cli_cod_pos', 
        'cli_ciudad', 
        'cli_municipio', 
        'cli_direccion'
    ];
    /** Hay que poner este atributo a false para que no presuponga que tenemos fecha de creación y fecha de modificación */
    public $timestamps = false;

    public function __toString() {
        return $this->cli_nombre . ' ' . $this->cli_nif;
    }
}
