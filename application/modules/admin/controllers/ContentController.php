<?php
class Admin_ContentController extends Zend_Controller_Action{
    public function init(){
		$this->_helper->layout->setLayout('layout_admin');
	}

	public function addAction(){
	}
	
	public function deleteAction(){
		$id = $this->getRequest()->getParam('id');


		if($id == null){
			throw new Zend_Controller_Action_Exception('A model id must be supplied when navigating to this action.',404);
		}

		try{
			$this->view->user = new Application_Model_Content($id);
		}catch(Zend_Exception $e){
			throw new Zend_Controller_Action_Exception('The model for that id could not be found.',404);
		}
	}

	public function editAction(){
		$id = $this->getRequest()->getParam('id');


		if($id == null){
			throw new Zend_Controller_Action_Exception('A model id must be supplied when navigating to this action.',404);
		}

		try{
			$this->view->user = new Application_Model_Content($id);
		}catch(Zend_Exception $e){
			throw new Zend_Controller_Action_Exception('The model for that id could not be found.',404);
		}
	}

    public function indexAction(){
    	$this->view->departments = Application_Model_Table_Departments::getAllDepartments();
    }

}