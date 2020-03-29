<?php

class TableToForm {

    protected $tableName = "";
    protected $form = null;
    protected $fieldMap = [];
    protected $fieldList = [];
    protected $fieldSetList = [];

    public function __construct(string $tableName = '')
    {
        $this->tableName = $tableName;
        $this->fieldMap = $this->getInfoFromTable($tableName);
        $this->form = new Form;
    }


    public function getForm(){
        return $this->form;
    }


    public function getInfoFromTable(string $tableNameParam = ''){
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

    public function fillFieldList() 
    {
        $fieldList = [];
        foreach($this->getFieldsMap() as $fieldForm){
            $field = new Field($fieldForm['Field']);
            $field->setType($this->cleanType($fieldForm['Type']))
                ->setValue($fieldForm['Value'])->showLabel()->setClass('form-control');
            $fieldList[] = $field;
        }

        $this->fieldList = $fieldList;
        return $this;
    }

    /**
     * setea el array asociativo con los nombres de los campos y su valor
     */
    public function setValues(array $fieldValues){
        if(empty($fieldValues)){
            Throw new Exception('[ERROR] el fieldValues NO puede estar vacío');
        }

        $newFieldMap = [];
        //var_dump($this->getFieldsMap());
        foreach($this->getFieldsMap() as $field){
            $fieldName = $field['Field'];
            $field['Value'] = isset($fieldValues[$fieldName]) ? $fieldValues[$fieldName] : "";            
            $newFieldMap[] = $field;
        }

        $this->fieldMap = $newFieldMap;
        $this->fillFieldList();
        return $this;
    }
    

    /**
     * setea el valor del campo indicado
     * 
     */
    public function setFieldValue(string $fieldName, $value){
        $newFieldMap = [];
        foreach($this->getFieldsMap() as $field){
            if($fieldName === $field['Field']){
                $field['Value'] = $value;
            }          
            $newFieldMap[] = $field;
        }

        $this->fieldMap = $newFieldMap;
        return $this;
    }

    public function setFieldType(string $fieldName, $type = 'text'){
        foreach($this->getFieldList() as $field){
            if($field->getName() == $fieldName){
                $field->settype($type);
            }
        }
        return $this;
    }

    public function setFielsReadOnly($fieldsReadOnly)
    {
        foreach($this->getFieldList() as $field){
            if(in_array($field->getName(), $fieldsReadOnly)){
                $field->setReadonly();
            }
        }
        return $this;
    }

    public function setFielsTypeTextarea($fieldsTextarea)
    {
        foreach($this->getFieldList() as $field){
            if(in_array($field->getName(), $fieldsTextarea)){
                $field->settype('textarea');
            }
        }
        return $this;
    }

    public function setFielsTypeSelect($fieldsSelect)
    {
        foreach($this->getFieldList() as $field){
            if(in_array($field->getName(), $fieldsSelect)){
                $field->settype('select');
            }
        }
        return $this;
    }

    public function setFieldOptions($fieldName, $options)
    {
        foreach($this->getFieldList() as $field){
            if($field->getName() == $fieldName){
                $field->setOptions($options);
            }
        }
        return $this;
    }

    public function setFieldIntoFieldset($fieldCount = 7)
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
        if(!empty($fieldSets)){
            $form->setFieldsets($fieldSets);
        } else {
            $form->setFields($this->fieldList);
        }
        $fieldsave = new Field('Guardar');
        $fieldsave->setType('submit')->setClass('btn btn-success')->setValue('Guardar')->setTitle('Guardar');
        $form->setFields([$fieldsave]);

        return $form->render();
    }

    
}