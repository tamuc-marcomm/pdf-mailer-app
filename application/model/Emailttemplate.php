<?php

class Application_Model_Emailtemplate extends Strixa_Model_Abstract{
	/*[BEGIN] Constructors and Destructor*/
		public function __construct($data){
			parent::__construct($data,'Application_Model_Table_Emailtemplates');
		}
	/*[END] Constructors and Destructor*/
}