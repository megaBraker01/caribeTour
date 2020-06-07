<?php

class BlogController extends BlogBaseController { 
    
    /**
     * 
     * @return array
     */
    public function getBlogsPopulares(): array
    {
        $sql = "SELECT idBlog, count(idBlogComentario) AS comentarios FROM  blog_comentarios bc GROUP BY idBlog ORDER by comentarios desc";
        $rows = $this->query($sql);
        $Ids = [];
        foreach($rows as $row){
            $Ids[] = $row->idBlog;
        }
        $blogsIds = implode(", ", $Ids);
        $filtro = [['idBlog', $blogsIds, 'in']];
        $blogC = new BlogController;
        $blogList = $blogC->select($filtro);
        return $blogList;
    }
    
    /**
     * TODO: buscar y sustituir getGaleriaBlog por getBlogImagenes
     * @param array $filtros
     * @param array $ordenados
     * @param array $limitar
     * @param array $agrupar
     * @return array
     */
    public function getBlogImagenes(array $filtros = [], array $ordenados = [], array $limitar = [], array $agrupar = []): array
    {
        $ordenados[] = ['RAND()'];
        $limitar[] = 8;
        $sql = "SELECT i.idImagen, i.srcImagen, i.idProducto, p.nombre, p.slug FROM imagenes i INNER JOIN productos p ON i.idProducto = p.idproducto";
        return $this->query($sql, $filtros, $ordenados, $limitar, $agrupar);        
    }
}