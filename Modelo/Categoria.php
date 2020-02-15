<?php

class Categoria extends CategoriaBase {

    public function getCategoriaPadre()
    {
        $categoriaC = new CategoriaController;
        $filtro = [['idCategoria', '=', $this->getIdCategoriaPadre()]];
        $catList = $categoriaC->select($filtro);
        return $catList[0];
    }

    public function getProductoFechaRef(array $filtros = [], array $ordenados = [], array $limitar = [], array $agrupar = [])
    {
        $idCategoria = $this->getIdCategoria();
        $util = new Util();
        return $util->getProductoFechaRefPDO($filtros, $ordenados, $limitar, $agrupar);
    }
}
