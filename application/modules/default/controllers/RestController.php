<?php

class RestController extends Zend_Controller_Action{
	public function collegesAction(){
		$data = array();
		$table = new Application_Model_Table_Colleges();
		
		$id = $this->getRequest()->getParam('id',null);
		
		
		if(empty($id)){
			$data = $table->fetchAll()->toArray();
		}else if(!is_numeric($id)){
			$this->_helper->json(array('status' => 'success','message' => 'First argument passed (College ID) must be a numeric value.'));
		}else if($id < 1){
			$this->_helper->json(array('status' => 'success','message' => 'First argument passed (College ID) must be a value greater than or equal to one.'));
		}else{
			$row = $table->fetchRow("c_id = {$id}");
			if($row !== null){
				$data = $row->toArray();
			}
		}
		
		$this->_helper->json(array('status' => 'success','colleges' => $data));
	}
	
	public function departmentsAction(){
		$data = array();
		$table = new Application_Model_Table_Departments();
		
		$id = $this->getRequest()->getParam('id',null);
		
		
		if(empty($id)){
			$data = $table->fetchAll()->toArray();
		}else if(!is_numeric($id)){
			$this->_helper->json(array('status' => 'success','message' => 'First argument passed (Department ID) must be a numeric value.'));
		}else if($id < 1){
			$this->_helper->json(array('status' => 'success','message' => 'First argument passed (Department ID) must be a value greater than or equal to one.'));
		}else{
			$row = $table->fetchRow("d_id = {$id}");
			if($row !== null){
				$data = $row->toArray();
			}
		}
		
		$this->_helper->json(array('status' => 'success','departments' => $data));
	}
	
	public function departmentsbycollegeAction(){
		$data = array();
		$table = new Application_Model_Table_Departments();
		
		$id = $this->getRequest()->getParam('id',null);
		
		
		if(empty($id)){
			$this->_helper->json(array('status' => 'success','message' => 'First argument (College ID) is required.'));
		}else if(!is_numeric($id)){
			$this->_helper->json(array('status' => 'success','message' => 'First argument passed (College ID) must be a numeric value.'));
		}else if($id < 1){
			$this->_helper->json(array('status' => 'success','message' => 'First argument passed (College ID) must be a value greater than or equal to one.'));
		}else{
			$data[] = $table->fetchAll("parent={$id}")->toArray();
		}
		
		$this->_helper->json(array('status' => 'success','departments' => $data));
	}
	
	public function emailtemplatesAction(){
		$data = array();
		$table = new Application_Model_Table_Emailtemplates();
		
		$id = $this->getRequest()->getParam('id',null);
		
		
		if(empty($id)){
			$data = $table->fetchAll()->toArray();
		}else if(!is_numeric($id)){
			$this->_helper->json(array('status' => 'success','message' => 'First argument passed (Email Template ID) must be a numeric value.'));
		}else if($id < 1){
			$this->_helper->json(array('status' => 'success','message' => 'First argument passed (Email Template ID) must be a value greater than or equal to one.'));
		}else{
			$row = $table->fetchRow("et_id = {$id}");
			if($row !== null){
				$data = $row->toArray();
			}
		}
		
		$this->_helper->json(array('status' => 'success','emailtemplates' => $data));
	}
	
	public function emailtemplatesbydepartmentAction(){
		$data = array();
		$et_table = new Application_Model_Table_Emailtemplates();
		$det_table = new Application_Model_Table_DepartmentEmailtemplates();
		
		$id = $this->getRequest()->getParam('id',null);
		
		
		if(empty($id)){
			$this->_helper->json(array('status' => 'success','message' => 'First argument (Department ID) is required.'));
		}else if(!is_numeric($id)){
			$this->_helper->json(array('status' => 'success','message' => 'First argument passed (Department ID) must be a numeric value.'));
		}else if($id < 1){
			$this->_helper->json(array('status' => 'success','message' => 'First argument passed (Department ID) must be a value greater than or equal to one.'));
		}else{
			$rowset = $det_table->fetchAll("d_id = {$id}");
			foreach($rowset as $row){
				$data[] = $et_table->fetchRow("et_id={$row->et_id}");
			}
		}
		
		$this->_helper->json(array('status' => 'success','emailtemplates' => $data));
	}

    public function usersAction(){
		$data = array();
		$table = new Application_Model_Table_Users();
		
		$id = $this->getRequest()->getParam('id',null);
		
		
		if(empty($id)){
			$data = $table->fetchAll()->toArray();
		}else if(!is_numeric($id)){
			$this->_helper->json(array('status' => 'success','message' => 'First argument passed (User ID) must be a numeric value.'));
		}else if($id < 1){
			$this->_helper->json(array('status' => 'success','message' => 'First argument passed (User ID) must be a value greater than or equal to one.'));
		}else{
			$row = $table->fetchRow("u_id = {$id}");
			if($row !== null){
				$data = $row->toArray();
			}
		}
		
		$this->_helper->json(array('status' => 'success','users' => $data));
	}
}