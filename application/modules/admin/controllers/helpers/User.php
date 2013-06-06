<?php
class Application_Controllers_Helpers_User extends Zend_Controller_Action_Helper_Abstract{
    protected function _addUser($username,$name,$email){
        $user_table = new Application_Model_DbTable_Users();        
        
        
        return new Application_Model_User(array('username' => $username,'name' => $name,'email' => $email));
    }
    
    public function authenticateUser($username,$password,$authenticate_as_admin = false){    
        $authentication_adapter=$this->getAuthenticationAdapter($username,$password,$authenticate_as_admin);
        
        
        if(!$authentication_adapter->authenticate()->isValid()){
            return false;
        }else{
            $table = new Application_Model_DbTable_Users();
            $ldap_account_object = $authentication_adapter->getAccountObject();
            
            
            $user = $table->fetchRow("username='{$ldap_account_object->employeeid}'");  //Employee ID works out to be the student or faculty member's ID number
            if($user == null){
                $user = $this->_addUser("{$ldap_account_object->employeeid}","{$ldap_account_object->givenname} {$ldap_account_object->sn}",isset($ldap_account_object->mail)?$ldap_account_object->mail:null);
            }else{
                $user = new Application_Model_User($user);
                
                $user->name = "{$ldap_account_object->givenname} {$ldap_account_object->sn}";  //Ensure that the user's name is up to date.  This will likely never change, but meh.
            }
            
            Zend_Auth::getInstance()->getStorage()->write($user->u_id);
            
            return $user;
        }
    }
    
    public function getAuthenticationAdapter($username,$password,$authenticate_as_admin){
        $config=new Zend_Config_Ini(APPLICATION_PATH."/configs/ldap.ini",'production');
        
        
        if($authenticate_as_admin){
            $config = $config->staff->toArray();
        }else{
            $config = $config->student->toArray();
        }
        $authentication_adapter = new Zend_Auth_Adapter_Ldap($config,$username,$password);

        return $authentication_adapter;
    }
    
    public function logout(){
        Zend_Auth::getInstance()->clearIdentity();
    }
}
?>
