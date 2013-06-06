<?php
class Application_Controllers_Helpers_User extends Zend_Controller_Action_Helper_Abstract{
    public function authenticate($username,$password){    
        $authentication_adapter = $this->getAuthenticationAdapter($username,$password);
        
        if(!$authentication_adapter->authenticate()->isValid()){
            return false;
        }else{
            $table = new Application_Model_Table_Users();
            $ldap_account_object = $authentication_adapter->getAccountObject();
            
            
            $user = $table->fetchRow("username='{$ldap_account_object->employeeid}'");  //Employee ID works out to be the student or faculty member's ID number
            if($user === null){
                $user = new Application_Model_User(array(
                  'username' => "{$ldap_account_object->employeeid}",
                  'first_name' => "{$ldap_account_object->givenname}",
                  'last_name' => "{$ldap_account_object->sn}"
                ));
            }else{
                $user = new Application_Model_User($user->u_id);
                
                $user->first_name = "{$ldap_account_object->givenname}";  //Ensure that the user's name is up to date.  This will likely never change, but meh.
                $user->last_name = "{$ldap_account_object->sn}";
            }
            
            Zend_Auth::getInstance()->getStorage()->write($user->u_id);
            
            return $user;
        }
    }
    
    public function getAuthenticationAdapter($username,$password){
        $configuration = new Zend_Config_Xml(APPLICATION_PATH.'/configs/ldap.xml','production');
        
        
        return new Zend_Auth_Adapter_Ldap($configuration->toArray(),$username,$password);
    }
    
    public function logout(){
        Zend_Auth::getInstance()->clearIdentity();
    }
}
?>
