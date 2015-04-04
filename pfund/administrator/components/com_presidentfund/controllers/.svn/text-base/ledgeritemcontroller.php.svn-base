<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class PFundControllerLedgerItem extends JController
{
	function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
    }
    
    function display()
    {
        $model = $this->getModel('ledgeritem');
        $model->getLedgerItemList();
        $model->pagination();
        
        
        $view = $this->getView('ledgeritemlist', 'html');
        $view->assignRef('ledger_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
     function add()
    {
         JRequest::setVar('hidemainmenu', 1);
         $model = $this->getModel('ledgeritem');
         $bank_model = $this->getModel('banks');
         $bank_array = $bank_model->getBankArray('Select Bank');
         $ledger_array = $model->getLedgerItemArray('*No*');
         $account_nums = array('Select an Account Number');
         $model->initData();
         
         $bank_array = $bank_model->getBankArray('Select a bank');
         $view = $this->getView('ledgeritem', 'html');
         
         $view->assignRef('ledgeritem_data', $model->_data);
         $view->assignRef('bank_array', $bank_array);
         $view->assignRef('ledger_array', $ledger_array);
         $view->assignRef('account_nums', $account_nums);
       
         $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
       
        
        $model = $this->getModel('ledgeritem');
        $bank_model = $this->getModel('banks');
        $bank_accountmodel = $this->getModel('bankaccount');
        $ledger_array = $model->getLedgerItemArray('*No*','','ledger_type');
        
        $stored = $model->store();
        $bank_array = $bank_model->getBankArray('Select a bank');
        $account_nums = $bank_accountmodel->getAccountNumArray('Select an Account Number', $model->_data->bank_id);
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('ledger Item Added Successfuly');
            $this->setRedirect(COMPONENT_LINK.'&controller=ledgeritem', $msg);
            return;
        }
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('ledgeritem', 'html');
        $view->assignRef('ledgeritem_data', $model->_data);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('ledger_array', $ledger_array);
        $view->assignRef('account_nums', $account_nums);
        $view->display();
    }
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('ledgeritem');
        $bank_model = $this->getModel('banks');
        $bank_accountmodel = $this->getModel('bankaccount');
        $ledger_array = $model->getLedgerItemArray('*No*','','ledger_type');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $model->getOne($cid);
        
        $bank_array = $bank_model->getBankArray('Select a bank');
        $account_nums = $bank_accountmodel->getAccountNumArray('Select an Account Number', $model->_data->bank_id);
        
        $view = $this->getView('ledgeritem', 'html');
        $view->assignRef('ledgeritem_data', $model->_data);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('ledger_array', $ledger_array);
        $view->assignRef('account_nums', $account_nums);
        $view->display();
    }
    
     function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=account');
        return;
    }
    
    function publish()
    {
        $model = $this->getModel('ledgeritem');
        $model->publish(1);
        $this->setRedirect(COMPONENT_LINK.'&controller=ledgeritem');
    }
    
    function unpublish()
    {
        $model = $this->getModel('ledgeritem');
        $model->publish(0);
        $this->setRedirect(COMPONENT_LINK.'&controller=ledgeritem');
    }
    
    function remove()
    {
        $model = $this->getModel('ledgeritem');
        if($model->delete())
            $msg = JText::_('Ledger Item has been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=ledgeritem', $msg);
    }
    
    function getledgeritemtype()
    {
        $ledger_activity_id = JRequest::getInt('ledger_activity');
        $ledgeritemtype_model = $this->getModel('ledgeritem');
        $ledgeritemtype_list = $ledgeritemtype_model->getLedgerItemArray('Select an Ledger Type', $ledger_activity_id ,'ledger_type');
        
        $view = $this->getView('ledgeritemtype', 'html');
        $view->assignRef('ledgeritemtype_list', $ledgeritemtype_list);
        $view->display();
        return;
    }
    
}


