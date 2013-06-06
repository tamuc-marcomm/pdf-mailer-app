<?php
class UserController extends Zend_Controller_Action{
    public function dologinAction(){}
	
	public function loginAction(){
		$this->view->messages = array(
			array('type' => 'positive','message' => 'User Foo Bar has logged in successfully.'),
			array('type' => 'negative','message' => 'Could not log user in.  Cause;  Invalid Credentials.')
		);
	}
	
	public function logoutAction(){}
}