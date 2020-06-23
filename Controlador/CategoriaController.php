<?php

class CategoriaController extends CategoriaBaseController { 

    /**
     * 
     * @param int $idCategoria
     * @return Categoria $categoria
     * @throws Exception
     */
    public function getCategoriaById(int $idCategoria)
    {
        if(!is_int($idCategoria) or $idCategoria < 1){
            throw new Exception('[ERROR] El idProducto tiene que ser un entero mayor a cero (0)');
        }

        $filtros = [['idCategoria', $idCategoria]];
        $categoria = @$this->select($filtros)[0] ?? new Categoria;
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
        $filtros = [['slug', $slug]];
        $categoria = @$this->select($filtros)[0] ?? new Categoria;
        return $categoria;
    }
}