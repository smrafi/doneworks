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

class PFundControllerLoan extends JController
{
    
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
    }
    
    function display()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('loan');
        $model->getLoanList();
        $model->pagination();
        
        $view = $this->getView('loanlist', 'html');
        $view->assignRef('loan_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        
        $view->display();
    }
    
    function addnew()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $bank_model = $this->getModel('banks');
        $bank_array = $bank_model->getBankArray('Select Bank');
        
        $model=$this->getModel('loan');
        $creditor_array = $model->getCreditorArray('Select a Creditor');
        $model->initData();
        
        $account_nums = array('Select an Account Number');
        
        $view = $this->getView('loan', 'html');
        $view->assignRef('creditor_list', $creditor_array);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('account_nums', $account_nums);
        $view->assignRef('loan_list', $model->_data);
        $view->display();
    }   
    
   function save()
    {
        $task = JRequest::getVar('task');
       
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $bank_model = $this->getModel('banks');
        $bank_array = $bank_model->getBankArray('Select Bank');
        
        $model = $this->getModel('loan');
        $creditor_array = $model->getCreditorArray('Select a Creditor');
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = "Successfully Inserted Data";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=loan',FALSE), $msg);
            return;
        }
        
        
        $bank_accountmodel = $this->getModel('bankaccount');
        $account_nums = $bank_accountmodel->getAccountNumArray('Select an Account Number', $model->_data->bank_id);
        
        $view = $this->getView('loan', 'html');
        $view->assignRef('loan_list', $model->_data);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('account_nums', $account_nums);
        $view->assignRef('creditor_list', $creditor_array);
        $view->display();
        
      
    }
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $bank_model = $this->getModel('banks');
        $bank_array = $bank_model->getBankArray('Select a bank');
        $model = $this->getModel('loan');
        $creditor_array = $model->getCreditorArray('Select a Creditor');
        
        $cid = JRequest::getVar('cid');
                
        $model->getOne($cid);
        
        $bank_accountmodel = $this->getModel('bankaccount');
        $account_nums = $bank_accountmodel->getAccountNumArray('Select an Account Number', $model->_data->bank_id);
        $view = $this->getView('loan', 'html');
        
        $view->assignRef('loan_list', $model->_data);
        $view->assignRef('creditor_list', $creditor_array);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('account_nums', $account_nums);
        $view->display();
    }
    
    function remove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('loan');
        if($model->delete())
            $msg = JText::_('Loan Details have been deleted');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=loan',FALSE), $msg);
    }
    
     function backop()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=accountentry',FALSE));
        return;
    }
    
}
