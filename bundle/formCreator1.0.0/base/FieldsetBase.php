<?php

abstract class FieldsetBase {
    
    protected $attributes = ['id' => '', 'class' => '', 'fields' => []];
    protected $legend = "";
    protected $readOnly = false;

    public function __construct($legend = "")
    {
        $this->setLegend($legend);
    }
    
    
    /**
     * @return string
     */
    public function getLegend(): string {
        return $this->legend;
    }


    /**
     * @param string $legend
     * @return Fieldset
     */
    public function setLegend(string $legend): Fieldset {
        $this->legend = ucwords(strtolower($legend));
        return $this;
    }

    public function setClass(string $class): Fieldset {
        $this->attributes['class'] = $class;
        return $this;
    }


    /**
     * @return array
     */
    public function getFields(): array {
        return $this->attributes['fields'];
    }


    /**
     * @param array $fields
     * @return Fieldset
     */
    public function setFields(array $fields): Fieldset {
        $this->attributes['fields'] = $fields;
        return $this;
    }
    
	
    /**
     * @param Field $field
     * @return Fieldset
     */
    public function addField(Field $field): Fieldset {
        $this->attributes['fields'][] = $field;
        return $this;
    }


    /**
     * @return string
     */
    public function getId(): string {
        return $this->attributes['id'];
    }


    /**
     * @param string $id
     * @return Fieldset
     */
    public function setId(string $id): Fieldset {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function setReadOnly(bool $readOnly = true)
    {
        $this->readOnly = $readOnly;
        return $this;
    }
    
	
    /**
     * @return string
     */
    public function render(): string {

        $atributesPrint = [];
        foreach ($this->attributes as $attribute => $value){
            if("" != $value and !is_array($value)){
                $atributesPrint[] = "$attribute='$value'";
            }
        }

        $ret = "<fieldset ". implode(" ", $atributesPrint) ." >\n";
        if ($this->getLegend() != ""){
            $ret .= "\t<legend>{$this->getLegend()}</legend>\n";
        }
		
        foreach($this->getFields() as $field){
            if($this->readOnly and $field->getType() != 'submit'){
                $field->setReadOnly();
            }
            $ret .= $field->render();
        }
        $ret .= "</fieldset>\n";
        
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
        foreach($this->attributes as $field => $value){
            if("" != $value and !is_array($value)){
                $paramList[$field] = $value;
            } elseif(is_array($value)) {
                foreach($value as $fieldObj){
                    $paramList[$field][] = $fieldObj->toArray();
                }
                
            }
        }
        
        return json_encode($paramList);
    }
    
	
	/**
     * @return array
     */
    public function toArray(): array {
        return json_decode($this->toJson(), true);
    }
}