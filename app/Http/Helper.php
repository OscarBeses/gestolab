<?php

use Illuminate\Support\Carbon;

class Helper {

    /**
     * Pasando el objeto y el atributo, 
     * devuelve, si tiene, el anterior valor, y sino, el de base de datos
     */
    public static function getDatoAnterior($obj, $atb) {
        
        $objOld = old($atb);
        $atb = Helper::corrigeAtributo($atb);
        if(isset($obj))
            $objBd = $obj->$atb;

        $respuesta = "";
        if (!empty($objOld)){
            $respuesta = $objOld;
        }elseif (isset($obj) && isset($objBd)){
            $respuesta = $objBd;
        }
        
        if($respuesta instanceof Carbon) {
            // Este formato es el que acepta el input date
            $respuesta = $respuesta->format('Y-m-d');
        }

        return $respuesta;
    }

    private static function corrigeAtributo($atb) {
        switch ($atb) {
            case 'lab_id':
                return 'laboratorio';
            case 'cli_id':
                return 'cliente';
            default:
                return $atb;
        }
    }

}

?>