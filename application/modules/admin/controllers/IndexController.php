<?php
class Admin_IndexController extends Zend_Controller_Action{
    public function init(){
        $this->_helper->layout->setLayout('layout_admin');
    }

    public function indexAction(){}
    
    public function addcollegeAction(){}
    
    public function adddepartmentAction(){}
}