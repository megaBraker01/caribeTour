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