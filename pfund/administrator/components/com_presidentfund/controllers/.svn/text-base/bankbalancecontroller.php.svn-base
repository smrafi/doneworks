<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   22 Dec 2011
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');


Class PFundControllerBankBalance extends JController
{
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
        
    }
    
    function display()
    {   
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('bankbalance');
        $model->getList(); 
        $model->pagination();
        $view = $this->getView('bankbalancelist', 'html');
        $view->assignRef('bankbalance_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
       
    }
    
    function add()
    {
         JRequest::setVar('hidemainmenu', 1);
         $model = $this->getModel('bankbalance');
         $bank_model = $this->getModel('banks');
         $account_nums = array('Select an Account Number');
         
         $model->initData();
         
         $bank_array = $bank_model->getBankArray('Select a bank');
         $view = $this->getView('bankbalance', 'html');
         $view->assignRef('bankbalance_data', $model->_data);
         $view->assignRef('bank_array', $bank_array);
         $view->assignRef('account_nums', $account_nums);
         $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $model = $this->getModel('bankbalance');
        $bank_model = $this->getModel('banks');
        $bank_accountmodel = $this->getModel('bankaccount');
        
        $stored = $model->store();
        $bank_array = $bank_model->getBankArray('Select a bank');
        $account_nums = $bank_accountmodel->getAccountNumArray('Select an Account Number', $model->_data->bank_id);
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('Bank Balance Added Successfuly');
            $this->setRedirect(COMPONENT_LINK.'&controller=bankbalance', $msg);
            return;
        }
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('bankbalance', 'html');
        $view->assignRef('bankbalance_data', $model->_data);
        $view->assignRef('bank_array', $bank_array);
         $view->assignRef('account_nums', $account_nums);
        $view->display();
    }
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('bankbalance');
        $bank_model = $this->getModel('banks');
        $bank_accountmodel = $this->getModel('bankaccount');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $model->getOne($cid);
        $bank_array = $bank_model->getBankArray('Select a bank');
        $account_nums = $bank_accountmodel->getAccountNumArray('Select an Account Number', $model->_data->bank_id);
        
        $view = $this->getView('bankbalance', 'html');
        $view->assignRef('bankbalance_data', $model->_data);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('account_nums', $account_nums);
        $view->display();
    }
    
    function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=bankbalance');
        return;
    }
    
    function backob()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=openbalance');
        return;
    }
    
    function publish()
    {
        $model = $this->getModel('bankbalance');
        $model->publish(1);
        $this->setRedirect(COMPONENT_LINK.'&controller=bankbalance');
    }
    
    function unpublish()
    {
        $model = $this->getModel('bankbalance');
        $model->publish(0);
        $this->setRedirect(COMPONENT_LINK.'&controller=bankbalance');
    }
    
    function remove()
    {
        $model = $this->getModel('bankbalance');
        if($model->delete())
            $msg = JText::_('Bank Account Details has been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=bankbalance', $msg);
    }
    
}