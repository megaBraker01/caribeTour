<?php

abstract class ProductoBase extends ModelBase {

    protected $idProducto;
    protected $nombre;
    protected $imagen;
    protected $descripcion;
    protected $slug;
    protected $itinerario;
    protected $incluye;
    protected $metaDescripcion;
    protected $metaKeyWords;
    protected $idCategoria;
    protected $idTipo;
    protected $idEstado;
    protected $idProveedor;
    protected $stock;
    protected $esOferta;
    protected $fechaAlta;
    protected $fehaUpdate;

    public function __construct(
        $idProducto = 0,
        $nombre = '',
        $imagen = '',
        $descripcion = '',
        $slug = '',
        $itinerario = '',
        $incluye = '',
        $metaDescripcion = '',
        $metaKeyWords = '',
        $idCategoria = 0,
        $idTipo = 0,
        $idEstado = 0,
        $idProveedor = 0,
        $stock = 0,
        $esOferta = 0,
        $fechaAlta = '',
        $fehaUpdate = ''
    ){
        $this->setIdProducto($idProducto);
        $this->setNombre($nombre);
        $this->setImagen($imagen);
        $this->setDescripcion($descripcion);
        $this->setSlug($slug);
        $this->setItinerario($itinerario);
        $this->setIncluye($incluye);
        $this->setMetaDescripcion($metaDescripcion);
        $this->setMetaKeyWords($metaKeyWords);
        $this->setIdCategoria($idCategoria);
        $this->setIdTipo($idTipo);
        $this->setIdEstado($idEstado);
        $this->setIdProveedor($idProveedor);
        $this->setStock($stock);
        $this->setEsOferta($esOferta);
        $this->setFechaAlta($fechaAlta);
        $this->setFehaUpdate($fehaUpdate);
    }

    public function __toString(){
        return $this->nombre;
    }

    public function getIdProducto(){ return $this->idProducto; }

    public function getNombre(){ return $this->nombre; }

    public function getImagen(){ return $this->imagen; }

    public function getDescripcion(){ return $this->descripcion; }

    public function getSlug(){ return $this->slug; }

    public function getItinerario(){ return $this->itinerario; }

    public function getIncluye(){ return $this->incluye; }

    public function getMetaDescripcion(){ return $this->metaDescripcion; }

    public function getMetaKeyWords(){ return $this->metaKeyWords; }

    public function getIdCategoria(){ return $this->idCategoria; }

    public function getIdTipo(){ return $this->idTipo; }

    public function getIdEstado(){ return $this->idEstado; }

    public function getIdProveedor(){ return $this->idProveedor; }

    public function getStock(){ return $this->stock; }

    public function getEsOferta(){ return $this->esOferta; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getFehaUpdate(){ return $this->fehaUpdate; }

    public function getCategoria(){
        $CategoriaController = new CategoriaController();
        $idCategoria = $this->getIdCategoria();
        $CategoriaList = $CategoriaController->select([['idCategoria', '=', $idCategoria]]);
        return $CategoriaList[0];
    }

    public function getTipo(){
        $TipoController = new TipoController();
        $idTipo = $this->getIdTipo();
        $TipoList = $TipoController->select([['idTipo', '=', $idTipo]]);
        return $TipoList[0];
    }

    public function getEstado(){
        $EstadoController = new EstadoController();
        $idEstado = $this->getIdEstado();
        $EstadoList = $EstadoController->select([['idEstado', '=', $idEstado]]);
        return $EstadoList[0];
    }

    public function getProveedor(){
        $ProveedorController = new ProveedorController();
        $idProveedor = $this->getIdProveedor();
        $ProveedorList = $ProveedorController->select([['idProveedor', '=', $idProveedor]]);
        return $ProveedorList[0];
    }

    public function setIdProducto($idProducto = 0){
        $this->idProducto = (int) $idProducto; return $this;
    }

    public function setNombre($nombre = ''){
        $this->nombre = (string) $nombre; return $this;
    }

    public function setImagen($imagen = ''){
        $this->imagen = (string) $imagen; return $this;
    }

    public function setDescripcion($descripcion = ''){
        $this->descripcion = (string) $descripcion; return $this;
    }

    public function setSlug($slug = ''){
        $this->slug = (string) $slug; return $this;
    }

    public function setItinerario($itinerario = ''){
        $this->itinerario = (string) $itinerario; return $this;
    }

    public function setIncluye($incluye = ''){
        $this->incluye = (string) $incluye; return $this;
    }

    public function setMetaDescripcion($metaDescripcion = ''){
        $this->metaDescripcion = (string) $metaDescripcion; return $this;
    }

    public function setMetaKeyWords($metaKeyWords = ''){
        $this->metaKeyWords = (string) $metaKeyWords; return $this;
    }

    public function setIdCategoria($idCategoria = 0){
        $this->idCategoria = (int) $idCategoria; return $this;
    }

    public function setIdTipo($idTipo = 0){
        $this->idTipo = (int) $idTipo; return $this;
    }

    public function setIdEstado($idEstado = 0){
        $this->idEstado = (int) $idEstado; return $this;
    }

    public function setIdProveedor($idProveedor = 0){
        $this->idProveedor = (int) $idProveedor; return $this;
    }

    public function setStock($stock = 0){
        $this->stock = (int) $stock; return $this;
    }

    public function setEsOferta($esOferta = 0){
        $this->esOferta = (int) $esOferta; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

    public function setFehaUpdate($fehaUpdate = ''){
        $this->fehaUpdate = (string) $fehaUpdate; return $this;
    }

}