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

class PFundControllerIncome extends JController
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
        
        $model=$this->getModel('income');
        $in_list=$model->getList(RECEIPT_STATUS_IN);
        $deposited_list=$model->getList(RECEIPT_STATUS_DEPOSITED);
        $uploaded_list=$model->getList(RECEIPT_STATUS_SLIP_UPLOADED);
        $model->pagination();
        $view = $this->getView('incomelist', 'html');
        $view->assignRef('income_list', $in_list);
        $view->assignRef('deposited_list', $deposited_list);
        $view->assignRef('uploaded_list', $uploaded_list);
        $view->assignRef('pagination', $model->_pagination);
       
        $view->display();
    }
    
    function addnew()
    {  
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
       $model = $this->getModel('voucher'); 
       $person = $model->getPersonArray();

       $ledger_model=$this->getModel('ledgeritem'); 
       $ledger_mahapola = $ledger_model->ledgercheck(); 
       $ledgertype_list = $ledger_model->getLedgerItemArray('Select a Ladger',ACCOUNT_TYPE_CREDIT ,'account_type'); 
       $model=$this->getModel('income');
       $bankmodel=$this->getModel('banks');
       $bank_array = $bankmodel->getBankArray('Select a Bank');
       $model->initData();
       
       $view = $this->getView('income', 'html');
       $view->assignRef('bank_array', $bank_array);
       $view->assignRef('ledger_array', $ledgertype_list);
       $view->assignRef('income_list', $model->_data);
       $view->assignRef('person_list', $person);
       $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('voucher'); 
        $person = $model->getPersonArray();
        $ledgermodel=$this->getModel('ledgeritem');
        $model = $this->getModel('income');
        $bankmodel=$this->getModel('banks');
        $bank_array = $bankmodel->getBankArray('Select a Bank');
        
        $stored = $model->store();
        $ledgertype_list = $ledgermodel->getLedgerItemArray('', ACCOUNT_TYPE_CREDIT, 'account_type');
        
           
        
        if($stored && ($task == 'save'))
        {
            if($model->_data->income_type==TRANSACTION_TYPE_CASH_DEPOSIT_BANK ||$model->_data->income_type==TRANSACTION_TYPE_CHEQUE_DEPOSIT_BANK||$model->_data->income_type==TRANSACTION_TYPE_ONLINE_BANK_DEPOSIT)
            { 
              $data_list = array(0 => $model->_data);
              $account_nums = array('Select an Account Number');
              $model->pagination();
              
              $view = $this->getView('depositlist', 'html'); 
              $view->assignRef('deposit_voucher_list', $data_list);
              $view->assignRef('account_nums', $account_nums);
              $view->assignRef('pagination', $model->_pagination);
              
            }
           
        }
             else
            {
             $view = $this->getView('receiptprint', 'html');   
            }
        
        print_r($model->_data);
        $view->assignRef('income_list', $model->_data);
        $view->assignRef('ledger_array', $ledgertype_list);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('person_list', $person);
        
        $view->display();
    }
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('voucher'); 
        $person = $model->getPersonArray();
        $ledgermodel=$this->getModel('ledgeritem');
        
        
        $model = $this->getModel('income');
        $bankmodel=$this->getModel('banks');
        $bank_array = $bankmodel->getBankArray('Select a Bank');
        
        $cid = JRequest::getVar('cid');
                
        $model->getOne($cid);
        $ledgertype_list=$ledgermodel->getLedgerItemArray('',ACCOUNT_TYPE_CREDIT,'account_type');
        
        $view = $this->getView('income', 'html');
        $view->assignRef('income_list', $model->_data);
        $view->assignRef('ledger_array', $ledgertype_list);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('person_list', $person);
        
        $view->display();
    }
    
    function deposit()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('voucher'); 
        $person = $model->getPersonArray();
       
        $model = $this->getModel('income');
        
        $model->getSelectedList();
        $model->pagination();
        $bankmodel=$this->getModel('banks');
        $bank_array = $bankmodel->getBankArray('Select a Bank');
        $account_nums = array('Select an Account Number');
        
        $view = $this->getView('depositlist', 'html');
        $view->assignRef('deposit_voucher_list', $model->_data);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('account_nums', $account_nums);
        $view->assignRef('person_list', $person);
        $view->assignRef('pagination', $model->_pagination);
        
        $view->display();
    }
    
    
    function receiptprint()
    {  
         $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('income');
        $update=$model->slipupdate();
        if($update){
            $msg = "Successfully Updated Data";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=income',$msg));
            return;
        }
        
    
    }
    
    
    function saveslip()
    {  
         $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('income');
        $update=$model->slipupdate();
        if($update){
            $msg = "Successfully Updated Data";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=income',$msg));
            return;
        }
        
    
    }
    
    function savereceipt()
    {  
         $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('income');
        $update=$model->receiptupdate();
        if($update){
            $msg = "Successfully Updated Data";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=income',$msg));
            return;
        }
        
    
    }
    
    function uploadslip()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('income');
       
        $cid = JRequest::getVar('cid');
       
        $upload_list=$model->getOne($cid);
        
        $view = $this->getView('bankslip', 'html');
        $view->assignRef('slip_uploaded_list', $upload_list);
        
        $view->display();
    }
    
    
    function uploadreceipt()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('income');
       
        $cid = JRequest::getVar('cid');
       
        $upload_list=$model->getOne($cid);
        
        $view = $this->getView('receiptupload', 'html');
        $view->assignRef('slip_uploaded_list', $upload_list);
        
        $view->display();
    }
    
    function save_deposit()
    {   

        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('income');
        $update=$model->receiptupdate();
        print_r($update);
        if($update){
            $msg = "Successfully Updated Data";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=income',$msg));
            return;
        }
        
    
    }
    
    function back()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=income',FALSE));
        return;
    }
    
    function backop()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=accountentry',FALSE));
        return;
    }
    
    
    function remove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('income');
        if($model->delete())
            $msg = JText::_('Income Details have been deleted');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=income',FALSE), $msg);
    }
    
    function mahapola()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
       $model = $this->getModel('voucher'); 
       $person = $model->getPersonArray();

       $ledger_model=$this->getModel('ledgeritem');
       $ledgertype_list = $ledger_model->getLedgerItemArray('Select a Type',ACCOUNT_TYPE_CREDIT ,'account_type'); 
       $model=$this->getModel('income');
       $mahapola_id = $model->mahapola();
       $bankmodel=$this->getModel('banks');
       $bank_array = $bankmodel->getBankArray('Select a Bank');
       $model->initData();
       
       $view = $this->getView('mahapolareceipt', 'html'); 
       $view->assignRef('bank_array', $bank_array);
       $view->assignRef('ledger_array', $ledgertype_list);
       $view->assignRef('income_list', $model->_data);
       $view->assignRef('mahapola_id', $mahapola_id);
       $view->assignRef('person_list', $person);
       $view->display();
    }
}