<?php

class Producto extends ProductoBase {
    
    /**
     * Obtiene todas las imagenes del producto actual
     * @return array
     */
    public function getImagenes(): array
    {
        $ImagenController = new ImagenController();
        $idProducto = $this->getIdproducto();
        $ImagenList = $ImagenController->select([['idProducto', $idProducto]]);
        return $ImagenList;
    }

    /**
     * Obtiene el precion mas bajo disponible del producto actual
     * @param bool $sumaComicion
     * @return type
     */
    public function getPrecioMasBajo(bool $sumaComicion = true)
    {
        $ret = 0;
        $idProducto = $this->getIdproducto();       
        $filtros = [
            ['idProducto', $idProducto],
            ['fsalida', date('Y-m-d'), '>=']
        ];
        $ordenados = [['precioProveedor']];
        $limitar = [1];
        $productoC = new ProductoController;
        $productoFechaRefs = $productoC->getProductoFechaRefPDO($filtros, $ordenados, $limitar);
        
        if(!empty($productoFechaRefs)){
            $precio = $productoFechaRefs[0]->getPrecioProveedor();
            if($sumaComicion){
                $comision = $productoFechaRefs[0]->getComision();
                $precio += ($precio * $comision) / 100;
            }
            $ret = $precio;
        }
        
        // TODO: cambiar el retorno de esta funcion por Util::moneda()
        return number_format($ret, $decimals = 2, ",", ".");
    }
    
    public function setSlug($slug = '')
    {
        if('' == $slug){
            $slug = UtilController::slugify($this->getNombre());
        }
        
        return parent::setSlug($slug);        
    }
    
}