<?php

class Application_Model_College extends Strixa_Model_Abstract{
    /*[BEGIN] Constructors and Destructor*/
        public function __construct($data){
            parent::__construct($data,'Application_Model_Table_Colleges');
        }
    /*[END] Constructors and Destructor*/
    
    /*[BEGIN] Getter/Setter Methods*/
        public function getDepartments(){
            $table = new Application_Model_Table_Departments();
            $departments = array();
            
            
            $department_rows = $table->fetchAll("d_id = {$this->d_id}");
            foreach($department_rows as $department_row){
                $departments[] = new Application_Model_Department($department_row->d_id);
            }
            return $departments;
        }
    /*[END] Getter/Setter Methods*/
}