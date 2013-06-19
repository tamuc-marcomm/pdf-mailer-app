<?php

class Application_Model_Table_Resources extends Zend_Db_Table_Abstract{
    protected $_name = 'resources';


    public static function getAllResources(){
    	$table = new self();


		$rowset = $table->fetchAll();
		$resources = array();
		foreach($rowset as $row){
			$resources[] = new Application_Model_Resource($row);
		}
		return $resources;
	}
}