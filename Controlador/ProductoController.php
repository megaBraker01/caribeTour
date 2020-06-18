<?php

class ProductoController extends ProductoBaseController { 

    /**
     * Busca el producto en la bbdd y si no lo encuentra lanzamos una exception	
     * @param int $idProducto
     * @return Producto
     * @throws Exception
     */
    public function getProductoById(int $idProducto)
    {
        $producto = @$this->select([['idProducto', $idProducto]])[0];		
        if(!$producto){
            throw new Exception('NO hay producto con el id indicado');
        }
        return $producto;
    }
    
    /**
     * TODO: pasar este metodo al modelo o al controlador de producto
     * @param string $slug
     * @return type
     * @throws Exception
     */
    public function getProductoBySlug(string $slug)
    {
        if(!is_string($slug) or "" == $slug){
            throw new Exception('[ERROR] El slug tiene que ser un string distinto de ""');
        }
        $slug = strtolower($slug);
        $producto = null;
        $productoC = new ProductoController;
        $filtros = [['slug', $slug]];
        $productoList = $productoC->select($filtros);
        if(isset($productoList[0])){
            $producto = $productoList[0];
        }
        return $producto;
    }
    
    /**
     * @param array $filtros
     * @param array $ordenados
     * @param array $limitar
     * @param array $agrupar
     * @return array
     */
    public function getProductoFechaRefPDO(array $filtros = [], array $ordenados = [], array $limitar = [], array $agrupar = []): array
    {
        $sql = "SELECT * FROM v_producto_fecha_ref";
        $ret = [];
        $rows = $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
        foreach($rows as $row){
            $ret[] = new ProductoFechaDTO($row->idProductoFechaRef, $row->idProducto, $row->idFechaSalida, $row->precioProveedor, $row->comision, $row->producto, $row->idCategoria, $row->categoria, $row->idCategoriaPadre, $row->catPadre, $row->fsalida, $row->terminalSalida, $row->terminalDestino, $row->tasasSalida, $row->tasasDestino, $row->idFechaVuelta, $row->fvuelta, $row->terminalSalidaV, $row->terminalDestinoV, $row->tasasSalidaV, $row->tasasDestinoV);
        }
        return $ret;
    }
    
    /**
     * TODO: refactorizar y sacar este metodo a donde se ejecuta la logica
     * Setea los campos del producto con los valores del metodo POST
     * @param Producto $producto
     * @return \Producto
     */
    public function setProductFromPost(Producto $producto)
    {
        $producto->setAllParams($_POST);
        $imgHandler = new ImgHandler($_FILES['imagen']);
        $nombreImagenFinal = $imgHandler->uploadImageIfExist($producto->getSlug());
        if(!is_null($nombreImagenFinal)){
            $producto->setImagen($nombreImagenFinal);
        }        
        return $producto;
    }
    
    /**
     * 
     * @param int $idProducto
     * @param string $fecha
     * @param string $urlNavegation
     * @return array
     */
    public function getDataForCalendar(int $idProducto, string $fecha, string $urlNavegation): array
    {
        $fechaToTime = strtotime($fecha);
        $diaFiltro = date('d');
        $mesFiltro = date('m', $fechaToTime);
        $anioFiltro = date('Y', $fechaToTime);
        $calendarioFiltro = [
            ['idProducto', $idProducto],
            ['MONTH(fsalida)', $mesFiltro],
            ['YEAR(fsalida)', $anioFiltro],
        ];
        
        if(date('m') == $mesFiltro){
            $calendarioFiltro[] = ['DAY(fsalida)', $diaFiltro, '>='];
        }

        $fechaSalidaPrecio = $this->getProductoFechaRefPDO($calendarioFiltro);
        
        $eventos = [];
        foreach($fechaSalidaPrecio as $productoFechaDTO){
            $precioProveedor = $productoFechaDTO->getPrecioProveedor();
            $comision = $productoFechaDTO->getComision();
            $precio = $precioProveedor + (($precioProveedor * $comision) / 100);
            $pvp = Util::moneda($precio);
            $fechaS = date('Y-m-d', strtotime( $productoFechaDTO->getFsalida() ));
            $eventos[$fechaS] = "<div class='calendar-price'><a href='{$urlNavegation}/fecha={$fecha}/fechaS={$fechaS}'>{$pvp}</a></div>";
        }
        
        return $eventos;
    }

    /**
     * TODO: pasar el metodo a FormHandler
     * Renderiza el formulario para la entidad producto
     * @param array $fieldValues
     * @param bool $readOnly
     * @param bool $isNewRecord
     * @return string
     */
    public function renderProductoForm($fieldValues = [], $readOnly = true, $isNewRecord = true)
    {
        $categoriaC = new CategoriaController;
        $formHandler = new FormHandler('productos', $readOnly, $isNewRecord);
        $categoriaOptions = [];
        foreach($categoriaC->select([], [['idCategoriaPadre']]) as $categoria){
            $categoriaOptions[$categoria->getIdCategoria()] = $categoria->getNombre();
        }

        $utilC = new UtilController();
        $tipoOptions = $utilC->getTipos('productos');

        $estadoC = new EstadoController;
        $estadoOptions = [];
        foreach($estadoC->select([['productos', 1], ['idEstado', 1, '>']]) as $estado){
            $estadoOptions[$estado->getIdEstado()] = $estado->getNombre();
        }

        $proveedorC = new ProveedorController;
        $proveedorOptions = [];
        foreach($proveedorC->select() as $proveedor){
            $proveedorOptions[$proveedor->getIdProveedor()] = $proveedor->getNombre();
        }

        // TODO: hacer que mire el valor que tiene por defecto en la tabla y que rellene el valor del formulario
        $formHandler->setFieldsReadOnly(['idProducto', 'fechaAlta', 'fechaUpdate']);
        $formHandler->setFieldOptions('idCategoria', $categoriaOptions);
        $formHandler->setFieldOptions('idTipo', $tipoOptions);
        $formHandler->setFieldOptions('idEstado', $estadoOptions);
        $formHandler->setFieldOptions('idProveedor', $proveedorOptions);
        $formHandler->setFieldOptions('esOferta', ['No', 'Si']);
        $formHandler->setFieldsTypeImgFile(['imagen']);
        $formHandler->setFieldIntoFieldset();
        if(!empty($fieldValues)){
            $formHandler->setValues($fieldValues);
        }

        return $formHandler->renderForm();

    }
}