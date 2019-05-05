<?php

namespace App;

use App\Trabajo;
use Illuminate\Database\Eloquent\Model;

class TecnicoTrabajo extends Model
{
    /** 
     * Le indico el nombre de la tabla
     */
    protected $table = 'tecnico_trabajo';
    /**
     * Con esta propiedad le indico a laravel
     * que mi PK no es id sino trd_id
     */
    protected  $primaryKey = 'tet_id';
    /**
     * Propiedades que pueden ser rellenadas por el usuario
     */
    protected $fillable = [
        'tet_id',
        'tec_id',
        'tra_id',
    ];
    /** Hay que poner este atributo a false para que no presuponga que tenemos fecha de creación y fecha de modificación */
    public $timestamps = false;

    // public function tecnico() {
    //     return $this->belongsTo(Tecnico::class, 'tec_id');
    // }

    public function trabajo() {
        return $this->belongsTo(Trabajo::class, 'tra_id');
    }

    public function __toString() {
        return "por hacer toString"; //$this->trd_odontologo . ' ' . $this->trd_paciente .' '.$this->tra_id;
    }
}
