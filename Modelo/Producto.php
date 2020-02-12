<?php

class Producto extends ProductoBase {
    
    public function getImagenes(){
        $ImagenController = new ImagenController();
        $idProducto = $this->getIdproducto();
        $ImagenList = $ImagenController->select([['idProducto', '=', $idProducto]]);
        return $ImagenList;
    }
    
}