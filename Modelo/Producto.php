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
        $ImagenList = $ImagenController->select([['idProducto', '=', $idProducto]]);
        return $ImagenList;
    }
    
    /**
     * Obtiene todas las fechas del producto actual
     * @param array $filtros
     * @param array $ordenados
     * @param array $limitar
     * @param array $agrupar
     * @return array
     */
    public function getProductoFechaRef(array $filtros = [], array $ordenados = [], array $limitar = [], array $agrupar = []): array
    {
        $idProducto = $this->getIdproducto();
        $filtros[] = ['idProducto', '=', $idProducto];
        $util = new Util();
        return $util->getProductoFechaRefPDO($filtros, $ordenados, $limitar, $agrupar);
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
            ['idProducto', '=', $idProducto],
            ['fsalida', '>=', date('Y-m-d')]
        ];
        $ordenados = [['precioProveedor']];
        $limitar = [1];
        $util = new Util();
        $productoFechaRefs = $util->getProductoFechaRefPDO($filtros, $ordenados, $limitar);
        
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
    
}