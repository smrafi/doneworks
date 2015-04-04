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

class PFundControllerOpenbalancePayable extends JController
{   
    
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
        
    }

    function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=openbalancepayable');
        return;
    }
    
    function backob()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=openbalance');
        return;
    }
    
    function display()
    {   
        $model=$this->getModel('openbalancepayable');
        $model->getList();
        $model->pagination();
        $view = $this->getView('openbalancepayablelist', 'html');
        $view->assignRef('openbalancepayable_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
       
        $view->display();
    }
    
    function add()
    {  
       
        $model=$this->getModel('openbalancepayable');
        $ledgermodel=$this->getModel('ledgeritem');
        $ledger_array = $ledgermodel->getLedgerItemArray('Select a Expensess Type',2 ,'account_type');
        $creditormodel=$this->getModel('loan');
        $creditor_array = $creditormodel->getCreditorArray('Select a Creditor');
        $model->initData();
        
       $view = $this->getView('openbalancepayable', 'html');
       $view->assignRef('ledger_list', $ledger_array);
       $view->assignRef('creditor_list', $creditor_array);
       $view->assignRef('openbalancepayable_list', $model->_data);
       $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $model = $this->getModel('openbalancepayable');
        $ledgermodel=$this->getModel('ledgeritem');
        $ledger_array = $ledgermodel->getLedgerItemArray('Select a Expensess Type',2 ,'account_type');
        $creditormodel=$this->getModel('loan');
        $creditor_array = $creditormodel->getCreditorArray('Select a Creditor');
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = "Successfully Inserted Data";
            $this->setRedirect(COMPONENT_LINK.'&controller=openbalancepayable', $msg);
            return;
        }
        
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('openbalancepayable', 'html');
        $view->assignRef('openbalancepayable_list', $model->_data);
        $view->assignRef('ledger_list', $ledger_array);
        $view->assignRef('creditor_list', $creditor_array);
        $view->display();
    }
 
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('openbalancepayable');
        $ledgermodel=$this->getModel('ledgeritem');
        $ledger_array = $ledgermodel->getLedgerItemArray('Select a Expensess Type',2 ,'account_type');
        $creditormodel=$this->getModel('loan');
        $creditor_array = $creditormodel->getCreditorArray('Select a Creditor');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $model->getOne($cid);
        
        $view = $this->getView('openbalancepayable', 'html');
        $view->assignRef('openbalancepayable_list', $model->_data);
        $view->assignRef('ledger_list', $ledger_array);
        $view->assignRef('creditor_list', $creditor_array);
        $view->display();
    }
    
    
    function remove()
    {
        $model = $this->getModel('openbalancepayable');
        if($model->delete())
            $msg = JText::_('Payable Details have been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=openbalancepayable', $msg);
    }
    
    
}