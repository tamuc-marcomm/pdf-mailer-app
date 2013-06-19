<?php

class Application_Model_Department extends Strixa_Model_Abstract{
    /*[BEGIN] Constructors and Destructor*/
        public function __construct($data){
            parent::__construct($data,'Application_Model_Table_Departments');
        }
    /*[END] Constructors and Destructor*/

    /*[BEGIN] Getter/Setter Methods*/
        public function getContent(){
            $table = new Application_Model_Table_Content();
            $content = array();
            
            
            $rowset = $table->fetchAll("parent = {$this->id}");
            foreach($rowset as $row){
                $content[] = new Application_Model_Content($row);
            }
            return $content;
        }
    /*[END] Getter/Setter Methods*/
}