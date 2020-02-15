<?php

class Producto extends ProductoBase {
    
    public function getImagenes()
    {
        $ImagenController = new ImagenController();
        $idProducto = $this->getIdproducto();
        $ImagenList = $ImagenController->select([['idProducto', '=', $idProducto]]);
        return $ImagenList;
    }
    
    public function getProductoFechaRef(array $filtros = [], array $ordenados = [], array $limitar = [], array $agrupar = [])
    {
        $idProducto = $this->getIdproducto();
        $filtros[] = ['idProducto', '=', $idProducto];
        $util = new Util();
        return $util->getProductoFechaRefPDO($filtros, $ordenados, $limitar, $agrupar);
    }
    
}