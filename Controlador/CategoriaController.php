<?php

class CategoriaController extends CategoriaBaseController { 

    /**
     * 
     * @param int $idCategoria
     * @return type
     * @throws Exception
     */
    public function getCategoriaById(int $idCategoria)
    {
        if(!is_int($idCategoria) or $idCategoria < 1){
            throw new Exception('[ERROR] El idProducto tiene que ser un entero mayor a cero (0)');
        }
        $categoria = null;
        $categoriaC = new CategoriaController;
        $filtros = [['idCategoria', $idCategoria]];
        $categoriaList = $categoriaC->select($filtros);
        if(isset($categoriaList[0])){
            $categoria = $categoriaList[0];
        }
        return $categoria;
    }
    
    /**
     * 
     * @param string $slug
     * @return type
     * @throws Exception
     */
    public function getCategoriaBySlug(string $slug)
    {
        if(!is_string($slug) or "" == $slug){
            throw new Exception('[ERROR] El slug tiene que ser un string distinto de ""');
        }
        $slug = strtolower($slug);
        $categoria = null;
        $categoriaC = new CategoriaController;
        $filtros = [['slug', $slug]];
        $categoriaList = $categoriaC->select($filtros);
        if(isset($categoriaList[0])){
            $categoria = $categoriaList[0];
        }
        return $categoria;
    }
}