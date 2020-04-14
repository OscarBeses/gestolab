<?php

use Illuminate\Support\Carbon;

class Helper {

    /**
     * Pasando el objeto y el atributo, 
     * devuelve, si tiene, el anterior valor, y sino, el de base de datos
     */
    public static function getDatoAnterior($obj, $atrib) {
        
        $atribOld = old($atrib);
        $atrib = Helper::corrigeAtributo($atrib);
        if (isset($obj))
            $atribBd = $obj->$atrib;

        $respuesta = "";
        if (!empty($atribOld)) {
            $respuesta = $atribOld;
        } elseif (isset($obj) && isset($atribBd)){
            $respuesta = $atribBd;
        }
        
        if ($respuesta instanceof Carbon) {
            // Este formato es el que acepta el input date
            $respuesta = $respuesta->format('Y-m-d');
        }

        return $respuesta;
    }

    // El name del campo es tal cual pero yo quiero devolver al html el objeto entero
    private static function corrigeAtributo($atb) {
        switch ($atb) {
            case 'lab_id':
                return 'laboratorio';
            case 'cli_id':
                return 'cliente';
            case 'prd_id':
                return 'producto';
            default:
                return $atb;
        }
    }

}

?>