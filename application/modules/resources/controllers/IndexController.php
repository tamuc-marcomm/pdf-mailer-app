<?php
class Resources_IndexController extends Zend_Controller_Action{
    public function init(){
		$this->_helper->layout->setLayout('layout_resources');
	}

    public function indexAction(){
    	$colleges = new Application_Model_Table_Colleges;

    	$this->view->colleges = $colleges->fetchAll();
    }
}