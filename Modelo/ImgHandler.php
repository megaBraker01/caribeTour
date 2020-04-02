<?php

class ImgHandler {
    
    protected $imgInfo = [];
    protected $validTypes = ['gif','jpg','jpe','jpeg','png'];
    protected $maxImgSize = 1048576; // = 1 Mg


    public function __construct($imgInfo)
    {
        $this->setImgInfo($imgInfo);
    }

    public function getImgInfo(){
        return $this->imgInfo;
    }

    public function getImgType(){
        if(empty($this->imgInfo)){
            throw new Exception('[ERROR] El campo imgInfo está vacío.');
        }
        $type = explode('/',$this->getImgInfo()['type']);
        return end($type);
    }

    public function setImgInfo($imgInfo){
        $this->imgInfo = $imgInfo;
        return $this;
    }

    public function uploadImage($rutaDestino, $nombreImg = null)
    {
        $imgType = $this->getImgType();
        if(!in_array($imgType, $this->validTypes)){
            throw new Exception("[ERROR] El tipo de imagen '{$imgType}' NO es permitido.");
        }

        if($this->getImgInfo()['size'] > $this->maxImgSize){
            $size = $this->maxImgSize / 1024;
            throw new Exception("[ERROR] El tamaño de la imagen supera el tamaño máximo permitido de {$size}Kb");
        }

        $rutaOrigen = $this->getImgInfo()['tmp_name'];
        $imgNombre = $nombreImg ?? $this->getImgInfo()['name'];
        $finRura = substr($rutaDestino, -1) != "/" ? "/" : ""; // nos aseguramos que haya una / al final de la ruta
        $rutaDestino = "{$rutaDestino}{$finRura}{$imgNombre}.{$this->getImgType()}";
        return move_uploaded_file($rutaOrigen, $rutaDestino);
    }


    public function cropAndUploadImage($rutaFin, $nombre_archivo, $ancho, $alto)
    {
        $nombre_archivo = $nombre_archivo . $this->getImgType();
        $rutaOrigen = $this->getImgInfo()['tmp_name'];
        $ruta_imagen = $rutaOrigen;
    
        $miniatura_ancho_maximo = $ancho;
        $miniatura_alto_maximo = $alto;
        
        $info_imagen = getimagesize($ruta_imagen);
        $imagen_ancho = $info_imagen[0];
        $imagen_alto = $info_imagen[1];
        $imagen_tipo = $info_imagen['mime'];
        
        
        $proporcion_imagen = $imagen_ancho / $imagen_alto;
        $proporcion_miniatura = $miniatura_ancho_maximo / $miniatura_alto_maximo;
        
        if ( $proporcion_imagen > $proporcion_miniatura ){
            $miniatura_ancho = $miniatura_alto_maximo * $proporcion_imagen;
            $miniatura_alto = $miniatura_alto_maximo;
        } else if ( $proporcion_imagen < $proporcion_miniatura ){
            $miniatura_ancho = $miniatura_ancho_maximo;
            $miniatura_alto = $miniatura_ancho_maximo / $proporcion_imagen;
        } else {
            $miniatura_ancho = $miniatura_ancho_maximo;
            $miniatura_alto = $miniatura_alto_maximo;
        }
        
        $x = ( $miniatura_ancho - $miniatura_ancho_maximo ) / 2;
        $y = ( $miniatura_alto - $miniatura_alto_maximo ) / 2;
        
        switch ( $imagen_tipo ){
            case "image/jpg":
            case "image/jpeg":
                $imagen = imagecreatefromjpeg( $ruta_imagen );
                break;
            case "image/png":
                $imagen = imagecreatefrompng( $ruta_imagen );
                break;
            case "image/gif":
                $imagen = imagecreatefromgif( $ruta_imagen );
                break;
        }
        
        $lienzo = imagecreatetruecolor( $miniatura_ancho_maximo, $miniatura_alto_maximo );
        $lienzo_temporal = imagecreatetruecolor( $miniatura_ancho, $miniatura_alto );
        
        imagecopyresampled($lienzo_temporal, $imagen, 0, 0, 0, 0, $miniatura_ancho, $miniatura_alto, $imagen_ancho, $imagen_alto);
        imagecopy($lienzo, $lienzo_temporal, 0,0, $x, $y, $miniatura_ancho_maximo, $miniatura_alto_maximo);
        
        imagejpeg($lienzo, $rutaFin.$nombre_archivo, 80);
    
    }	

    
}