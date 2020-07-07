<?php

abstract class ModelBase {

    /*
     * @return int pk de la tabla
     */
    public function getId(){
        $params = $this->getAllParams();
        return $params[0];
    }   

    /*
     * Obtiene todos los meltodos publicos de la clase actual   
     * @return array 
     */
    public function getAllMethods(){
        return get_class_methods($this);
    }

    /**
     * Obtiene un array indexado con los nombre de todas las propiedades de la clase
     * @param bool $excludeFK
     * @param bool $justKeys
     * @return array
     */
    public function getAllParams(bool $excludeFK = false, bool $justKeys = true): array {
        $ret = get_object_vars($this);        
        if($justKeys){ $ret = array_keys($ret); }
        
        if($excludeFK){ $ret = array_slice($ret, 1); }
        
        return $ret;
    }

    /**
     * Retorna un objeto en formato json de la clase   
     * @return string 
     */
    public function toJson(): string {
        return json_encode($this->getAllParams(false, false));
    }

    /**
     *   
     * @param type $cadena
     * @param type $separador
     * @return string
     */
    public function slugify($cadena, $separador = '-')
    {
        setlocale(LC_ALL, 'en_US.UTF8');
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $cadena);
        $slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
        $slug = preg_replace("/[\/_|+ -]+/", $separador, $slug);
        $slug = strtolower(trim($slug, $separador));

        return !empty($slug) ? $slug : "n{$separador}a";
    }

    /**
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

}