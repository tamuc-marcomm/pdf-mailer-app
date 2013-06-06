<?php

class Application_Model_Department extends Strixa_Model_Abstract{
	/*[BEGIN] Constructors and Destructor*/
		public function __construct($data){
			parent::__construct($data,'Application_Model_Table_Departments');
		}
	/*[END] Constructors and Destructor*/
	
	/*[BEGIN] Getter/Setter Methods*/
		public function getContent(){
			$table = new Application_Model_Table_ContentByDepartment();
			$content = array();
			
			
			$content_by_department = $table->fetchAll("d_id = {$this->d_id}");
			foreach($content_by_department as $row){
				$content[] = new Application_Model_Content($row->et_id);
			}
			return $content;
		}
	/*[END] Getter/Setter Methods*/
}