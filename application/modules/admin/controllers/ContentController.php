<?php
class Admin_ContentController extends Zend_Controller_Action{
    public function init(){
		$this->_helper->layout->setLayout('layout_admin');
	}

	public function addAction(){}
	
	public function editAction(){
		$departments = new Application_Model_Table_Departments;
		
		$this->view->departments = $departments->getAllDepartments();
	}
	
<<<<<<< HEAD
    public function indexAction(){
    	$departments = new Application_Model_Table_departments;

    	$this->view->departments = $departments->getAllDepartments();
    }
=======
	public function doeditAction(){}
	
    public function indexAction(){}
>>>>>>> f5032723b31c2ec9a2afe97952d698f26015ca9c
}