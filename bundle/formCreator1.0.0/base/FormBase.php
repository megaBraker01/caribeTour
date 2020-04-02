<?php

abstract class FormBase{
    
    protected $formReadOnly = false;
    protected $attributes = ['id' => '', 'class' => '', 'action' => '', 'method' => '', 'name' => '', 'caption' => '', 'fieldsets' => [], 'fields' => [], 'autocomplete' => '', 'novalidate' => '', 'enctype' => '', 'target' => '', 'accept' => '', 'enctype' => ''];
    
    const METHOD_LIST = ['get', 'post'];


    /**
    * @return string 
    */
    public function getId(): string {
        return $this->attributes['id'];
    }


    /**
    * @return string 
    */
    public function getAction(): string {
        return $this->attributes['action'];
    }


    /**
    * @return string 
    */
    public function getMethod(): string {
        return $this->attributes['method'];
    }


    /**
    * @return string 
    */
    public function getName(): string {
        return $this->attributes['name'];
    }


    /**
    * @return string 
    */
    public function getCaption(): string {
        return $this->attributes['caption'];
    }


    /**
    * @return array 
    */
    public function getFieldsets(): array {
        return $this->attributes['fieldsets'];
    }


    /**
    * @return array 
    */
    public function getFields(): array {
        return $this->attributes['fields'];
    }


    /**
    * @return string 
    */
    public function getAutocomplete(): string {
        return $this->attributes['autocomplete'];
    }


    /**
    * @return string 
    */
    public function getNovalidate(): string {
        return $this->attributes['novalidate'];
    }


    /**
    * @return string 
    */
    public function getEnctype(): string {
        return $this->attributes['enctype'];
    }


    /**
    * @return string 
    */
    public function getTarget(): string {
        return $this->attributes['target'];
    }


    /**
    * @return string 
    */
    public function getAccept(): string {
        return $this->attributes['accept'];
    }


    public function getFieldByParam($value, $param = 'name')
    {
        $fieldMethod = "get" . ucfirst(strtolower($param));
        $ret = null;
        foreach($this->getFields() as $field){
            if ($field->$fieldMethod() == $value){
                $ret = $field;
            }
        }

        return $ret ?? new Field('');
    }


    /**
    * @param string $id
    * @return Form 
    */
    public function setId(string $id): Form {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function setClass(string $class): Form {
        $this->attributes['class'] = $class;
        return $this;
    }


    /**
    * @param string $action
    * @return Form 
    */
    public function setAction(string $action): Form {
        $this->attributes['action'] = $action;
        return $this;
    }


    /**
    * @param string $method
    * @return Form 
    */
    public function setMethod(string $method): Form {
        $validMethod = (in_array(strtolower($method), self::METHOD_LIST)) ? $method : 'post';
        $this->attributes['method'] = $validMethod;
        return $this;
    }


    /**
    * @param string $name
    * @return Form 
    */
    public function setName(string $name): Form {
        $this->attributes['name'] = $name;
        return $this;
    }


    /**
    * @param string $caption
    * @return Form 
    */
    public function setCaption(string $caption): Form {
        $this->attributes['caption'] = $caption;
        return $this;
    }


    /**
    * @param array $fieldsets
    * @return Form 
    */
    public function setFieldsets(array $fieldsets): Form {
        $this->attributes['fieldsets'] = $fieldsets;
        return $this;
    }
    
    /**
    * @param Fieldset $fieldset
    * @return Form 
    */
    public function addFieldset(Fieldset $fieldset): Form {
        $this->attributes['fieldsets'][] = $fieldset;
        return $this;
    }


    /**
    * @param array $fields
    * @return Form 
    */
    public function setFields(array $fields): Form {
        $this->attributes['fields'] = $fields;
        return $this;
    }
    
    
    /**
    * @param Field $field
    * @return Form 
    */
    public function addField(Field $field): Form {
        $this->attributes['fields'][] = $field;
        return $this;
    }


    /**
    * @param string $autocomplete
    * @return Form 
    */
    public function setAutocomplete(string $autocomplete): Form {
        $this->attributes['autocomplete'] = $autocomplete;
        return $this;
    }


    /**
    * @param string $novalidate
    * @return Form 
    */
    public function setNovalidate(string $novalidate): Form {
        $this->attributes['novalidate'] = $novalidate;
        return $this;
    }


    /**
    * @param string $enctype
    * @return Form 
    */
    public function setEnctype(string $enctype): Form {
        $this->attributes['enctype'] = $enctype;
        return $this;
    }


    /**
    * @param string $target
    * @return Form 
    */
    public function setTarget(string $target): Form {
        $this->attributes['target'] = $target;
        return $this;
    }


    /**
    * @param string $target
    * @return Form 
    */
    public function setAccept(string $accept): Form {
        $this->attributes['accept'] = $accept;
        return $this;
    }


    public function setReadOnly(bool $readOnly = true)
    {
        $this->formReadOnly = $readOnly;
        return $this;
    }

    public function getReadOnly(){
        return $this->formReadOnly;
    }


    /**
     * @return string
     */
    public function render(): string {
        $ret = "";
        
        $atributesPrint = [];
        foreach ($this->attributes as $attribute => $value){
            if("" != $value and !is_array($value)){
                $atributesPrint[] = "$attribute='$value'";
            }
        }
        $ret .= "<form ". implode(" ", $atributesPrint) .">\n";
        
        if(!empty($this->getFieldsets())){
            foreach($this->getFieldsets() as $fieldset){
                if($this->formReadOnly){
                    $fieldset->setReadOnly();
                }
                $ret .= $fieldset->render();
            }
        }
        
        if(!empty($this->getFields())){
            foreach($this->getFields() as $field){
                if($this->formReadOnly){
                    $field->setReadOnly();
                }
                $ret .= $field->render();
            }
        }        
            
        $ret .= "</form>\n";
        
        return $ret;
        
    }

    
    /**
     * @return string
     */
    public function __toString(): string {
        return $this->render();
    }
    
    
    /**
     * @return string
     */
    public function toJson(): string {
        $paramList = [];
        foreach($this->attributes as $attributes => $value){
            if("" != $value and !is_array($value)){
               $paramList[$attributes] = $value;
            }
        }
        
        $fieldsetList = [];
        if(!empty($this->getFieldsets())){
            foreach($this->getFieldsets() as $fieldset){
                $fieldsetList[] = $fieldset->toArray();
            }
        }
        $paramList['fieldsets'] = $fieldsetList;
        
        $fieldList = [];
        if(!empty($this->getFields())){
            foreach($this->getFields() as $field){
                $fieldList[] = $field->toArray();
            }
        }
        $paramList['fields'] = $fieldList;

        return json_encode($paramList);
    }
    
    
    /**
     * @return array
     */
    public function toArray(): array {
        return json_decode($this->toJson(), true);
    }
    
}