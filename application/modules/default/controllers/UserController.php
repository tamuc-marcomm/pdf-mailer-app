<?php
class UserController extends Zend_Controller_Action{
    public function dologinAction(){
		$username = $this->getRequest()->getParam('username','');
		$password = $this->getRequest()->getParam('password','');
		
		
		if(empty($username)){
			$this->_helper->FlashMessenger->addMessage(array('type' => 'negative','message' => 'A username must be supplied when attempting to log in.'),'messages');
			
			$this->_helper->redirector->gotoSimpleAndExit('login',null,null,$this->getRequest()->getParams());
		}
		
		$user = $this->_helper->User->authenticate($username,$password);
		if($user === false){
			$this->_helper->FlashMessenger->addMessage(array('type' => 'negative','message' => 'There was an error logging you in.  Please doublecheck your username and password and try again.'),'messages');
			
			$this->_helper->redirector->gotoSimpleAndExit('login',null,null,$this->getRequest()->getParams());
		}
		
		$this->_helper->FlashMessenger->addMessage(array('type' => 'positive','message' => "You have been successfully logged in as {$user->first_name} {$user->last_name}."),'messages');
		if($user->isAdmin()){
			$this->_helper->redirector->gotoRouteAndExit(array('module' => 'admin','controller' => 'index','action' => 'index'),null,true);
		}else{
			$this->_helper->redirector->gotoRouteAndExit(array('module' => 'default','controller' => 'index','action' => 'index'),null,true);
		}
	}
	
	public function loginAction(){
		$this->view->messages = $this->_helper->FlashMessenger->getMessages('messages');
		
		var_dump($this->view->messages);
	}
	
	public function logoutAction(){
		$this->_helper->User->logout();
	}
}