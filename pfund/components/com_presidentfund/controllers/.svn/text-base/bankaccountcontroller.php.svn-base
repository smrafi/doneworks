<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   19 Dec 2011
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class PFundControllerBankAccount extends JController
{
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
    }
        
    function display()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
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
    
    function backop()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=accountsetting&task=banks');
        return;
    }
    
     function addnew()
    {
         $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
         $this->addModelPath($path);
         
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
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('bankaccount');
        $bank_model = $this->getModel('banks');
        
        $stored = $model->store();
        $bank_array = $bank_model->getBankArray('Select a Bank');
        
        if($stored && ($task == 'save'))
        {
            $msg = "Bank Account has been saved";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=bankaccount',FALSE), $msg);
            return;
        }
                        
        $view = $this->getView('bankaccount', 'html');
        $view->assignRef('bankaccount_list', $model->_data);
        $view->assignRef('bank_array', $bank_array);
        $view->display();
    }
    
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('bankaccount');
        $bank_model = $this->getModel('banks');
        
        $cid = JRequest::getVar('cid');
        
        
        $model->getOne($cid);
        $bank_array = $bank_model->getBankArray('Select a Bank');
        
        $view = $this->getView('bankaccount', 'html');
        $view->assignRef('bankaccount_list', $model->_data);
        $view->assignRef('bankaccount_array', $bank_model);
        $view->assignRef('bank_array', $bank_array);
        $view->display();
    }
    
    function remove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('bankaccount');
        
        if($model->delete())
            $msg = JText::_('Bank Account Detail has been deleted');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=bankaccount',FALSE), $msg);
    }
    
     function getaccountdetail()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $bankaccount_id = JRequest::getInt('bankaccount_id');
        $bank_accountmodel = $this->getModel('bankaccount');
        $account_detail = $bank_accountmodel->getAccountDetailArray($bankaccount_id);
        
        $view = $this->getView('accountdetail', 'html');
        $view->assignRef('account_detail', $account_detail);
        $view->display();
        return;
    }
}