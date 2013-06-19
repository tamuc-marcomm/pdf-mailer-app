<?php

class Application_Plugin_UserSetter extends Zend_Controller_Plugin_Abstract{
    public function routeStartup(Zend_Controller_Request_Abstract $request){
        $authenticator = Zend_Auth::getInstance();
        
        
        /*Set up the registry variable for the current user.*/
        $user=NULL;
        if($authenticator->hasIdentity()){
            try{
                $user=new Application_Model_User($authenticator->getIdentity());
            }catch(Strixa_Model_Exception $e){
                error_log('Strixa_Model_Exception thrown when attempting to get the model for the id currently stored in Zend_Auth.');
            }
        }
        Zend_Registry::set('current_user',$user);
    }
}