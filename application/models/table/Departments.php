<?php

class Application_Model_Table_Departments extends Zend_Db_Table_Abstract{
	protected $_name = 'departments';

	/**
	 * Return all departments from departments table
	 *
	 * @return Array all department data
	 */

	public static function getAllDepartments() {
		$table = new self();


        $rowset = $table->fetchAll();
        $departments = array();
        foreach($rowset as $row){
            $departments[] = new Application_Model_Department($row);
        }
        return $departments;
	}

	public static function getDepartmentsByParentID($id) {
		$table = new self();

		$rowset = $table->fetchAll("parent = $id");
		$departments = array();
		foreach($rowset as $row) {
			$departments[] = new Application_Model_Department($row);

		}
		return $departments;
	}
}