<?php
class Admin_ResourceController extends Zend_Controller_Action{
    public function init(){
		$this->_helper->layout->setLayout('layout_admin');
	}

	public function deleteAction(){
		$id = $this->getRequest()->getParam('id');


		if($id == null){
			throw new Zend_Controller_Action_Exception('A model id must be supplied when navigating to this action.',404);
		}
		try{
			$table = new Application_Model_Table_Resources();
			$table->delete("id = $id");
		}catch(Zend_Exception $e){
			throw new Zend_Controller_Action_Exception('The model for that id could not be found.',404);
		}
		$this->_helper->redirector('index');
	}

	public function editAction(){
		$id = $this->getRequest()->getParam('id');


		$table = new Application_Model_Table_Resources();
		$this->view->departments = Application_Model_Table_Departments::getAllDepartments();
		if($this->getRequest()->getParam('new',false)){
			$this->view->id = 0;
			$this->view->resource = $table->createRow();
		}else{
			if($id == null){
				throw new Zend_Controller_Action_Exception('A model id must be supplied when navigating to this action.',404);
			}

			$this->view->id = $id;
			$this->view->resource = $table->fetchRow("id = $id");
			if($this->view->resource == null){
				throw new Zend_Controller_Action_Exception('The model for that id could not be found.',404);
			}
		}
	}

	public function doeditAction(){
		$id = $this->getRequest()->getParam('id');


		$data = array(
			'name' => $this->getRequest()->getParam('name'),
			'parent' => $this->getRequest()->getParam('parent'),
			'email_subject' => $this->getRequest()->getParam('email_subject'),
			'email_body' => $this->getRequest()->getParam('email_body'),
			'pdf_link' => $this->getRequest()->getParam('pdf_link')
		);

		if($id == 0){
			new Application_Model_Resource($data);
		}else{
			$table = new Application_Model_Table_Resources();
			$table->update($data, "id = $id");
		}
		$this->_helper->redirector->gotoRouteAndExit(array('controller' => 'resource', 'module' => 'admin', 'action' => 'index'), null, true);
	}

    public function indexAction(){
    	$id = $this->getRequest()->getParam('id');


    	if($id == null){
    		$this->view->resources = Application_Model_Table_Resources::getAllResources();
    	}else{
	    	try{
	    		$department = new Application_Model_Department($id);
	    		$this->view->resources = $department->getResources();
			}catch(Zend_Exception $e){
				throw new Zend_Controller_Action_Exception('The model for that id could not be found.',404);
			}
    	}
    }

}