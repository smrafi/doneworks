<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   13/12/2011
 * ***************************************************************************** */
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class PFundControllerPaySetting extends JController
{   
    
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
    }
 
    function display()
    {  
        
        $model = $this->getModel('paysetting');
        $model->getPaySettingList();
        $model->pagination();
        
        $ledger_itemmodel = $this->getModel('ledgeritem');
        $credit_ledger = $ledger_itemmodel->getLedgerItemArray('Select an Income Source',2 ,'account_type');
        $debit_ledger = $ledger_itemmodel->getLedgerItemArray('Select an Ledger Item', 1,'account_type');
        
        $view = $this->getView('paysettinglist', 'html');
        $view->assignRef('ledger_debit_array', $debit_ledger);
        $view->assignRef('ledger_credit_array', $credit_ledger);
        $view->assignRef('paysetting_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
            

    
    }
    
     function add()
    {
         JRequest::setVar('hidemainmenu', 1);
         $model = $this->getModel('paysetting');
         $model->initData();
         $ledger_itemmodel = $this->getModel('ledgeritem');
         
         $credit_ledger = $ledger_itemmodel->getLedgerItemArray('Select an Income Source',1,'account_type');
         $debit_ledger = $ledger_itemmodel->getLedgerItemArray('Select an Ledger Item', 2,'account_type');
         
         $view = $this->getView('paysetting', 'html');
         $view->assignRef('ledger_debit_array', $debit_ledger);
         $view->assignRef('ledger_credit_array', $credit_ledger);
         $view->assignRef('paysetting_list', $model->_data);
         $view->display();
   
    }
    
      function save()
    {
         $task = JRequest::getVar('task');
         $model = $this->getModel('paysetting');
         $ledger_itemmodel = $this->getModel('ledgeritem');
        
        $stored = $model->store();
        $credit_ledger = $ledger_itemmodel->getLedgerItemArray('Select an Income Source',1,'account_type');
        $debit_ledger = $ledger_itemmodel->getLedgerItemArray('Select an Ledger Item', 2,'account_type');
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('Payable Item Added Successfuly');
            $this->setRedirect(COMPONENT_LINK.'&controller=paysetting', $msg);
            return;
        }
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
         $view = $this->getView('paysetting', 'html');
         $view->assignRef('ledger_debit_array', $debit_ledger);
         $view->assignRef('ledger_credit_array', $credit_ledger);
         $view->assignRef('paysetting_list', $model->_data);
         $view->display();
    }
    
     function edit()
    {
        JRequest::setVar('paysetting', 1);
        $model = $this->getModel('paysetting');
        $ledger_itemmodel = $this->getModel('ledgeritem');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $model->getOne($cid);
        $credit_ledger = $ledger_itemmodel->getLedgerItemArray('Select an Income Source',1,'account_type');
        $debit_ledger = $ledger_itemmodel->getLedgerItemArray('Select an Ledger Item', 2,'account_type');
        JRequest::setVar('hidemainmenu', 1);
        $view = $this->getView('paysetting', 'html');
        $view->assignRef('paysetting_list', $model->_data);
        $view->assignRef('ledger_debit_array', $debit_ledger);
        $view->assignRef('ledger_credit_array', $credit_ledger);
        $view->display();
    }
    
     function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=paysetting');
        return;
    }
    
    function backacc()
    {
        $this->setRedirect( COMPONENT_LINK.'&controller=account&task=account');
        return;
    }
    
    function remove()
    {
        $model = $this->getModel('paysetting');
        if($model->delete())
            $msg = JText::_('Payable Item Details has been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=paysetting', $msg);
    }
}