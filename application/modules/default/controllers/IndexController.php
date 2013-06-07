<?php
class IndexController extends Zend_Controller_Action{
    public function init(){}

    public function indexAction(){
    	$colleges = new Application_Model_Table_Colleges;

    	$this->view->colleges = $colleges->fetchAll();
    }
}