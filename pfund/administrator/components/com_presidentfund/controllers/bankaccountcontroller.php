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

class PFundControllerBankAccount extends JController
{   
    
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
    }
 
    function display()
    {    
        $model = $this->getModel('bankaccount');
        $bank_model = $this->getModel('banks');
        $model->getList();
        $model->pagination();
        $view = $this->getView('bankaccountlist', 'html');
        $bank_array = $bank_model->getBankArray('Select a Bank');
        $view->assignRef('bankaccount_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->assignRef('bank_array', $bank_array);
        $view->display();
        
    }
     function add()
    {
         JRequest::setVar('hidemainmenu', 1);
         $model = $this->getModel('bankaccount');
         $bank_model = $this->getModel('banks');
        
         $model->initData();
         $bank_array = $bank_model->getBankArray('Select a Bank');
         
         $view = $this->getView('bankaccount', 'html');
         $view->assignRef('bankaccount_list', $model->_data);
         $view->assignRef('bank_array', $bank_array);
         $view->display();
   
    }
    
     function save()
    {
        $task = JRequest::getVar('task');
        
        $model = $this->getModel('bankaccount');
        $bank_model = $this->getModel('banks');
        
        $stored = $model->store();
        $bank_array = $bank_model->getBankArray('Select a Bank');
        
        if($stored && ($task == 'save'))
        {
            $msg = "Bank Account has been saved";
            $this->setRedirect(COMPONENT_LINK.'&controller=bankaccount', $msg);
            return;
        }
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('bankaccount', 'html');
        $view->assignRef('bankaccount_list', $model->_data);
        $view->assignRef('bank_array', $bank_array);
        $view->display();
    }
    
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('bankaccount');
        $bank_model = $this->getModel('banks');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $model->getOne($cid);
        $bank_array = $bank_model->getBankArray('Select a Bank');
        
        $view = $this->getView('bankaccount', 'html');
        $view->assignRef('bankaccount_list', $model->_data);
        $view->assignRef('bankaccount_array', $bank_model);
        $view->assignRef('bank_array', $bank_array);
        $view->display();
    }
    
     function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=bankaccount');
        return;
    }
    
    function publish()
    {
        $model = $this->getModel('bankaccount');
        $model->publish(1);
        $this->setRedirect(COMPONENT_LINK.'&controller=bankaccount');
    }
    
    function unpublish()
    {
        $model = $this->getModel('bankaccount');
        $model->publish(0);
        $this->setRedirect(COMPONENT_LINK.'&controller=bankaccount');
    }
    
    function remove()
    {
        $model = $this->getModel('bankaccount');
        if($model->delete())
            $msg = JText::_('Bank Account Details has been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=bankaccount', $msg);
    }
    
    function backacc()
    {
        $this->setRedirect( COMPONENT_LINK.'&controller=account&task=account');
        return;
    }
    
}
