<?php
class Admin_UsersController extends Zend_Controller_Action {
    
    public function init(){
		$this->_helper->layout->setLayout('layout_admin');
	}

	public function indexAction() {
    	$this->view->users = Application_Model_Table_Users::getAllUsers();
	}

	public function editAction() {
		$id = $this->getRequest()->getParam('id');
		
		$table = new Application_Model_Table_users();
		if($this->getRequest()->getParam('new', false)) {
			$this->view->id = 0;
			$this->view->user = $table->createRow();
		}
		else {
			if ($id == null) {
				throw new Zend_Controller_Action_Exception('A model id must be supplied when navigating to this action.', 404);
			}
			$this->view->id = $id;
			$this->view->user = $table->fetchRow("id = $id");
			if ($this->view->user == null) {
				throw new Zend_Controller_Action_Exception('The model for that id could not be found.', 404);
			}
		}
	}

	public function doeditAction() {
		$id = $this->getRequest()->getParam('id');

		$data = array(
			'username' => $this->getRequest()->getParam('username'),
			'first_name' => $this->getRequest()->getParam('first_name'),
			'last_name'  => $this->getRequest()->getParam('last_name'),
			'is_admin'   => $this->getRequest()->getParam('is_admin'),
			);

		if ($id == 0) {
			new ApplicatioN_Model_Table_Users($data);
		}
		else {
			$table = new Application_Model_Table_Users();
			$table->update($data, "id = $id");
		}
		$this->_helper->redirector->gotoRouteAndExit(array('controller' => 'Users', 'module' => 'admin', 'action' => 'index'));
	}
}