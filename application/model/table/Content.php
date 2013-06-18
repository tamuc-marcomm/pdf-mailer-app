<?php

class Application_Model_Table_Content extends Zend_Db_Table_Abstract{
    protected $_name = 'content';


    public static function getAllContent(){
    	$table = new self();


		$rowset = $table->fetchAll();
		$content = array();
		foreach($rowset as $row){
			$content[] = new Application_Model_Content($row);
		}
		return $content;
	}
}