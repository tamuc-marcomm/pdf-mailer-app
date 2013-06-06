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
        
        $this->_helper->json(array('status' => 'success','data' => $data));
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
        
        $this->_helper->json(array('status' => 'success','data' => $data));
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
        
        $this->_helper->json(array('status' => 'success','data' => $data));
    }
}