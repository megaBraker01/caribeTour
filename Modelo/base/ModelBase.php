<?php

abstract class ModelBase {

    /*
    * @return array indexado con los nombre de todas las propiedades de la clase
    */
    public function getAllParams($excludeFK = false, $justKeys = true): array {
        $ret = get_object_vars($this);        
        if($justKeys){ $ret = array_keys($ret); }
        
        if($excludeFK){ $ret = array_slice($ret, 1); }
        
        return $ret;
    }

    /*
    * Retorna un objeto en formato json de la clase   
    * @return string 
    */
    public function toJson(): string {
        return json_encode($this->getAllParams(false, false));
    }

    /*
    * @param array asociativo propiedadClase => valor $paramList
    * ej: ['nombre' => 'juan', 'telefono' => 987987987]
    */
    public function setAllParams(array $paramList){
        if(!empty($paramList)){
            foreach($paramList as $param => $value){
                if(property_exists($this, $param)){
                    //$this->$param = $value;
                    $method = "set" . ucfirst($param);
                    $this->$method($value);
                }
            }
        }
        return $this;
    }

}