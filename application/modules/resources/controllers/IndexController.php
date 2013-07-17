<?php
class Resources_IndexController extends Zend_Controller_Action{
    public function init(){
		$this->_helper->layout->setLayout('layout_resources');
	}

    public function indexAction(){
    	$colleges = new Application_Model_Table_Colleges;

    	$this->view->colleges = $colleges->fetchAll();
    }

    public function departmentAction() {
    	$id = $this->getRequest()->getParam('id');

    	$this->view->departments = Application_Model_Table_Departments::getDepartmentsByParentId($id);

    }

    public function resourceAction() {
    	$id = $this->getRequest()->getParam('id');
    	$department = new Application_Model_Department($id);

    	$this->view->department_id = $department->parent;
    	$this->view->resources = Application_Model_Table_Resources::getResourcesByParentId($id);
    }
}