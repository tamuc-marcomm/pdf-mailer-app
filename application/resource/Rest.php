<?php

class Application_Resource_Rest extends Zend_Application_Resource_ResourceAbstract{
	public function init(){
		Zend_Registry::set('rest_configuration',$this->getOptions());
	}
}