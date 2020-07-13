<?php

abstract class FieldBase {
    
    protected $showLabel = false;
    protected $label = ['id' => '', 'class' => '', 'for' => '', 'form' => '', 'accesskey' => '', 'content' => ''];
    //TODO: pasar los atributos por cada campo especifico, así no se mandan to
    protected $attributes = ['name' => '', 'type' => 'text', 'id' => '', 'class' => '', 'value' => '', 'alt' => '', 'title' => '', 'placeholder' => '', 'required' => '', 'form' => '', 'maxlength' => '', 'minlength' => '', 'max' => '', 'min' => '', 'rows' => '', 'cols' => '', 'width' => '', 'height' => '', 'disabled' => '', 'readonly' => '', 'autofocus' => '', 'autocomplete' => '', 'step' => '', 'size' => '', 'selected' => '', 'src' => '', 'multiple' => '', 'pattern' => '', 'accept' => ''];
    protected $selectOptions = [];
    protected $optionSelected = null;

    const TYPE_LIST = ['button', 'checkbox', 'color', 'date', 'datetime-local', 'email', 'file', 'hidden', 'image', 'month', 'number', 'password', 'radio', 'range', 'reset', 'search', 'submit', 'tel', 'text', 'textarea', 'select', 'time', 'url', 'week'];
    
    
    public function __construct(string $name)
    {
        $this->attributes['name'] = $name;
        $this->setId($name);
        $this->setLabelFor($name);
    }
    
    /**
     * @param string $attrName
     * @return string
     */ 
    public function get(string $attrName): string {
        return $this->attributes[$attrName] ?? "";
    }
    
    /**
     * @param string $attrName
     * @param $value
     * @return Field
     */
    public function set(string $attrName, $value): Field {
        if(isset($this->attributes[$attrName])){
            $this->attributes[$attrName] = $value;
        }
        
        return $this;
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
    public function getType(): string {
        return $this->attributes['type'];
    }


    /**
     * @return string
     */
    public function getId(): string {
        return $this->attributes['id'];
    }


    /**
     * @return string
     */
    public function getClass(): string {
        return $this->attributes['class'];
    }


    /**
     * @return string
     */
    public function getValue(): string {
        return $this->attributes['value'];
    }


    /**
     * @return string
     */
    public function getAlt(): string {
        return $this->attributes['alt'];
    }


    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->attributes['title'];
    }


    /**
     * @return string
     */
    public function getPlaceholder(): string {
        return $this->attributes['placeholder'];
    }


    /**
     * @return string
     */
    public function getRequired(): string {
        return $this->attributes['required'];
    }


    /**
     * @return string
     */
    public function getForm(): string {
        return $this->attributes['form'];
    }


    /**
     * @return string
     */
    public function getMaxlength(): string {
        return $this->attributes['maxlength'];
    }


    /**
     * @return string
     */
    public function getMinlength(): string {
        return $this->attributes['minlength'];
    }


    /**
     * @return string
     */
    public function getMax(): string {
        return $this->attributes['max'];
    }


    /**
     * @return string
     */
    public function getMin(): string {
        return $this->attributes['min'];
    }

    /**
     * @return string
     */
    public function getRows(): string {
        return $this->attributes['rows'];
    }

    /**
     * @return string
     */
    public function getCols(): string {
        return $this->attributes['cols'];
    }


    /**
     * @return string
     */
    public function getWidth(): string {
        return $this->attributes['width'];
    }


    /**
     * @return string
     */
    public function getHeight(): string {
        return $this->attributes['height'];
    }


    /**
     * @return string
     */
    public function getDisabled(): string {
        return $this->attributes['disabled'];
    }

    /**
     * @return string
     */
    public function getReadonly(): string {
        return $this->attributes['readonly'];
    }


