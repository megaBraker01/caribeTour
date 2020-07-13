<?php


/**
 * pasar todos estos metodos a Util o a su correspondiente controller
 */
class UtilController extends BaseController {
    
    const _TEXT = 'text';
    const _INT = 'int';
    const _DOUBLE = 'double';
    const LIST_DATA = "data";
    const AJAX_PATH = "json-data-list/";

 
    /**
     * 
     * @param string $sql
     * @param array $filtros
     * @param array $ordenados
     * @param array $limitar
     * @param array $agrupar
     * @return array
     */
    public function query(string $sql, array $filtros = [], array $ordenados = [], array $limitar = [], array $agrupar = []): array
    {
        return parent::query($sql, $filtros, $ordenados, $limitar, $agrupar);
    }
  
    
    /**
     * TODO: crear clase Modelo/Lister que contenga esta logica
     * @param array $thList
     * @return string
     */
    public function renderThForLister($thList = [])
    {
        $ret = "";
        foreach($thList as $th){
            $ret .= "<th>$th</th>";
        }
        $ret .= "<th></th>";
        return $ret;
    }
    
    /**
     * TODO: pasar este metodo al modelo o al controlador de Base
     * Combierte una lista de objetos a formato json, la lista
     * estará compuesta por los parametros pasados en $paramList
     * @param array $objList
     * @param array $paramList
     * @return string json
     */
    public static function objListToJsonList($objList = [], $paramList = [])
    {
        $data = [];
        foreach ($objList as $obj){
            $objRecord = [];
            foreach($paramList as $param){
                $getMethod = "get".ucfirst($param);
                $value = method_exists($obj, $getMethod) ? $obj->$getMethod() : null;
                $objRecord[$param] = is_object($value) ? $value->__toString() : $value;
            }    
            $data[self::LIST_DATA][] = $objRecord;
        }

        return json_encode($data);
    }
    
    /**
     * TODO: meter en Modelo/Form y quitar el acoplamiento con ImgHandler
     * @param ModelBase $obj
     * @return \ModelBase
     */
    public function setObjFromPost(ModelBase $obj)
    {
        $obj->setAllParams($_POST);
        if(isset($_FILES['imagen'])){
            $imgHandler = new ImgHandler($_FILES['imagen']);
            $nombreImagenFinal = $imgHandler->uploadImageIfExist($obj->getSlug());
            if(!is_null($nombreImagenFinal)){
                $obj->setImagen($nombreImagenFinal);
            }
        }
               
        return $obj;
    }
}
