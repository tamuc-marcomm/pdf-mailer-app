<?php

class Rest_GetController extends Zend_Controller_Action{
    protected $_models = array(
        'colleges' => array(
            'table_class' => 'Application_Model_Table_Colleges',
            'parameters' => array(
                'id' => array(
                    'constraint_description' => 'Integer value greater than 0.',
                    'constraint_matcher' => '[1-9][0-9]*',
                    'description' => 'Some nice description.',
                    'query' => 'id = ?'  //Where clause
                )
            )
        ),
        'content' => array(
            'table_class' => 'Application_Model_Table_Content'
        ),
        'depeartments' => array(
            'table_class' => 'Application_Model_Table_Departments'
        ),
        'departmentbycollege' => array(
            'table_class' => 'Application_Model_Table_DepartmentsByCollege'
        ),
        'users' => array(
            'auth' => true,
            'table_class' => 'Application_Model_Table_Users'
        )
    );

    public function getAction(){
        $data = array();
        $requested_model = $this->getRequest()->getParam('model');
        $table;


        /*[BEGIN] Request Error Checking*/
        if(empty($requested_model)){
            $this->_helper->json(array('status' => 'failure','message' => 'You must specify a model to retreive for this call to succeed.'));
        }

        if(!isset($this->_models[$requested_model])){
            $this->_helper->json(array('status' => 'failure','message' => "The requested model '$requested_model' is not a valid model.  Please see '".$this->view->url(array(),'rest/docs',true)."' for valid requests and additional documentation."));
        }

        $model_information = $this->_models[$requested_model];
        $user = Zend_Registry::get('current_user');
        if(isset($model_information['auth']) && $model_information['auth'] && empty($user)){
            $this->_helper->json(array('status' => 'failure','message' => 'You must be logged in for this call to succeed.'));
        }
        /*[END] Request Error Checking*/

        $table = new $model_information['table_class']();
        $query = $table->select();
        foreach($model_information['parameters'] as $parameter_name => $parameter){
            if($this->getRequest()->getParam($parameter_name) !== null){
                $parameter_value = $this->getRequest()->getParam($parameter_name);
                

                $herp = preg_match('/'.$parameter['constraint_matcher'].'/',$parameter_value);
                var_dump($herp);exit;



                if(preg_match('/'.$parameter['constraint_matcher'].'/',$parameter_value)){
                    $query->where($parameter['query'],$parameter_value);
                }else{
                    $this->_helper->json(array('status' => 'failure','message' => "Parameter '$parameter_name' must meet the following criterea for this call to succeed:  {$parameter['constraint_description']}"));
                }
            }else{
                if(isset($parameter['required']) && $parameter['required']){
                    $this->_helper->json(array('status' => 'failure','message' => "Parameter '$parameter_name' must be given for this call to succeed."));
                }
            }
        }
    }

    /*public function collegesAction(){
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
            $data = $table->fetchAll("parent={$id}")->toArray();
        }
        
        $this->_helper->json(array('status' => 'success','data' => $data));
    }*/
}