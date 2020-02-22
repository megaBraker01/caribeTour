<?php

class Util extends BaseController {
    
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
    
    public function getProductoById(int $idProducto)
    {
        if(!is_int($idProducto) or $idProducto < 1){
            throw new Exception('[ERROR] El idProducto tiene que ser un entero mayor a cero (0)');
        }
        $producto = null;
        $productoC = new ProductoController;
        $filtros = [['idProducto', '=', $idProducto]];
        $productoList = $productoC->select($filtros);
        if(isset($productoList[0])){
            $producto = $productoList[0];
        }
        return $producto;
    }
    
    public function getProductoBySlug(string $slug)
    {
        if(!is_string($slug) or "" == $slug){
            throw new Exception('[ERROR] El slug tiene que ser un string distinto de ""');
        }
        $slug = strtolower($slug);
        $producto = null;
        $productoC = new ProductoController;
        $filtros = [['slug', '=', $slug]];
        $productoList = $productoC->select($filtros);
        if(isset($productoList[0])){
            $producto = $productoList[0];
        }
        return $producto;
    }
    
    public function getCategoriaById(int $idCategoria)
    {
        if(!is_int($idCategoria) or $idCategoria < 1){
            throw new Exception('[ERROR] El idProducto tiene que ser un entero mayor a cero (0)');
        }
        $categoria = null;
        $categoriaC = new CategoriaController;
        $filtros = [['idCategoria', '=', $idCategoria]];
        $categoriaList = $categoriaC->select($filtros);
        if(isset($categoriaList[0])){
            $categoria = $categoriaList[0];
        }
        return $categoria;
    }
    
    public function getCategoriaBySlug(string $slug)
    {
        if(!is_string($slug) or "" == $slug){
            throw new Exception('[ERROR] El slug tiene que ser un string distinto de ""');
        }
        $slug = strtolower($slug);
        $categoria = null;
        $categoriaC = new CategoriaController;
        $filtros = [['slug', '=', $slug]];
        $categoriaList = $categoriaC->select($filtros);
        if(isset($categoriaList[0])){
            $categoria = $categoriaList[0];
        }
        return $categoria;
    }
    
    public function getBlogsPopulares(): array
    {
        $sql = "SELECT idBlog, count(idBlogComentario) AS comentarios FROM  blog_comentarios bc GROUP BY idBlog ORDER by comentarios desc";
        $rows = $this->query($sql);
        $Ids = [];
        foreach($rows as $row){
            $Ids[] = $row->idBlog;
        }
        $blogsIds = implode(", ", $Ids);
        $filtro = [['idBlog', 'in', $blogsIds]];
        $blogC = new BlogController;
        $blogList = $blogC->select($filtro);
        return $blogList;
    }
    
    public function getGaleriaBlog(array $filtros = [], array $ordenados = [], array $limitar = [], array $agrupar = []): array
    {
        $ordenados[] = ['RAND()'];
        $limitar[] = 8;
        $sql = "SELECT i.idImagen, i.srcImagen, i.idProducto, p.nombre, p.slug FROM imagenes i INNER JOIN productos p ON i.idProducto = p.idproducto";
        return $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);
        
    }
}
