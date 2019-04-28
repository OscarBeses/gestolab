<?php

class Helper {

    /**
     * Pasando el objeto y el atributo, 
     * devuelve, si tiene, el anterior valor, y sino, el de base de datos
     */
    public static function getDatoAnterior($obj, $atb) {
        
        $objOld = old($atb);
        if(isset($obj))
            $objBd = $obj->$atb;

        $respuesta = "";
        if (!empty($objOld)){
            $respuesta = $objOld;
        }elseif (isset($obj) && isset($objBd)){
            $respuesta = $objBd;
        }
        
        return $respuesta;
    }

}

?>