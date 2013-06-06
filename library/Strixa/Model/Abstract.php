<?php
abstract class Strixa_Model_Abstract{
	private $row;
    private $typed_data;
	
	
	public function __construct($data,$db_class){
        if($data == null){
            $data = array();
        }
        
		if($data instanceof Zend_Db_Table_Row){
			$this->row=$data;
		}else if(is_numeric($data)){
			if(empty($db_class)){
				throw new Zend_Exception("The db_class parameter must be given when getting a model by its id.");
			}
			
			$table = new $db_class();
			$primary_key = $table->info('primary');
			$row = $table->fetchRow($primary_key[1].'='.$data);
			if($row == NULL){
				throw new Strixa_Model_Exception("The model for that id could not be found.  Table Class:  $db_class.  Query:  {$primary_key[1]}=$data");
			}
			$this->row = $row;
		}else if(is_array($data)){
            if(empty($db_class)){
				throw new Zend_Exception("The db_class parameter must be given when creating a new model.");
			}
            $table = new $db_class();
            
            $this->__construct($table->insert($data),$db_class);
        }
        
        $this->__regenerateTypedData();
	}
    
    public function __destruct(){
        $this->row->save();
    }
    
    /*Begin Other Functions*/	
	public function get($column_name = ''){
        if($this->row == null){
            throw new Strixa_Model_Exception('Row data empty while attempting to get column data.  The cause is usually an invalid constructor call.');
        }
		
		if(!empty($column_name)){
			if(isset($this->typed_data["$column_name"])){
				$data = $this->typed_data["$column_name"];
			}else{
				throw new Strixa_Model_Exception("Column with name '$column_name' not found.");
			}
		}else{
            $data = $this->typed_data;
        }
		return $data;
	}
	
	public function __get($variable_name){
		return $this->get($variable_name);
	}
    
    private function __regenerateTypedData(){
        $this->typed_data = $this->row->toArray();
        $data_type = NULL;
        $metadata=$this->row->getTable()->info('metadata');
        
        
        //Convert all the data to their proper, database value
        foreach($this->typed_data as $key=>$element){
            switch($metadata[$key]['DATA_TYPE']){
                case "char":
                case "varchar":
                case "text":
                    $data_type = "string";
                    break;
                
                case "int":
                case "tinyint":
                    $data_type = "integer";
                    break;
                
                default:
                    $data_type = $metadata[$key]['DATA_TYPE'];
                    
                    //Test for special cases
                    if(substr($data_type,0,4) == 'enum'){
                        $data_type = 'string';
                    }
                    
                    break;
            }
            
            settype($element,$data_type);
            $this->typed_data[$key] = $element;
        }
    }
	
	public function set($column_name,$data){
        if($this->row == null){
            throw new Strixa_Model_Exception('Row data empty while attempting to get column data.  The cause is usually an invalid constructor call.');
        }
        
		$this->row->$column_name = $data;
        $this->typed_data["$column_name"] = $data;
	}
	
	public function __set($variable_name,$value){
		$this->set($variable_name,$value);
	}
}