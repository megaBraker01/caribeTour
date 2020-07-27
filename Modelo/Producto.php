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
        $ImagenList = $ImagenController->select([['idTabla', $idProducto], ['tabla', 'productos']]);
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
                $precio += Util::comisionCalc($precio, $comision);
            }
            $precio += $productoFechaRefs[0]->getTasasTotal();
            $ret = $precio;
        }
        
        return $ret;
    }
    
    public function setSlug($slug = '')
    {
        if('' == $slug){
            $slug = $this->slugify($this->getNombre());
        }
        
        return parent::setSlug($slug);        
    }
    

    /**
     * crear las fechas de covertura del seguro
     * @param string $fsalida
     * @param string $fvuelta
     * @return int
     */
    public function creaFechasSeguro(string $fsalida, string $fvuelta): int
    {
        try {
            $fechaList = [$fsalida, $fvuelta];
            $fechaC = new FechaController;
            $idFechas = [];
            foreach ($fechaList as $fecha){
                $fechaFormateada = Util::dateFormat($fecha, 'Y-m-d');
                $idFechas[] = $fechaC->insert(new Fecha(0, $fechaFormateada));
            }

            $pfechaRefC = new ProductoFechaRefController;
            $idProductoFechaRef = $pfechaRefC->insert(new ProductoFechaRef(0, $this->getIdProducto(), $idFechas[0], $idFechas[1], $this->getPrecioProveedor(), $this->getComision()));
            
            return $idProductoFechaRef;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    /**
     * 
     * @param int $idProductoFechaRefById
     * @return \ProductoFechaRef
     */
    public function getProductoFechaRefById(int $idProductoFechaRefById): ProductoFechaRef
    {
        $pfechaRefC = new ProductoFechaRefController;
        return @$pfechaRefC->select([['idProductoFechaRef', $idProductoFechaRefById]])[0];
    }
    
    /**
     * Obtiene el objeto tipo correspondiente al tipo de Facturacion
     * @return Tipo
     */
    public function getTipoFacturacion(){
        $TipoFacturacionController = new TipoFacturacionController();
        $idTipoFacturacion = $this->getIdTipoFacturacion();
        $TipoFacturacionList = $TipoFacturacionController->select([['idTipoFacturacion', $idTipoFacturacion]]);
        if(!isset($TipoFacturacionList[0])){
            throw new Exception("No se ha encontrado el tipo de facturacion con el id {$idTipoFacturacion}");
        }
        
        return $TipoFacturacionList[0];
    }
}