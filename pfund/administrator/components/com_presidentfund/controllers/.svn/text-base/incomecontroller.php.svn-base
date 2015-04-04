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

class PFundControllerIncome extends JController
{   
    
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
        
    }

    function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=income');
        return;
    }
    
    function backentry()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=accountentry');
        return;
    }

    
    function display()
    {   
        $model=$this->getModel('income');
        $model->getList();
        $model->pagination();
        $view = $this->getView('incomelist', 'html');
        $view->assignRef('income_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
       
        $view->display();
    }
    
     function deposit()
    {   
       
        $model = $this->getModel('income');
        //$model->receiptupdate();
        $model->getSelectedList();
        $model->pagination();
        $view = $this->getView('depositlist', 'html');
        $view->assignRef('deposit_voucher_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        
        $view->display();
    }
   
    
    function add()
    {  
       JRequest::setVar('hidemainmenu', 1);
       $model = $this->getModel('voucher'); 
       $person = $model->getPersonArray();

       $model=$this->getModel('income');
       $ledgertype_list = array('Select a Income Type'); 
       
       $bankmodel=$this->getModel('banks');
       $bank_array = $bankmodel->getBankArray('Select a Bank');
       $model->initData();
       
       $view = $this->getView('income', 'html');
       $view->assignRef('bank_array', $bank_array);
       $view->assignRef('income_ledger_array', $ledgertype_list);
       $view->assignRef('income_list', $model->_data);
       $view->assignRef('person_list', $person);
       $view->display();
    }
    
     function save()
    {
        $task = JRequest::getVar('task');
        $model = $this->getModel('voucher'); 
        $person = $model->getPersonArray();
        
        $ledgermodel=$this->getModel('ledgeritem');
        $model = $this->getModel('income');
        $bankmodel=$this->getModel('banks');
        $bank_array = $bankmodel->getBankArray('Select a Bank');
        
        $stored = $model->store();
        $ledgertype_list = $ledgermodel->getLedgerItemArray('', (int)$model->_data->ledger_activity, 'ledger_type');
        if($stored && ($task == 'save'))
        {
            $msg = "Successfully Inserted Data";
            $this->setRedirect(COMPONENT_LINK.'&controller=income', $msg);
            return;
        }
       
        $view = $this->getView('income', 'html');
        $view->assignRef('income_list', $model->_data);
        $view->assignRef('income_ledger_array', $ledgertype_list);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('person_list', $person);
        $view->display();
    }
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('voucher'); 
        $person = $model->getPersonArray();
        
        $ledgermodel=$this->getModel('ledgeritem');
        
        
        $model = $this->getModel('income');
        $bankmodel=$this->getModel('banks');
        $bank_array = $bankmodel->getBankArray('Select a Bank');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $model->getOne($cid);
        $ledgertype_list=$ledgermodel->getLedgerItemArray('',(int)$model->_data->ledger_activity,'ledger_type');
        $view = $this->getView('income', 'html');
        $view->assignRef('income_list', $model->_data);
        $view->assignRef('income_ledger_array', $ledgertype_list);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('person_list', $person);
        $view->display();
    }
   
    function remove()
    {
        $model = $this->getModel('income');
        if($model->delete())
            $msg = JText::_('Income Details have been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=income', $msg);
    }
}