<?php

class Util extends BaseController {
    
    public function getProductoFechaRefPDO(array $filtros = [], array $ordenados = [], array $limitar = [], array $agrupar = []): array
    {
        $sql = "SELECT *, MIN(precioProveedor) AS precioMinimo FROM v_producto_fecha_ref";
        return $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
    }
    
    public function getProductoById(int $idProducto)
    {
        if(!is_int($idProducto) or $idProducto < 1){
            throw new Exception('[ERROR] El idProducto tiene que ser un entero mayor a cero (0)');
        }
        $producto = null;
        $productoC = new ProductoController;
        $filtros = [['idProducto', '=', $idProducto]];
        $productoList = $productoC->select($filtros);
        if(isset($productoList[0])){
            $producto = $productoList[0];
        }
        return $producto;
    }
    
    public function getProductoBySlug(string $slug)
    {
        if(!is_string($slug) or "" == $slug){
            throw new Exception('[ERROR] El slug tiene que ser un string distinto de ""');
        }
        $producto = null;
        $productoC = new ProductoController;
        $filtros = [['slug', '=', $slug]];
        $productoList = $productoC->select($filtros);
        if(isset($productoList[0])){
            $producto = $productoList[0];
        }
        return $producto;
    }
    
    public function getCategoriaById(int $idCategoria)
    {
        if(!is_int($idCategoria) or $idCategoria < 1){
            throw new Exception('[ERROR] El idProducto tiene que ser un entero mayor a cero (0)');
        }
        $categoria = null;
        $categoriaC = new CategoriaController;
        $filtros = [['idCategoria', '=', $idCategoria]];
        $categoriaList = $categoriaC->select($filtros);
        if(isset($categoriaList[0])){
            $categoria = $categoriaList[0];
        }
        return $categoria;
    }
    
    public function getCategoriaBySlug(string $slug)
    {
        if(!is_string($slug) or "" == $slug){
            throw new Exception('[ERROR] El slug tiene que ser un string distinto de ""');
        }
        $categoria = null;
        $categoriaC = new CategoriaController;
        $filtros = [['slug', '=', $slug]];
        $categoriaList = $categoriaC->select($filtros);
        if(isset($categoriaList[0])){
            $categoria = $categoriaList[0];
        }
        return $categoria;
    }
}
