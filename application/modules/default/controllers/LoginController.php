<?php
class LoginController extends Zend_Controller_Action{
	public function dologinAction(){
        $username = $this->getRequest()->getParam('username','');
        $password = $this->getRequest()->getParam('password','');
		$return_url = $this->view->serverUrl(urldecode($this->getRequest()->getParam('ru')));
        
        
        if(empty($username)){
            $this->_helper->FlashMessenger->addMessage(array('type' => 'negative','message' => 'A username must be supplied when attempting to log in.'),'messages');
            
            $this->_helper->redirector->gotoUrlAndExit($return_url);
        }
        
        $user = $this->_helper->User->authenticate($username,$password);
        if($user === false){
            $this->_helper->FlashMessenger->addMessage(array('type' => 'negative','message' => 'There was an error logging you in.  Please doublecheck your username and password and try again.'),'messages');
            
            $this->_helper->redirector->gotoUrlAndExit($return_url);
        }
        
        $this->_helper->FlashMessenger->addMessage(array('type' => 'positive','message' => "You have been successfully logged in as {$user->first_name} {$user->last_name}."),'messages');
        $this->_helper->redirector->gotoUrlAndExit($return_url);
    }
    
    public function loginAction(){
    	$this->view->messages = $this->_helper->FlashMessenger->getMessages('messages');
		$this->view->module = $this->getRequest()->getParam('module','default');
		$this->view->ru = $this->getRequest()->getParam('ru',$this->view->url(array('module' => $this->view->module),null,true));
		
        $this->_helper->layout->setLayout('layout_'.$this->view->module);
		$this->view->setScriptPath(APPLICATION_PATH."/modules/{$this->view->module}/views/scripts/");
    }
    
    public function logoutAction(){
        $this->_helper->User->logout();
        $this->_helper->redirector->gotoUrlAndExit('/admin');
    }
}