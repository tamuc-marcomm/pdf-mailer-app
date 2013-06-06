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
            $row = $table->fetchRow("id = {$id}");
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
            $row = $table->fetchRow("id = {$id}");
            if($row !== null){
                $data = $row->toArray();
            }
        }
        
        $this->_helper->json(array('status' => 'success','departments' => $data));
    }
    
    public function departmentbycollegeAction(){
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
    
    public function contentAction(){
        $data = array();
        $table = new Application_Model_Table_Content();
        
        $id = $this->getRequest()->getParam('id',null);
        
        
        if(empty($id)){
            $data = $table->fetchAll()->toArray();
        }else if(!is_numeric($id)){
            $this->_helper->json(array('status' => 'success','message' => 'First argument passed (Content ID) must be a numeric value.'));
        }else if($id < 1){
            $this->_helper->json(array('status' => 'success','message' => 'First argument passed (Content ID) must be a value greater than or equal to one.'));
        }else{
            $row = $table->fetchRow("id = {$id}");
            if($row !== null){
                $data = $row->toArray();
            }
        }
        
        $this->_helper->json(array('status' => 'success','content' => $data));
    }
    
    public function contentbydepartmentAction(){
        $data = array();
        $content_table = new Application_Model_Table_Content();
        $mm_table = new Application_Model_Table_ContentByDepartment();
        
        $id = $this->getRequest()->getParam('id',null);
        
        
        if(empty($id)){
            $this->_helper->json(array('status' => 'success','message' => 'First argument (Department ID) is required.'));
        }else if(!is_numeric($id)){
            $this->_helper->json(array('status' => 'success','message' => 'First argument passed (Department ID) must be a numeric value.'));
        }else if($id < 1){
            $this->_helper->json(array('status' => 'success','message' => 'First argument passed (Department ID) must be a value greater than or equal to one.'));
        }else{
            $rowset = $mm_table->fetchAll("department_id = {$id}");
            foreach($rowset as $row){
                $data[] = $content_table->fetchRow("id = {$row->content_id}");
            }
        }
        
        $this->_helper->json(array('status' => 'success','content' => $data));
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
            $row = $table->fetchRow("id = {$id}");
            if($row !== null){
                $data = $row->toArray();
            }
        }
        
        $this->_helper->json(array('status' => 'success','users' => $data));
    }
}