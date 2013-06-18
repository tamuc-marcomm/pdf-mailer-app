<?php

class Application_Model_Table_Colleges extends Zend_Db_Table_Abstract{
    protected $_name = 'colleges';


    public static function getAllColleges() {
		$table = new self();


        $rowset = $table->fetchAll();
        $colleges = array();
        foreach($rowset as $row){
            $colleges[] = new Application_Model_Colleges($row);
        }
        return $colleges;
	}
}