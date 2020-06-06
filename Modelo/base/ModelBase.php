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

    /**
     * TODO: Pasar al generator
     * Setea los parametros de una clase mediante sus metodos setters
     * ej: ['nombre' => 'juan', 'telefono' => 987987987]
     * @param array $paramList
     * @return $this
     */
    public function setAllParams(array $paramList){
        if(!empty($paramList)){
            $methods = $this->getAllMethods();
            foreach($paramList as $param => $value){
                if(property_exists($this, $param)){
                    $method = "set" . ucfirst($param);
                    if(in_array($method, $methods)){
                       $this->$method(trim($value)); 
                    }
                }
            }
        }
        return $this;
    }
    
    /**
     * TODO: meter este metodo en el generator
     * Obtiene todos los meltodos publicos de la clase actual
     * @return array
     */
    public function getAllMethods(){
        return get_class_methods($this);
    }

}