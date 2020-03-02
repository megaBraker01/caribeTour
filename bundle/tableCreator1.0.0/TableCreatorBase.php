<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TableCreatorBase
 *
 * @author Rafael Perez <angel_rafael01@hotmail.com>
 */
abstract class TableCreatorBase {
    
    protected $matrix = [];
    protected $header = [];
    protected $body = [];
    protected $caption = "";
    protected $tableAttributes = ['name' => '', 'id' => '', 'class' => '', 'border' => '', 'caption' => '', 'summary' => ''];
    protected $trClass = "";
    protected $tdClass = "";

    public function __construct(array $array = [])
    {
        $this->matrix = $array;
        $this->explodeDataTable();        
    }
    
    public function getMatrix()
    {
        return $this->matrix;
    }
    
    public function setHeader(array $header){
        $this->header = $header;
        return $this;
    }
    
    public function setBody(array $body)
    {
        $this->body = $body;
        return $this;
    }
    
    public function setCaption(string $caption)
    {
        $this->caption = $caption;
        return $this;
    }
    
    public function setAttribute(string $attributeName, $value)
    {
        switch (strtolower($attributeName)){
            case 'name':
            case 'id':
            case 'class':
            case 'border': 
            case 'caption':
            case 'summary': $this->tableAttributes[$attributeName] = $value;
                break;
        }
        return $this;
    }

    private function explodeDataTable()
    {
        $array = $this->getMatrix();
        $firtPosition = reset($array);
        if(is_array($firtPosition)){
            if(!$this->isAssociative($firtPosition)){
                $this->setBody($array);
            } else {
                $this->setHeader(array_keys($firtPosition));
                $bodyList = [];
                foreach($array as $row){
                    $bodyList[] = array_values($row);
                    
                }
                $this->setBody($bodyList);
            }
        } else {
             if(!$this->isAssociative($array)){
                 $this->setHeader($array);
             } else {
                 $this->setHeader(array_keys($array));
                 $this->setBody([array_values($array)]);
             }
        }
    }
    
    public function getHeader()
    {
        return $this->header;
    }
    
    public function getBody()
    {
        return $this->body;
    }
    
    public function getCaption()
    {
        return $this->caption;
    }
    
    public function getHeadRender()
    {
        $ret = "";
        if(!empty($this->getHeader())){
            $thRender = "<th>".implode("</th><th>", $this->getHeader()) ."</th>";
            $ret = "\t<thead><tr>{$thRender}</tr></thead>";
        }
        return $ret;
    }
    
    public function getCaptionRender()
    {
        $ret = "";
        if(!empty($this->getCaption())){
            $ret = "\t<caption>" .$this->getCaption() ."</caption>";
        }
        return $ret;
    }


    public function getBodyRender()
    {
        $trs = "";
        $trClass = $this->trClass ? " class='{$this->trClass}'" : "";
        $tdClass = $this->tdClass ? " class='{$this->tdClass}'" : "";
        foreach ($this->getBody() as $row){
            $tds = "";
            foreach($row as $key => $value){
                $tds .= "<td{$tdClass}>$value</td>";
            }
            $trs .= "\t\t<tr{$trClass}>{$tds}</tr>\n";
        }        
        return "\t<tbody>\n{$trs}\t</tbody>";
    }
    
    public function getAttributesRender()
    {
        $ret = [];
        foreach($this->tableAttributes as $attr => $value){
            if("" != $value){
                $ret[] = "{$attr}='{$value}'";
            }
        }
        return implode(" ", $ret);
    }

    public function render()
    {
        $attributes = " {$this->getAttributesRender()}";
        $thead = $this->getHeadRender();
        $caption = $this->getCaptionRender();
        $tbody = $this->getBodyRender();
        $table = "<table{$attributes}>\n{$caption}\n{$thead}\n{$tbody}\n</table>\n";
        
        return $table;
    }
    
    public function isAssociative($array)
    {
        return (bool) count(array_filter(array_keys($array), 'is_string'));
    }
}