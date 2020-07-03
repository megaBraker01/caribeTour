<?php

abstract class ProductoBase extends ModelBase {

    protected $idProducto;
    protected $nombre;
    protected $imagen;
    protected $descripcion;
    protected $slug;
    protected $itinerario;
    protected $incluye;
    protected $precioProveedor;
    protected $comision;
    protected $metaDescripcion;
    protected $metaKeyWords;
    protected $idCategoria;
    protected $idTipo;
    protected $idTipoFacturacion;
    protected $idEstado;
    protected $idProveedor;
    protected $stock;
    protected $esOferta;
    protected $fechaAlta;
    protected $fechaUpdate;

    public function __construct(
        $idProducto = 0,
        $nombre = '',
        $imagen = '',
        $descripcion = '',
        $slug = '',
        $itinerario = '',
        $incluye = '',
        $precioProveedor = 0,
        $comision = 0,
        $metaDescripcion = '',
        $metaKeyWords = '',
        $idCategoria = 1,
        $idTipo = 1,
        $idTipoFacturacion = 1,
        $idEstado = 1,
        $idProveedor = 1,
        $stock = 1,
        $esOferta = 0,
        $fechaAlta = '',
        $fechaUpdate = ''
    ){
        $this->setIdProducto($idProducto);
        $this->setNombre($nombre);
        $this->setImagen($imagen);
        $this->setDescripcion($descripcion);
        $this->setSlug($slug);
        $this->setItinerario($itinerario);
        $this->setIncluye($incluye);
        $this->setPrecioProveedor($precioProveedor);
        $this->setComision($comision);
        $this->setMetaDescripcion($metaDescripcion);
        $this->setMetaKeyWords($metaKeyWords);
        $this->setIdCategoria($idCategoria);
        $this->setIdTipo($idTipo);
        $this->setIdTipoFacturacion($idTipoFacturacion);
        $this->setIdEstado($idEstado);
        $this->setIdProveedor($idProveedor);
        $this->setStock($stock);
        $this->setEsOferta($esOferta);
        $this->setFechaAlta($fechaAlta);
        $this->setFechaUpdate($fechaUpdate);
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

    public function getPrecioProveedor(){ return $this->precioProveedor; }

    public function getComision(){ return $this->comision; }

    public function getMetaDescripcion(){ return $this->metaDescripcion; }

    public function getMetaKeyWords(){ return $this->metaKeyWords; }

    public function getIdCategoria(){ return $this->idCategoria; }

    public function getIdTipo(){ return $this->idTipo; }

    public function getIdTipoFacturacion(){ return $this->idTipoFacturacion; }

    public function getIdEstado(){ return $this->idEstado; }

    public function getIdProveedor(){ return $this->idProveedor; }

    public function getStock(){ return $this->stock; }

    public function getEsOferta(){ return $this->esOferta; }

    public function getFechaAlta(){ return $this->fechaAlta; }

    public function getFechaUpdate(){ return $this->fechaUpdate; }

    public function getCategoria(){
        $CategoriaController = new CategoriaController();
        $idCategoria = $this->getIdCategoria();
        $CategoriaList = $CategoriaController->select([['idCategoria', $idCategoria]]);
        return $CategoriaList[0];
    }

    public function getTipo(){
        $TipoController = new TipoController();
        $idTipo = $this->getIdTipo();
        $TipoList = $TipoController->select([['idTipo', $idTipo]]);
        return $TipoList[0];
    }

    public function getTipoFacturacion(){
        $TipoFacturacionController = new TipoFacturacionController();
        $idTipoFacturacion = $this->getIdTipoFacturacion();
        $TipoFacturacionList = $TipoFacturacionController->select([['idTipoFacturacion', $idTipoFacturacion]]);
        return $TipoFacturacionList[0];
    }

    public function getEstado(){
        $EstadoController = new EstadoController();
        $idEstado = $this->getIdEstado();
        $EstadoList = $EstadoController->select([['idEstado', $idEstado]]);
        return $EstadoList[0];
    }

    public function getProveedor(){
        $ProveedorController = new ProveedorController();
        $idProveedor = $this->getIdProveedor();
        $ProveedorList = $ProveedorController->select([['idProveedor', $idProveedor]]);
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

    public function setPrecioProveedor($precioProveedor = 0){
        $this->precioProveedor = (float) $precioProveedor; return $this;
    }

    public function setComision($comision = 0){
        $this->comision = (float) $comision; return $this;
    }

    public function setMetaDescripcion($metaDescripcion = ''){
        $this->metaDescripcion = (string) $metaDescripcion; return $this;
    }

    public function setMetaKeyWords($metaKeyWords = ''){
        $this->metaKeyWords = (string) $metaKeyWords; return $this;
    }

    public function setIdCategoria($idCategoria = 1){
        $this->idCategoria = (int) $idCategoria; return $this;
    }

    public function setIdTipo($idTipo = 1){
        $this->idTipo = (int) $idTipo; return $this;
    }

    public function setIdTipoFacturacion($idTipoFacturacion = 1){
        $this->idTipoFacturacion = (int) $idTipoFacturacion; return $this;
    }

    public function setIdEstado($idEstado = 1){
        $this->idEstado = (int) $idEstado; return $this;
    }

    public function setIdProveedor($idProveedor = 1){
        $this->idProveedor = (int) $idProveedor; return $this;
    }

    public function setStock($stock = 1){
        $this->stock = (int) $stock; return $this;
    }

    public function setEsOferta($esOferta = 0){
        $this->esOferta = (int) $esOferta; return $this;
    }

    public function setFechaAlta($fechaAlta = ''){
        $this->fechaAlta = (string) $fechaAlta; return $this;
    }

    public function setFechaUpdate($fechaUpdate = ''){
        $this->fechaUpdate = (string) $fechaUpdate; return $this;
    }

}