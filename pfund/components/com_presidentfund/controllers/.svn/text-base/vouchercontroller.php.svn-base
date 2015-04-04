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

class PFundControllerVoucher extends JController
{   
            
   function display()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
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
    
     function addnew()
    {  
       $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
       $this->addModelPath($path);
        
       $ledger_model=$this->getModel('ledgeritem');
       $ledgertype_list = $ledger_model->getLedgerItemArray('Select a Ledger',ACCOUNT_TYPE_DEBIT ,'account_type');
       
       $model = $this->getModel('voucher');
       $files = array();
       $model->initData();
       $number = $model->generateNumber();
       $person = $model->getPersonArray();
       
       
       $view = $this->getView('voucher', 'html');
       
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
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        
        $model = $this->getModel('voucher'); 
        $number = $model->generateNumber();
        $person = $model->getPersonArray();
        
        $stored = $model->store();
        
        $ledger_model=$this->getModel('ledgeritem');
        $ledgertype_list = $ledger_model->getLedgerItemArray($model->_data->ledger_typeid,ACCOUNT_TYPE_DEBIT ,'account_type');
        
        if($stored && ($task == 'save'))
        {
            $msg = "Successfully Inserted Data";
            $this->setRedirect(COMPONENT_LINK.'&controller=voucher', $msg);
            return;
        }
                
        
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
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $ledger_model=$this->getModel('ledgeritem');
        $ledgertype_list = $ledger_model->getLedgerItemArray('Select a Ledger',ACCOUNT_TYPE_DEBIT ,'account_type');
        
        $model = $this->getModel('voucher');
        $number = $model->generateNumber();
        $person = $model->getPersonArray();
       
        $cid = JRequest::getVar('cid');
        
        $files=$model->getFiles($cid);
        $model->getOne($cid);
        
        $view = $this->getView('voucher', 'html');
        $view->assignRef('voucher_list', $model->_data);
        $view->assignRef('voucher_num', $number);
        $view->assignRef('person_list', $person);
        $view->assignRef('file_list', $files);
        $view->assignRef('ledgeritemtype_list', $ledgertype_list);
        $view->display();
    }
    
    
    function uploadreceipt()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('voucher');
       
        $cid = JRequest::getVar('cid');
       
        $release_list=$model->getVoucherReleasedOne($cid);
        
        $view = $this->getView('voucherfile', 'html');
        $view->assignRef('receipt_uploaded_list', $release_list);
        
        $view->display();
    }
    
    function release()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $bank_model = $this->getModel('banks');
        $bank_array = $bank_model->getBankArray('Select Bank');
        
        $model = $this->getModel('voucher');
        $model->voucherupdate();
        $model->getSelectedList();
        $model->pagination();
        
        $account_nums = array('Select an Account Number');
        $view = $this->getView('releasevoucherlist', 'html');
        $view->assignRef('releasevoucher_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('account_nums', $account_nums);
        
        $view->display();
    }
    
    function savereciept()
    {   
       $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('voucher'); 
        $stored = $model->storeReciept();
        $voucher_list=$model->getVoucherReleasedOne($model->_data->number);
       
       
        
        if($stored && ($task == 'save'))
        {
            $msg = "Successfully Inserted Data";
            $this->setRedirect(COMPONENT_LINK.'&controller=voucher', $msg);
            return;
        }      
        
        $view = $this->getView('voucherfile', 'html');
        $view->assignRef('receipt_uploaded_list', $voucher_list);
        
        $view->display();
    }
    
     function back()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=voucher',FALSE));
        return;
        
    }
    
    function remove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('voucher');
        if($model->delete())
            $msg = JText::_('Loan Details have been deleted');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=voucher',FALSE), $msg);
    }
    
     function deletefile()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('voucher');
        $deleted = $model->deletefile();
        
        if($deleted)
        {
            $msg = 'Selected File deleted';
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=voucher',FALSE), $msg);
            return;
        }
        
        $msg = 'There is a problem in deleting the Selected File';
       $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=voucher',FALSE),$msg);
        return;
    }
    
      function backop()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=accountentry',FALSE));
        return;
    }
    
     function printvoucher()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $letter_id = JRequest::getVar('chequenumber');
        $view = $this->getView('printvoucher', 'html');
        
        $view->display();
    }
    
    
     function medical_voucher()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $view = $this->getView('medicalpayment', 'html');
       
        $view->display();
    }
    
     function acc_ob()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        
        
        $model = $this->getModel('voucher');
        $postdata = $model->getPostChequeData();
        $ledgerdata = $model->getUpdateLedger();
        $model->getSelectedList();
        $model->pagination();
        
        $view = $this->getView('voucherprint', 'html');
        $view->assignRef('selected_list', $model->_data);
        $view->assignRef('post_data', $postdata);
//        $view->assignRef('ledger_data', $ledgerdata);
        $view->assignRef('pagination', $model->_pagination);
        
        
       
        $view->display();
    }
    
    
    
   
}
