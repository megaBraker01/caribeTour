<?php

class Pasajero extends PasajeroBase {
    
    public function __toString()
    {
        return  Util::capitalizar("{$this->getNombre()} {$this->getApellidos()}");
    }
}