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
    
}