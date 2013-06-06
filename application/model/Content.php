<?php

class Application_Model_Content extends Strixa_Model_Abstract{
	/*[BEGIN] Constructors and Destructor*/
		public function __construct($data){
			parent::__construct($data,'Application_Model_Table_Content');
		}
	/*[END] Constructors and Destructor*/
}