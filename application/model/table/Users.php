<?php

class Application_Model_Table_Users extends Zend_Db_Table_Abstract{
    protected $_name = 'users';


    public static function getAllUsers(){
    	$table = new self();


		$rowset = $table->fetchAll();
		$users = array();
		foreach($rowset as $row){
			$users[] = new Application_Model_User($row);
		}
		return $users;
	}
}