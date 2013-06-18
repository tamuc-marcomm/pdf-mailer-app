<?php
class Admin_CollegesController extends Zend_Controller_Action{
    public function init(){
		$this->_helper->layout->setLayout('layout_admin');
	}

	public function deleteAction(){
		$id = $this->getRequest()->getParam('id');


		if($id == null){
			throw new Zend_Controller_Action_Exception('A model id must be supplied when navigating to this action.',404);
		}

		try{
			$table = new Application_Model_Table_Colleges();
			$table->delete(array("id = ?",$id));
		}catch(Zend_Exception $e){
			throw new Zend_Controller_Action_Exception('The model for that id could not be found.',404);
		}
	}

	public function editAction(){
		$id = $this->getRequest()->getParam('id');


		$table = new Application_Model_Table_Colleges();
		if($this->getRequest()->getParam('new',false)){
			$This->view->id = 0;
			$this->view->college = $table->createRow();
		}else{
			if($id == null){
				throw new Zend_Controller_Action_Exception('A model id must be supplied when navigating to this action.',404);
			}

			$this->view->id = $id;
			$this->view->college = $table->fetchRow("id = $id");
			if($this->view->college == null){
				throw new Zend_Controller_Action_Exception('The model for that id could not be found.',404);
			}
		}
	}

	public function doeditAction(){
		$id = $this->getRequest()->getParam('id');


		$data = array(
			'name' => $this->getRequest()->getParam('name')
		);


		if($id == 0){
			new Application_Model_College($data);
		}else{
			$table = new Application_Model_Table_Colleges();
			$table->update($data, "id = $id");
		}
		$this->_helper->redirector('index');
	}

    public function indexAction(){
    	$this->view->colleges = Application_Model_Table_Colleges::getAllColleges();
    }

}