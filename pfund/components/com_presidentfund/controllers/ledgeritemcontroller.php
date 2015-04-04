<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   18 Dec 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');


class PFundControllerLedgerItem extends JController
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
         
        $model = $this->getModel('ledgeritem');
        $model->getLedgerItemList();
        $model->pagination();
        
        $view = $this->getView('ledgeritemlist', 'html');
        $view->assignRef('ledger_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    function addnew()
    {
         $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
         $this->addModelPath($path);
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
       
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
         
        $model = $this->getModel('ledgeritem');
        $bank_model = $this->getModel('banks');
        $bank_accountmodel = $this->getModel('bankaccount');
        $ledger_array = $model->getLedgerItemArray('*No*');
        
        $stored = $model->store();
        $bank_array = $bank_model->getBankArray('Select a bank');
        $account_nums = $bank_accountmodel->getAccountNumArray('Select an Account Number', $model->_data->bank_id);
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('ledger Item Added Successfuly');
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=ledgeritem',FALSE), $msg);
            return;
        }
       
                
        $view = $this->getView('ledgeritem', 'html');
        $view->assignRef('ledgeritem_data', $model->_data);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('ledger_array', $ledger_array);
        $view->assignRef('account_nums', $account_nums);
        $view->display();
    }
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('ledgeritem');
        $bank_model = $this->getModel('banks');
        $bank_accountmodel = $this->getModel('bankaccount');
        $ledger_array = $model->getLedgerItemArray('*No*');
        
        $cid = JRequest::getVar('cid');
        
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
    
    function remove()
    {
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('ledgeritem');
        if($model->delete())
            $msg = JText::_('Ledger Item has been deleted');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=ledgeritem',False), $msg);
    }
    
    function getledgeritemtype()
    {
        $ledger_activity_id = JRequest::getInt('ledger_activity');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $ledgeritemtype_model = $this->getModel('ledgeritem');
        $ledgeritemtype_list = $ledgeritemtype_model->getLedgerItemArray('Select an Ledger Type', $ledger_activity_id);
        
        $view = $this->getView('ledgeritemtype', 'html');
        $view->assignRef('ledgeritemtype_list', $ledgeritemtype_list);
        $view->display();
        return;
    }
    
    function back_acc()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=account');
        return;
    }

    
     function backop()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=account',FALSE));
        return;
    }
    
    function acc_ob()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=openbalance',FALSE));
        return;
    }
   
}
