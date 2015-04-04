<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class PFundControllerFD extends JController
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

        $model = $this->getModel('fd');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('fdlist', 'html');
        $view->assignRef('fd_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    function addnew()
    {
         $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
         $this->addModelPath($path);
        
         $model = $this->getModel('fd');
         $bank_model = $this->getModel('banks');
         $account_nums = array('Account Number');
         $model->initData();
         
         $bank_array = $bank_model->getBankArray('Select a bank');
         $view = $this->getView('fd', 'html');
         $view->assignRef('fd_list', $model->_data);
         $view->assignRef('bank_array', $bank_array);
         $view->assignRef('account_nums', $account_nums);
         $view->assignRef('cheque_account_nums', $account_nums);
         $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('fd');
        $bank_model = $this->getModel('banks');
        $bank_accountmodel = $this->getModel('bankaccount');
        
        $stored = $model->store();
        $bank_array = $bank_model->getBankArray('Select a bank');
        $account_nums = $bank_accountmodel->getAccountNumArray('', $model->_data->bank_id);
        $cheque_account_nums = $bank_accountmodel->getAccountNumArray('', $model->_data->bankid);
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('Fixed Diposits Added Successfuly');
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=fd',FALSE), $msg);
            return;
        }
               
        $view = $this->getView('fd', 'html');
        $view->assignRef('fd_list', $model->_data);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('account_nums', $account_nums);
        $view->assignRef('cheque_account_nums', $cheque_account_nums);
        $view->display();
    }
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('fd');
        $bank_model = $this->getModel('banks');
        $bank_accountmodel = $this->getModel('bankaccount');
        
        $cid = JRequest::getVar('cid');
        
        $model->getOne($cid);
        $bank_array = $bank_model->getBankArray('Select a bank');
        $account_nums = $bank_accountmodel->getAccountNumArray('Account Number', $model->_data->bank_id);
        $cheque_account_nums = $bank_accountmodel->getAccountNumArray('', $model->_data->bankid);
        
        
        $view = $this->getView('fd', 'html');
        $view->assignRef('fd_list', $model->_data);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('account_nums', $account_nums);
        $view->assignRef('cheque_account_nums', $cheque_account_nums);
        $view->display();
    }
    
    function remove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('fd');
        if($model->delete())
            $msg = JText::_('Iterest has been deleted');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=fd',FALSE), $msg);
    }
    
   
     function backop()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=accountentry',FALSE));
        return;
    }
}
