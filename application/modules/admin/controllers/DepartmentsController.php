<?php
class Admin_DepartmentsController extends Zend_Controller_Action{
    public function init(){
		$this->_helper->layout->setLayout('layout_admin');
	}

	public function deleteAction(){
		$id = $this->getRequest()->getParam('id');


		if($id == null){
			throw new Zend_Controller_Action_Exception('A model id must be supplied when navigating to this action.',404);
		}

		try{
			$table = new Application_Model_Table_Departments();
			$table->delete(array("id = ?",$id));
		}catch(Zend_Exception $e){
			throw new Zend_Controller_Action_Exception('The model for that id could not be found.',404);
		}
	}

	public function editAction(){
		$id = $this->getRequest()->getParam('id');


		$table = new Application_Model_Table_Departments();
		$this->view->colleges = Application_Model_Table_Colleges::getAllColleges();
		if($this->getRequest()->getParam('new',false)){
			$This->view->id = 0;
			$this->view->resource = $table->createRow();
		}else{
			if($id == null){
				throw new Zend_Controller_Action_Exception('A model id must be supplied when navigating to this action.',404);
			}

			$this->view->id = $id;
			$this->view->department = $table->fetchRow("id = $id");
			if($this->view->department == null){
				throw new Zend_Controller_Action_Exception('The model for that id could not be found.',404);
			}
		}
	}

	public function doeditAction(){
		$id = $this->getRequest()->getParam('id');


		$data = array(
			'name' => $this->getRequest()->getParam('name'),
			'parent' => $this->getRequest()->getParam('parent')
		);


		if($id == 0){
			new Application_Model_Department($data);
		}else{
			$table = new Application_Model_Table_Departments();
			$table->update($data,array('id = ?',$id));
		}
	}

    public function indexAction(){
    	$id = $this->getRequest()->getParam('id');


    	if($id == null){
    		$this->view->departments = Application_Model_Table_Departments::getAllDepartments();
    	}else{
	    	try{
	    		$college = new Application_Model_College($id);
	    		$this->view->departments = $college->getResources();
			}catch(Zend_Exception $e){
				throw new Zend_Controller_Action_Exception('The model for that id could not be found.',404);
			}
    	}
    }

}