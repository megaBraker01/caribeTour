<?php

class Cliente extends ClienteBase {
    
    public function __toString()
    {
        return  Util::capitalizar("{$this->getNombre()} {$this->getApellidos()}");
    }
}