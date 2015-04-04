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

class PFundControllerVoucher extends JController
{   
    
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
        $this->registerTask('applyreciept', 'savereciept');
        
        
    }
    function display()
    {   
        $model = $this->getModel('voucher');
        $receipt_uploaded= $model->getReceiptUploadedList();
        $voucher_released= $model->getVoucherReleasedList();
        $model->getList();
        $model->pagination();
        $view = $this->getView('voucherlist', 'html');
        $view->assignRef('voucher_list', $model->_data);
        $view->assignRef('receipt_uploaded_list', $receipt_uploaded);
        $view->assignRef('voucher_released_list', $voucher_released);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    
    function backentry()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=accountentry');
        return;
    }
   
    function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=voucher');
        return;
    }
    
    
    function add()
    {  
       JRequest::setVar('hidemainmenu', 1);
       $model = $this->getModel('voucher');
       $files = array();
       $model->initData();
       $number = $model->generateNumber();
       $person = $model->getPersonArray();
       
       
       $view = $this->getView('voucher', 'html');
       $ledgertype_list = array('Select an Ledger Item Type');
       
       $view->assignRef('voucher_list', $model->_data);
       $view->assignRef('voucher_num', $number);
       $view->assignRef('person_list', $person);
       $view->assignRef('file_list', $files);
       $view->assignRef('ledgeritemtype_list', $ledgertype_list);
      
       $view->display();
    }
    
     function save()
    {
        $task = JRequest::getVar('task');
        $ledger_model = $this->getModel('ledgeritem');
        
        $model = $this->getModel('voucher'); 
        $number = $model->generateNumber();
        $person = $model->getPersonArray();
        
        $stored = $model->store();
       
        
        if($stored && ($task == 'save'))
        {
            $msg = "Successfully Inserted Data";
            $this->setRedirect(COMPONENT_LINK.'&controller=voucher', $msg);
            return;
        }
        
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
        }
       $ledgertype_list=$ledger_model->getLedgerItemArray('',(int)$model->_data->ledger_activity,'ledger_type');
        JRequest::setVar('hidemainmenu', 1);
        
        $file_data = $model->getFiles($model->_data->number);
        $view = $this->getView('voucher', 'html');
        $view->assignRef('voucher_list', $model->_data);
        $view->assignRef('voucher_num', $number);
        $view->assignRef('person_list', $person);
        $view->assignRef('file_list', $file_data);
        $view->assignRef('ledgeritemtype_list', $ledgertype_list);
        $view->display();
    }
    
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('voucher');
        $number = $model->generateNumber();
        $person = $model->getPersonArray();
        $ledger_model = $this->getModel('ledgeritem');
        
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        $files=$model->getFiles($cid);
        $model->getOne($cid);
        $ledgertype_list=$ledger_model->getLedgerItemArray('',(int)$model->_data->ledger_activity,'ledger_type');
        
        $view = $this->getView('voucher', 'html');
        $view->assignRef('voucher_list', $model->_data);
        $view->assignRef('voucher_num', $number);
        $view->assignRef('person_list', $person);
        $view->assignRef('file_list', $files);
        $view->assignRef('ledgeritemtype_list', $ledgertype_list);
        $view->display();
    }
    
    
    function remove()
    {
        $model = $this->getModel('voucher');
        if($model->delete())
            $msg = JText::_('Voucher Details have been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=voucher', $msg);
    }
    
     function deletefile()
    {
        $model = $this->getModel('voucher');
        $deleted = $model->deletefile();
        
        if($deleted)
        {
            $msg = 'Selected File deleted';
            $this->setRedirect(COMPONENT_LINK.'&controller=voucher');
            return;
        }
        
        $msg = 'There is a problem in deleting the Selected File';
        $this->setRedirect(COMPONENT_LINK.'&controller=voucher');
        return;
    }
    
     function uploadreceipt()
    {   
        $bank_model = $this->getModel('banks');
        $bank_array = $bank_model->getBankArray('Select Bank');
        $model = $this->getModel('voucher');
       
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        $cheque_data=$model->getReceiptChequeOne($cid);
        $numrows=count($cheque_data);
        if($numrows==0)
        {
             $cheque_data=$model->initChequeData();
        }
        
        $release_list=$model->getVoucherReleasedOne($cid);
        
         $account_nums = array('Select an Account Number');
         
        $view = $this->getView('voucherfile', 'html');
        $view->assignRef('receipt_uploaded_list', $release_list);
        $view->assignRef('receipt_cheque_list', $cheque_data);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('account_nums', $account_nums);
       
        $view->display();
    }
    
     function release()
    {   
        $model = $this->getModel('voucher');
        $model->voucherupdate();
        $model->getSelectedList();
        $model->pagination();
        $view = $this->getView('releasevoucherlist', 'html');
        $view->assignRef('releasevoucher_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        
        $view->display();
    }
    
    
     function savereciept()
    {   
       $task = JRequest::getVar('task');
        
        $bank_model = $this->getModel('banks');
        $bank_array = $bank_model->getBankArray('Select Bank');
        
        $account_nums = array('Select an Account Number');
        
        $model = $this->getModel('voucher'); 
        $stored = $model->storeReciept();
        $voucher_list=$model->getVoucherReleasedOne($model->_data->number);
       
        $receipt_list=$model->_data;
        
        if($stored && ($task == 'save'))
        {
            $msg = "Successfully Inserted Data";
            $this->setRedirect(COMPONENT_LINK.'&controller=voucher', $msg);
            return;
        }
        
        elseif($stored && ($task == 'save2new'))
        {
            $model->initChequeData();
        }
       
        JRequest::setVar('hidemainmenu', 1);
        
        
        $view = $this->getView('voucherfile', 'html');
        $view->assignRef('receipt_uploaded_list', $voucher_list);
        $view->assignRef('receipt_cheque_list',$receipt_list);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('account_nums', $account_nums);
        
        
        $view->display();
        
    }
   
    
}