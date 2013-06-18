<?php

class RestController extends Zend_Controller_Action{
    public function getAction(){
        $failure = array('status' => 'failure','message' => null);
        $table;


        /*[BEGIN] Request Error Checking and Initialization*/
        $model = $this->getRequest()->getParam('model');
        if(empty($model)){
            $failure['message'] = 'You must specify a model to retreive for this call to succeed.';
            $this->_helper->json($failure);
        }

        
        if(!$this->_helper->rest->modelExists($model)){
            $failure['message'] = "The requested model '$model' is not a valid model.  Please see '{$this->view->url(array(),'rest/docs',true)}' for valid requests and additional documentation.";
            $this->_helper->json($failure);
        }

        if($this->_helper->rest->requiresAuth($model) && !Zend_Registry::isRegistered('current_user')){
            $failure['message'] = 'You must be logged in for this call to succeed.';
            $this->_helper->json($failure);   
        }
        /*[END] Request Error Checking*/

        try{
            $select = $this->_helper->rest->getSelect();
            $this->_helper->rest->applyFilter($select);
        }catch(Zend_Exception $e){
            $failure['message'] = $e->getMessage();
            $this->_helper->json($failure);
        }

        $select->order('id','asc');

        $this->_helper->json(array('status' => 'success','data' => $select->query()->fetchAll()));
    }
}