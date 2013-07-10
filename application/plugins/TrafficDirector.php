<?php

class Application_Plugin_TrafficDirector extends Zend_Controller_Plugin_Abstract{
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request){
        $this->_redirectLogin($request);
    }

    protected function _redirectLogin(Zend_Controller_Request_Abstract &$request){
        $action = $request->getActionName();    
        $controller = $request->getControllerName();
        $module = $request->getModuleName();
        
        
        $user = Zend_Registry::get('current_user');
        if($user == null){
            if($module == 'default'){
            	return true;
            }else if(
                $controller == 'login'
                &&
                ($action == 'login' || $action == 'dologin')
            ){
                return true;
            }
        }else{
            if($module == 'admin' && !$user->isAdmin()){
                throw new Zend_Controller_Action_Exception("You do not have permission to access this page.",403);
            }else{
                return false;
            }
        }
        
        $request->setParam('ru',$request->getRequestUri());
		$request->setModuleName('default');
        $request->setControllerName('login');
        $request->setActionName('login');
        
        return true;
    }
}