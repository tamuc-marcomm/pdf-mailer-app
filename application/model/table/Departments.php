<?php

class Application_Model_Table_Departments extends Zend_Db_Table_Abstract{
<<<<<<< HEAD
	protected $_name = 'departments';

	/**
	 * Return all departments from departments table
	 *
	 * @return Array all department data
	 */

	public function getAllDepartments() {

		$query = $this->fetchAll();
		$departments = array();

		foreach ($query as $department) {
			$departments[] = new Application_Model_Department($department);
		}
		return $departments;
	}
=======
    protected $_name = 'departments';
>>>>>>> f5032723b31c2ec9a2afe97952d698f26015ca9c
}