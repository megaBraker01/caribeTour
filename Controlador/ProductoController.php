<?php

class ProductoController extends ProductoBaseController { 

    /**
     * Verifica si el parametro idProducto ha sido mandado por el metodo GET
     * @return int
     * @throws Exception
     */
    public function verificaGetIdProducto(){
        if(!isset($_GET['idProducto']) or '' == $_GET['idProducto']){
            throw new Exception('El idProducto NO está definido');
        }
        return $_GET['idProducto'];
    }

    /**
     * Busca el producto en la bbdd y si no lo encuentra lanzamos una exception	
     * @param int $idProducto
     * @return Producto
     * @throws Exception
     */
    public function getProductoById(int $idProducto){
        $producto = @$this->select([['idProducto', $idProducto]])[0];		
        if(!$producto){
            throw new Exception('NO hay producto con el id indicado');
        }
        return $producto;
    }
    
    /**
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
     * Renderiza el formulario para la entidad producto
     * @param array $fieldValues
     * @param bool $readOnly
     * @param bool $isNewRecord
     * @return string
     */
    public function renderProductoForm($fieldValues = [], $readOnly = true, $isNewRecord = true)
    {
        $categoriaC = new CategoriaController;
        $formHamdler = new FormHandler('productos', $readOnly, $isNewRecord);
        $categoriaOptions = [];
        foreach($categoriaC->select([], [['idCategoriaPadre']]) as $categoria){
            $categoriaOptions[$categoria->getIdCategoria()] = $categoria->getNombre();
        }

        $util = new Util;
        $tipoOptions = $util->getTipos('productos');

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
        $formHamdler->setFieldsReadOnly(['idProducto', 'fechaAlta', 'fechaUpdate']);
        $formHamdler->setFieldOptions('idCategoria', $categoriaOptions);
        $formHamdler->setFieldOptions('idTipo', $tipoOptions);
        $formHamdler->setFieldOptions('idEstado', $estadoOptions);
        $formHamdler->setFieldOptions('idProveedor', $proveedorOptions);
        $formHamdler->setFieldOptions('esOferta', ['No', 'Si']);
        $formHamdler->setFieldsTypeImgFile(['imagen']);
        $formHamdler->setFieldIntoFieldset();
        if(!empty($fieldValues)){
            $formHamdler->setValues($fieldValues);
        }

        return $formHamdler->renderForm();

    }
}