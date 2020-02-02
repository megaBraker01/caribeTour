<?php

require_once SITE_ROOT ."/AutoLoader/autoLoaderModelo.php";

class Categoria extends CategoriaBase {
    public function setNombre($nombre = ''){
        $this->nombre = (string) ucfirst($nombre);
        return $this;
    }
}