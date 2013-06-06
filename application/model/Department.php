<?php

class Application_Model_Department extends Strixa_Model_Abstract{
	/*[BEGIN] Constructors and Destructor*/
		public function __construct($data){
			parent::__construct($data,'Application_Model_Table_Departments');
		}
	/*[END] Constructors and Destructor*/
	
	/*[BEGIN] Getter/Setter Methods*/
		public function getEmailtemplates(){
			$table = new Application_Model_Table_DepartmentEmailtemplates();
			$templates = array();
			
			
			$templates_by_department = $table->fetchAll("d_id = {$this->d_id}");
			foreach($templates_by_department as $row){
				$templates[] = new Application_Model_Template($row->et_id);
			}
			return $templates;
		}
	/*[END] Getter/Setter Methods*/
}