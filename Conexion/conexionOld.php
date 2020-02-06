<?php

class ConexionOld {

    const HOSTNAME = 'localhost';
    const USER = 'root';
    const PASSWORD = '';
    const DATABASE = 'caribetourold';

    protected $conexion;

    public function __construct() {
        try {
            $this->conexion = new PDO("mysql:host=" . self::HOSTNAME . "; dbname=" . self::DATABASE, self::USER, self::PASSWORD); // realizamos la conexion
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // preparamos las excepciones
            $this->conexion->exec("SET CHARACTER SET utf8");  // especificamos la codificacion de la conexion
        } catch (Exception $e) { // validamos si hay algun error al conecar con la bbdd
            die("Fallo en la conexion: " . $e->GetMessage()); // avisamos del error
            exit(); // salimos 
        }
    }

    public function pdo() {
        return $this->conexion;
    }

}