    /**
     * @return string
     */
    public function getAutofocus(): string {
        return $this->attributes['autofocus'];
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
    public function getStep(): string {
        return $this->attributes['step'];
    }


    /**
     * @return string
     */
    public function getSize(): string {
        return $this->attributes['size'];
    }


    /**
     * @return string
     */
    public function getSelected(): string {
        return $this->attributes['selected'];
    }


    /**
     * @return string
     */
    public function getSrc(): string {
        return $this->attributes['src'];
    }


    /**
     * @return string
     */
    public function getMultiple(): string {
        return $this->attributes['multiple'];
    }


    /**
     * @return string
     */
    public function getPattern(): string {
        return $this->attributes['pattern'];
    }

    /**
     * @return string
     */
    public function getAccept(): string {
        return $this->attributes['accept'];
    }


    public function getOptionSelected(){
        return $this->optionSelected;
    }
    
    
    /**
     * @param string $name
     * @return Field
     */
    public function setName(string $name): Field {
        $this->attributes['name'] = $name;
        return $this;
    }


    /**
     * @param string $type
     * @return Field
     */
    public function setType(string $type): Field {
        $validType = (in_array($type, self::TYPE_LIST)) ? $type : 'text';
        $this->attributes['type'] = $validType;
        if('textarea' == $validType){
            $this->setRows();
        }
        return $this;
    }


    /**
     * @param string $id
     * @return Field
     */
    public function setId(string $id): Field {
        $this->attributes['id'] = $id;
        $this->setLabelFor($id);
        return $this;
    }


    /**
     * @param string $class
     * @return Field
     */
    public function setClass(string $class): Field {
        $this->attributes['class'] = $class;
        return $this;
    }


    /**
     * @param string $value
     * @return Field
     */
    public function setValue(string $value): Field {
        $this->attributes['value'] = $value;
        return $this;
    }


    /**
     * @param string $alt
     * @return Field
     */
    public function setAlt(string $alt): Field {
        $this->attributes['alt'] = $alt;
        return $this;
    }


    /**
     * @param string $title
     * @return Field
     */
    public function setTitle(string $title): Field {
        $this->attributes['title'] = $title;
        return $this;
    }


    /**
     * @param string $placeholder
     * @return Field
     */
    public function setPlaceholder(string $placeholder): Field {
        $this->attributes['placeholder'] = $placeholder;
        return $this;
    }


    /**
     * @param bool $required
     * @return Field
     */
    public function setRequired(bool $required = true): Field {
        $this->attributes['required'] = $required ? 'required' : '';
        return $this;
    }


    /**
     * @param string $form
     * @return Field
     */
    public function setForm(string $form): Field {
        $this->attributes['form'] = $form;
        return $this;
    }


    /**
     * @param string $maxlength
     * @return Field
     */
    public function setMaxlength(string $maxlength): Field {
        $this->attributes['maxlength'] = $maxlength;
        return $this;
    }


    /**
     * @param string $minlength
     * @return Field
     */
    public function setMinlength(string $minlength): Field {
        $this->attributes['minlength'] = $minlength;
        return $this;
    }


    /**
     * @param string $max
     * @return Field
     */
    public function setMax(string $max): Field {
        $this->attributes['max'] = $max;
        return $this;
    }


    /**
     * @param string $min
     * @return Field
     */
    public function setMin(string $min): Field {
        $this->attributes['min'] = $min;
        return $this;
    }

    /**
     * @param int $rows
     * @return Field
     */
    public function setRows(int $rows = 10): Field {
        $this->attributes['rows'] = $rows;
        return $this;
    }

    /**
     * @param int $cols
     * @return Field
     */
    public function setCols(int $cols = 10): Field {
        $this->attributes['cols'] = $cols;
        return $this;
    }


    /**
     * @param string $width
     * @return Field
     */
    public function setWidth(string $width): Field {
        $this->attributes['width'] = $width;
        return $this;
    }


    /**
     * @param string $height
     * @return Field
     */
    public function setHeight(string $height): Field {
        $this->attributes['height'] = $height;
        return $this;
    }


    /**
     * @param bool $disabled
     * @return Field
     */
    public function setDisabled(bool $disabled = true): Field {
        $this->attributes['disabled'] = (true === $disabled);
        return $this;
    }


    /**
     * @param bool $readonly
     * @return Field
     */
    public function setReadonly(bool $readonly = true): Field {
        $this->attributes['readonly'] = (true === $readonly);
        return $this;
    }


    /**
     * @param bool $autofocus
     * @return Field
     */
    public function setAutofocus(bool $autofocus = true): Field {
        $this->attributes['autofocus'] = (true === $autofocus);
        return $this;
    }


    /**
     * @param bool $autocomplete
     * @return Field
     */
    public function setAutocomplete(bool $autocomplete = true): Field {
        $this->attributes['autocomplete'] = (true === $autocomplete);
        return $this;
    }


    /**
     * @param string $step
     * @return Field
     */
    public function setStep(string $step): Field {
        $this->attributes['step'] = $step;
        return $this;
    }


    /**
     * @param string $size
     * @return Field
     */
    public function setSize(string $size): Field {
        $this->attributes['size'] = $size;
        return $this;
    }


    /**
     * @param bool $selected
     * @return Field
     */
    public function setSelected(bool $selected = true): Field {
        $this->attributes['selected'] = (true === $selected);
        return $this;
    }


    /**
     * @param string $src
     * @return Field
     */
    public function setSrc(string $src): Field {
        $this->attributes['src'] = $src;
        return $this;
    }


    /**
     * @param bool $multiple
     * @return Field
     */
    public function setMultiple(bool $multiple = true): Field {
        $this->attributes['multiple'] = (true === $multiple);
        return $this;
    }


    /**
     * @param string $pattern
     * @return Field
     */
    public function setPattern(string $pattern): Field {
        $this->attributes['pattern'] = $pattern;
        return $this;
    }
    
    
    /**
     * @return string
     */
    public function getLabel(): string {
        $ret = ("" != $this->label['content']) ? $this->label['content'] : $this->getName();
        return $ret;
    }
    
    
    /**
     * @param string $label
     * @return Field
     */
    public function setLabel(string $label): Field {
        $this->label['content'] = ucwords(strtolower($label));
        return $this;
    }
    
    
    /**
     * @param bool $show
     * @return Field
     */
    public function showLabel(bool $show = true): Field {
        $this->showLabel = $show;
        return $this;
    }
    
    
    /**
     * @return string
     */
    public function getLabelId(): string {
        return $this->label['id'];
    }
    
    
    /**
     * @param string $id
     * @return Field
     */
    public function setLabelId(string $id): Field {
        $this->label['id'] = $id;
        return $this;
    }
    
    
    /**
     * @return string
     */
    public function getLabelFor(): string {
        return $this->label['for'];
    }
    
    
    /**
     * @param string $for
     * @return Field
     */
    public function setLabelFor(string $for): Field {
        $this->label['for'] = $for;
        return $this;
    }
    
    
    /**
     * @return string
     */
    public function getLabelForm(): string {
        return $this->label['form'];
    }
    
    
    /**
     * @param string $form
     * @return Field
     */
    public function setLabelForm(string $form): Field {
        $this->label['form'] = $form;
        return $this;
    }

    /**
     * @param string $accept
     * @return Field
     */
    public function setAccept(string $accept): Field {
        $this->attributes['accept'] = $accept;
        return $this;
    }
    
    
    /**
     * @return string
     */
    public function getLabelAccesskey(): string {
        return $this->label['accesskey'];
    }
    
    
    /**
     * @param string $accesskey
     * @return Field
     */
    public function setLabelAccesskey(string $accesskey): Field {
        $this->label['accesskey'] = $accesskey;
        return $this;
    }

    
    public function setOptions(array $options, $selected = null){
        $this->selectOptions = $options;
        if(!is_null($selected)){
            $this->setOptionSelected($selected);
        }
        return $this;
    }

    public function setOptionSelected($optionSelected){
        $this->optionSelected = $optionSelected;
        return $this;
    }

    public function renderAttr(){
        
        switch($this->getType()){
            case 'textarea': $Attributes = $this->getTextAreaAttr();
            break;
            case 'select': $Attributes = $this->getSelectAttr();
            break;
            default: $Attributes = $this->attributes;
            break;
        }

        $renderAttributes = [];
        foreach ($Attributes as $attribute => $value){
            if("" != $value and !is_array($value)){
                if(true === $value){
                    $renderAttributes[] = "$attribute";
                } else {
                    $renderAttributes[] = "$attribute='$value'";
                }
            }
        }

        return implode(" ", $renderAttributes);
    }


    public function getSelectAttr(){
        $allowedAttributes = ['name', 'id', 'class', 'required', 'readonly', 'form'];
        $attr = [];
        foreach($this->attributes as $key => $value){
            if(in_array($key, $allowedAttributes)){
                $attr[$key] = $value;
            }
        }

        return $attr;
    }

    public function getTextAreaAttr(){
        $allowedAttributes = ['name', 'id', 'cols', 'rows', 'class', 'maxlength', 'placeholder', 'required', 'wrap', 'readonly', 'form'];
        $attr = [];
        foreach($this->attributes as $key => $value){
            if(in_array($key, $allowedAttributes)){
                $attr[$key] = $value;
            }
        }

        return $attr;
    }

    
    public function renderLabel(){
        $renderAttributes = [];        
        foreach ($this->label as $attribute => $value){
            if("" != $value and 'content' != $attribute){
                $renderAttributes[] = "$attribute='$value'";
            }
        }

        return "\t\t<label " . implode(" ", $renderAttributes) . ">".$this->getLabel()."</label>\n";        
    }
        
    
    /**
     * @return string
     */
    public function render(): string {
        $ret = "";        
        
        if($this->showLabel){
            $ret .= $this->renderLabel();
        }

        switch($this->getType()){
            case 'textarea': $ret .= $this->renderTextArea();
                break;
            case 'select': $ret .= $this->renderSelect();
                break;
            case 'date': $ret .= $this->renderDate();
                break;
            default: $ret .= "\t\t<input " . $this->renderAttr() . "/>\n";
                break;
        }        
        
        return "\t<div class='form-group'>\n{$ret}\t</div>\n";
    }


    public function renderTextArea()
    {
        $value = $this->getValue() ?? "";
        $ret = "\t\t<textarea " . $this->renderAttr() . ">{$value}</textarea>\n";
        return $ret;
    }

    public function renderDate()
    {
        if("" != $this->getValue()){
            $value = date('Y-m-d', strtotime($this->getValue()));
            $this->setValue($value);
        }
        
        return "\t\t<input " . $this->renderAttr() . "/>\n";
    }

    

    public function renderOptions(){
        $ret = "";
        $selectedCompare = $this->getOptionSelected() ?? $this->getValue();

        foreach($this->selectOptions as $key => $value){
            $selected = "";
            if($selectedCompare == $key){
                $selected = "selected";
            }
            $ret .= "\t\t\t<option value='{$key}' {$selected}>{$value}</option>\n";
        }

        return $ret;
    }

    public function renderSelect(){
        $options = $this->renderOptions();
        $ret = "\t\t<select " . $this->renderAttr() . " >
        {$options}
        </select>\n";
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
            if("" != $value){
               $paramList[$attributes] = $value;
            }
        }
        
        $paramLabel = [];
        foreach($this->label as $attributes => $value) {
            if("" != $value){
               $paramLabel[$attributes] = $value;
            }
        }
        
        $paramList['label'] = $paramLabel;
        return json_encode($paramList);
    }
    
    
    /**
     * @return array
     */
    public function toArray(): array{
        return json_decode($this->toJson(), true);
    }

}