<?php

class Categoria extends CategoriaBase {

    /**
     * Obtiene el modelo de la categoria padre a la que pertenece
     * @return Categoria | null
     */
    public function getCategoriaPadre()
    {
        $ret = null;
        $categoriaC = new CategoriaController;
        $filtro = [['idCategoria', '=', $this->getIdCategoriaPadre()]];
        $catList = $categoriaC->select($filtro);
        if(isset($catList[0])) {
            $ret = $catList[0];
        }
        return $ret;
    }
    
    /**
     * 
     * @return array
     */
    public function getCategoriasHijas() 
    {
        $ret = [];
        if(0 == $this->getIdCategoriaPadre()) {
            $categoriaC = new CategoriaController;
            $filtro = [['idCategoriaPadre', '=', $this->getIdCategoria()]];
            $ret = $categoriaC->select($filtro);
        }
        return $ret;        
    }
    
    /**
     * Obtiene el precio mas bajo disponible de la categoria actual
     * @param bool $sumaComicion
     * @param bool $byCatPadre
     * @return type
     */
    public function getPrecioMasBajo(bool $sumaComicion = true, bool $byCatPadre = false)
    {
        $ret = 0;
        $idCategoria = $this->getIdCategoria();
        $id = "idCategoria";
        if($byCatPadre){
            $id = "idCategoriaPadre";
        }        
        $filtros = [
            [$id, '=', $idCategoria],
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
        
        return $ret;
    }
}
