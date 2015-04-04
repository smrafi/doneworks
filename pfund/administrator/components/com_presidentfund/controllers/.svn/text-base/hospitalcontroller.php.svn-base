<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class PFundControllerHospital extends JController
{
	function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
    }
    
    function display()
    {   
        $model = $this->getModel('hospital');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('hospitallist', 'html');
        $view->assignRef('hospital_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    function add()
    {
         JRequest::setVar('hidemainmenu', 1);
         
         $model = $this->getModel('hospital');
         $bank_model = $this->getModel('banks');
         $model->initData();
         
         $bank_array = $bank_model->getBankArray('Select a bank');
         $view = $this->getView('hospital', 'html');
         $view->assignRef('bank_array', $bank_array);
         $view->assignRef('hospital_list', $model->_data);
        
         $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $model = $this->getModel('hospital');
        $bank_model = $this->getModel('banks');
        
        
        $stored = $model->store();
        $bank_array = $bank_model->getBankArray('Select a bank');
        
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('Hospital Details Added Successfuly');
            $this->setRedirect(COMPONENT_LINK.'&controller=hospital', $msg);
            return;
        }
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('hospital', 'html');
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('hospital_list', $model->_data);
        $view->display();
    }
    
     function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        
        $model = $this->getModel('hospital');
        $bank_model = $this->getModel('banks');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $model->getOne($cid);
        $bank_array = $bank_model->getBankArray('Select a bank');
        
        $view = $this->getView('hospital', 'html');
        $view->assignRef('hospital_list', $model->_data);
        $view->assignRef('bank_array', $bank_array);
        $view->display();
    }
    
     function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=hospital');
        return;
    }
    
    function remove()
    {
        $model = $this->getModel('hospital');
        if($model->delete())
            $msg = JText::_('Hospital Detail has been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=hospital', $msg);
    }
}