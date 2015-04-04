<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Jazeer
 * Developer Email  :   jazeermim@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   08 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class PFundControllerAccountsetting extends JController
{
    function __construct()
    {
        parent::__construct();
        $this->registerTask('applyledger', 'saveledger');
        $this->registerTask('applyopenbalance', 'saveopenbalance');
        $this->registerTask('applybank', 'savebank');
    }
    
    function getaccountnum()
    {
        $bank_id = JRequest::getInt('bank_id');
        $bank_accountmodel = $this->getModel('bankaccount');
        $account_nums = $bank_accountmodel->getAccountNumArray('Select an Account Number', $bank_id);
        
        $view = $this->getView('accountnums', 'html');
        $view->assignRef('account_nums', $account_nums);
        $view->display();
        return;
    }
    
    function cancel()
    {
        $this->setRedirect( COMPONENT_LINK.'&controller=account&task=accountsettings');
        return;
    }
    
    function backacc()
    {
        $this->setRedirect( COMPONENT_LINK.'&controller=account&task=account');
        return;
    }
    
    function banks()
    {
        JRequest::setVar('hidemainmenu', 1);
        
        $model = $this->getModel('banks');
        $model->getBanksList();
        
        $view = $this->getView('banks', 'html');
        $view->assignRef('banks', $model->_data);
        $view->display();
         
    }
    
      function savebank()
    {
        $task = JRequest::getVar('task');
        
        $model = $this->getModel('banks');
        $stored = $model->storeBanks();
        $model->getBanksList();
          $bankmodel = $this->getModel('banks');
        $bank_array = $bankmodel->getBankArray('Select Bank');
        
        if($stored and $task == 'savebank')
        {
            $msg = "Banks Are Added";
            $this->setRedirect(COMPONENT_LINK.'&controller=account&task=accountsettings', $msg);
            return;
        }
        
        JRequest::setVar('hidemainmenu', 1);
        $view = $this->getView('banks', 'html');
        $view->assignRef('banks', $model->_data);
         $view->assignRef('bank_array', $bank_array);
        $view->display();
    }
    
     function deletebanks()
    {
        $model = $this->getModel('banks');
        $deleted = $model->deletebanks();
        
        if($deleted)
        {
            $msg = 'Banks Name been deleted';
            $this->setRedirect(COMPONENT_LINK.'&controller=accountsetting&task=banks');
            return;
        }
        
        $msg = 'There is a problem in deleting the Bank Name';
        $this->setRedirect(COMPONENT_LINK.'&controller=account&task=accountsettings');
        return;
    }
    
    
    
   function openbalance()
    {
       
         JRequest::setVar('hidemainmenu', 1);
        
         $model = $this->getModel('openbalance');
         $model->getOne();
       
         $view = $this->getView('openbalance', 'html');
         $view->assignRef('openbalance_data', $model->_data);
         $view->display();
       
    }
   
    function saveopenbalance()
    {
        $task = JRequest::getVar('task');
       
        $model = $this->getModel('openbalance');
        $stored = $model->store();
       
        if($stored and $task == 'saveopenbalance')
        {
            $msg = JText::_('Opening Balance Added Successfuly');
            $this->setRedirect(COMPONENT_LINK.'&controller=account&task=accountsettings', $msg);
            return;
        }
       
        JRequest::setVar('hidemainmenu', 1);
        $view = $this->getView('openbalance', 'html');
        $view->assignRef('openbalance_data', $model->_data);
        $view->display();
    }
    
}