<?php

class Application_Model_User extends Strixa_Model_Abstract{
	/*[BEGIN] Constructors and Destructor*/
		public function __construct($data){
			parent::__construct($data,'Application_Model_Table_Users');
		}
	/*[END] Constructors and Destructor*/
	
	/*[BEGIN] Getter/Setter Methods*/
		public function isAdmin(){
			return $this->is_admin;
		}
	/*[END] Getter/Setter Methods*/
}