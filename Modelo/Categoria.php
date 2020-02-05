<?php

class Categoria extends CategoriaBase {

	public function getCategoriaPadre()
	{
	    $categoriaC = new CategoriaController;
	    $filtro = [['idCategoria', '=', $this->getIdCategoriaPadre()]];
	    $catList = $categoriaC->select($filtro);
	    return $catList[0];
	}
}
