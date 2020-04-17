<?php

class Blog extends BlogBase {
	
    public function getComentarios()
    {
        $comentarioC = new BlogComentarioController;
        $idBlog = $this->getIdBlog();
        return $comentarioC->select([['idBlog', $idBlog]]);
    }
    
}