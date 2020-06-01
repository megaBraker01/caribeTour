<?php

class FormHandler {

    protected $tableName = "";
    protected $form = null;
    protected $fieldMap = [];
    protected $fieldList = [];
    protected $fieldSetList = [];
    private $isNewRecord = true;

    public function __construct(string $tableName = '', $readOnly = true, $isNewRecord = true)
    {
        $this->tableName = $tableName;
        $this->fieldMap = $this->getInfoFromTable($tableName);
        $this->form = new Form;
        
        $this->getForm()->setMethod('post')//->setAccept('image/png, image/jpeg')
            ->setEnctype('multipart/form-data')->setReadOnly($readOnly);

        $this->setIsNewRecord($isNewRecord);
        $this->fillFieldList();
    }


    public function getForm()
    {
        return $this->form;
    }


    public function getInfoFromTable(string $tableNameParam = '')
    {
        try{

            $tableName = '' == $tableNameParam ? $this->tableName : $tableNameParam;
            
            if('' == $tableName or !is_string($tableName)){
                Throw new Exception("[ERROR] '{$tableName}' NO es un valor valido");
            }
            
            $sql = "DESCRIBE {$tableName}";
            $conexion = new Conexion();
            $statement = $conexion->pdo()->prepare($sql);
                        
            $ret = [];
            if($statement->execute() and $statement->rowCount() > 0){
                $ret = $statement->fetchAll(PDO::FETCH_ASSOC);
            }
            
            $conexion = NULL;
            $statement->closeCursor();
            
            return $ret;

        } catch (Exception $ex){
            echo "[ERROR] -> {$ex->getMessage()} [ERROR CODE] -> {$ex->getCode()}";
        }
    }
    
    public function getFieldsMap(){
        return $this->fieldMap;
    }

    public function getFieldList(){
        return $this->fieldList;
    }

    public function getFieldSetList()
    {
        return $this->fieldSetList;
    }

    
    public function cleanType($type)
    {
        $find = '(';
        $newType = !strpos($type, $find) ? $type : strstr($type, $find, true);
        switch ($newType) {
            case "int": case "tinyint": case "smallint":
            case "mediumint": case "bigint": 
                $ret = "number";
                break;
            case "varchar": case "char": case "tinytext":  
            case "decimal": case "float": case "double": case "real":
                $ret = "text";
                break;
            case "text": case "mediumtext": case "longtext":
                $ret = "textarea";
                break;
            case "date": case "datetime":
            case "timestamp": case "time": case "year":
                $ret = "date";
                break;
            default :
                $ret = "text";
                break;
        }

        return $ret;
    }

    /**
     * rellena la lista actual de los campos con los objetos Field
     */
    public function fillFieldList() 
    {
        $fieldList = [];
        foreach($this->getFieldsMap() as $fieldForm){
            $field = new Field($fieldForm['Field']);
            $field->setType($this->cleanType($fieldForm['Type']))
                ->showLabel()->setClass('form-control');
            $fieldList[] = $field;
        }

        $this->fieldList = $fieldList;
        return $this;
    }

    public function addField($fieldName, $type = 'text')
    {
        $field = new Field($fieldName);
        $field->setType($type);
        $this->fieldList[] = $field;
        return $this;
    }

    /**
     * setea el array asociativo con los nombres de los campos y su valor
     */
    public function setValues(array $fieldValues)
    {
        if(empty($fieldValues)){
            Throw new Exception('[ERROR] el fieldValues NO puede estar vacío');
        }

        foreach($this->getFieldList() as $field){
            $fieldName = $field->getName();
            $value = isset($fieldValues[$fieldName]) ? $fieldValues[$fieldName] : "";
            $field->setValue($value);
        }

        return $this;
    }
    

    /**
     * setea el valor del campo indicado
     * 
     */
    public function setFieldValue(string $fieldName, $value)
    {
        foreach($this->getFieldList() as $field){
            if($field->getName() == $fieldName){
                $field->setValue($value);
            }
        }

        return $this;
    }

