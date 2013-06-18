<?php
class Application_Controllers_Helpers_Rest extends Zend_Controller_Action_Helper_Abstract{
    private $configuration = array();


    public function direct($model = null){
        $model = !empty($model) ? $model : $this->getRequest()->getParam('model');
        $method = $this->getRequest()->getActionName();
        

        if(isset($this->configuration[$method]) && isset($this->configuration[$method][$model])){
            return $this->configuration[$method][$model];
        }else{
            return null;
        }
    }

    public function applyFilter(Zend_Db_Table_Select $select,$model = null){
        if(empty($model)){
            $model = $this->getRequest()->getParam('model');
        }
        $options = $this->direct($model);

        if($options === null){
            return null;
        }
        if($this->isRelational($model)){
            $model = $options['leftModel'];
            $options = $this->direct($model);
        }

        $table = $this->getTable($model)->info('name');
        $filters = isset($options['filters']) ? $options['filters'] : array();
        foreach($filters as $name => $filter){
            $request_param_array = $this->getRequest()->getParam($name);
            if($request_param_array !== null){
                if(isset($filter['constraint'])){
                    $expression = str_replace('/','\/',$filter['constraint']);
                }else{
                    $expression = '.*';
                }
                

                $request_param_array = is_array($request_param_array) ? $request_param_array : array($request_param_array);
                foreach($request_param_array as $request_param){
                    if(!preg_match('/'.$expression.'/',$request_param)){
                        $error = "Filter '$name' must meet the following criterea for this call to succeed:  ";
                        if(isset($filter['description'])){
                            $error .= $filter['description'];
                        }else{
                            $error .= $filter['constraint'];
                        }

                        throw new Zend_Exception($error);
                    }

                    $select->where("`$table`.".$filter['filter'],$request_param);
                }
            }else{
                if(isset($filter['required']) && $filter['required']){
                    throw new Zend_Exception("Parameter '$name' must be given for this call to succeed.");
                }
            }
        }
    }

    public function getSelect($model = null){
        $model = !empty($model) ? $model : $this->getRequest()->getParam('model');
        $options = $this->direct($model);


        if($options === null){
            return null;
        }

        if(!isset($options['type'])){
            $options['type'] = 'nonrelational';
        }
        switch($options['type']){
            case 'nonrelational':
                

                break;
            case 'relational':
                if(!isset($options['relationship'])){
                    throw new Zend_Exception("Model '$model' does not contain the required 'relationship' node.  Please add this node to the rest configuration options for '$model'.");
                }
                if(!isset($options['leftModel'])){
                    throw new Zend_Exception("Model '$model' does not contain the required 'leftModel' node.  Please add this node to the rest configuration options for '$model'.");
                }
                if(!isset($options['rightModel'])){
                    throw new Zend_Exception("Model '$model' does not contain the required 'rightModel' node.  Please add this node to the rest configuration options for '$model'.");
                }
                if(!isset($options['leftColumn'])){
                    throw new Zend_Exception("Model '$model' does not contain the required 'leftColumn' node.  Please add this node to the rest configuration options for '$model'.");
                }
                if(!isset($options['rightColumn'])){
                    throw new Zend_Exception("Model '$model' does not contain the required 'rightColumn' node.  Please add this node to the rest configuration options for '$model'.");
                }

                switch($options['relationship']){
                    case '1..1':
                    case '1..*':
                    case '*..*':
                        break;
                    default:
                        throw new Zend_Exception("Relationship '{$options['relationship']}' for model '$model' is not a valid relational model relationship type.");
                }

                break;
            default:
                throw new Zend_Exception("'{$options['type']}' is not a valid model type.");
        }

        switch($options['type']){
            case 'nonrelational':
                $select = $this->getTable($model);
                $select = $select->select()->from($select->info('name'));

                break;
            case 'relational':
                $select = $this->getSelect($options['rightModel']);;
                $select->join(
                    $this->getTable($options['leftModel'])->info('name'),
                    "`".$this->getTable($options['rightModel'])->info('name')."`.{$options['rightColumn']} = `".$this->getTable($options['leftModel'])->info('name')."`.{$options['leftColumn']}",array()
                );

                break;
            default:
                throw new Zend_Exception("Relation type not yet implemented.");
        }

        return $select;
    }

    public function getTable($model = null){
        $model = !empty($model) ? $model : $this->getRequest()->getParam('model');
        $options = $this->direct($model);        


        if($options === null){
            throw new Zend_Exception("Requested model '$model' does not exist.");
        }else if($this->isRelational($model)){
            throw new Zend_Exception("Cannot retrieve table for relational model '$model'.");
        }else if(!isset($options['tableClass'])){
            throw new Zend_Exception("Model '$model' does not contain the required 'tableClass' node.  Please add this node to the rest configuration options for '$model'.");
        }

        return new $options['tableClass'];
    }

    public function init(){
        if(Zend_Registry::isRegistered('rest_configuration')){
            $this->configuration = Zend_Registry::get('rest_configuration');
        }
    }

    public function isRelational($model = null){
        $model = !empty($model) ? $model : $this->getRequest()->getParam('model');
        $options = $this->direct($model);        


        if(isset($options['type']) && $options['type'] == 'relational'){
            return true;
        }else{
            return false;
        }
    }

    public function modelExists($model = null){
        $options = $this->direct($model);


        if($options !== null){
            return true;
        }else{
            return false;
        }
    }

    public function requiresAuth($model = null){
        $options = $this->direct($model);


        if(
            $options !== null && isset($options['requiresAuth'])
        ){
            return (bool)$options['requiresAuth'];
        }else{
            return false;
        }
    }
}
?>
