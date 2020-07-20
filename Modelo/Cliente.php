<?php

class Cliente extends ClienteBase {
    
    public function __toString()
    {
        return  $this->getNombreCompleto();
    }
    
    public function getNombreCompleto()
    {
        return Util::capitalizar("{$this->getNombre()} {$this->getApellidos()}");
    }
}