    public function setFieldType(string $fieldName, $type = 'text')
    {
        foreach($this->getFieldList() as $field){
            if($field->getName() == $fieldName){
                $field->settype($type);
            }
        }

        return $this;
    }

    public function setFieldsReadOnly($fieldsReadOnly)
    {
        foreach($this->getFieldList() as $field){
            if(in_array($field->getName(), $fieldsReadOnly)){
                $field->setReadonly();
            }
        }

        return $this;
    }

    public function setFieldsTypeTextarea($fieldsTextarea)
    {
        foreach($this->getFieldList() as $field){
            if(in_array($field->getName(), $fieldsTextarea)){
                $field->settype('textarea');
            }
        }

        return $this;
    }

    public function setFieldsTypeSelect($fieldsSelect)
    {
        foreach($this->getFieldList() as $field){
            if(in_array($field->getName(), $fieldsSelect)){
                $field->settype('select');
            }
        }

        return $this;
    }


    public function setFieldsTypeFile($fieldsFile)
    {
        foreach($this->getFieldList() as $field){
            if(in_array($field->getName(), $fieldsFile)){
                $field->settype('file');
            }
        }

        return $this;
    }

    public function setFieldsTypeImgFile($fieldsImagen)
    {
        foreach($this->getFieldList() as $field){
            if(in_array($field->getName(), $fieldsImagen)){
                $field->settype('file')->setAccept('image/png, image/jpeg');
            }
        }

        return $this;
    }

    public function setFieldsTypeHidden($fieldsHidden)
    {
        foreach($this->getFieldList() as $field){
            if(in_array($field->getName(), $fieldsHidden)){
                $field->settype('hidden');
            }
        }

        return $this;
    }

    public function setFieldOptions($fieldName, $options)
    {
        foreach($this->getFieldList() as $field){
            if($field->getName() == $fieldName){
                $field->settype('select')->setOptions($options);
            }
        }

        return $this;
    }
    
    public function setIsNewRecord($isNewRecord){
        $this->isNewRecord = $isNewRecord;
        return $this;
    }

    /**
     * Introduce los campos en un fieldSet
     * @param int $fieldCount indica la cantidad de campos que serán incluidos en el fieldSet
     * @return $this
     */
    public function setFieldIntoFieldset(int $fieldCount = 7)
    {
        $i = 1;
        foreach($this->getFieldList() as $field){
            $fields[] = $field;	
            if($i++ % $fieldCount == 0){
                $fieldSet = new Fieldset();
                $fieldSets[] = $fieldSet->setFields($fields)->setClass('col-xs-6');
                $fields = [];
            }
        }

        $fieldSet = new Fieldset();
        $fieldSets[] = $fieldSet->setFields($fields)->setClass('col-xs-6');
        $this->fieldSetList = $fieldSets;
        return $this;        
    }

    public function renderForm()
    {
        $form = $this->getForm();
        $fieldSets = $this->fieldSetList;
        
        if(!$this->getForm()->getReadOnly()){            
            $fieldName = 'Guardar';
            $fielClass = 'btn btn-success input-medium';
            $fieldsave = new Field($fieldName);
            $fieldsave->setType('submit')->setClass($fielClass)->setValue($fieldName)->setTitle($fieldName);
            $fieldList = [$fieldsave];
            // añadimos un campo para indicar que si es nuevo
            if($this->isNewRecord){
                $isNewRecordField = new Field('isNewRecord');
                $isNewRecordField->setType('hidden');
                $fieldList[] = $isNewRecordField;
            }
            $saveFieldSet = new Fieldset();
            $saveFieldSet->setClass('col-xs-12')->setFields($fieldList);
            $fieldSets[] = $saveFieldSet;
        }
        
        $form->setFieldsets($fieldSets);

        return $form->render();
    }

}