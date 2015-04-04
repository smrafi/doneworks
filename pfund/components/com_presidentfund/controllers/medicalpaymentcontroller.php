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

class PFundControllerMedicalPayment extends JController
{   
    
    function display()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model=$this->getModel('medicalpayment');
        $model->getList();
        $model->pagination();
        $view = $this->getView('medicalpaymentlist', 'html');
        $view->assignRef('medical_payment_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
       
        $view->display();
        
    }
    
    function addnew()
    {    
        $view = $this->getView('medicalpayment', 'html');
        
        $view->display();
    }
    
    function backop()
    {   
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=voucher&task=medical_voucher',FALSE));
        return;
        
    }
    
    function acc_ob()
    {
        $type =JRequest::getInt('application_type');
        if($type==APPLICATION_TYPE_NORMAL)
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=medicalpayment&task=normal_medical',FALSE));
        if($type==APPLICATION_TYPE_REIMBURSMENT)
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=medicalpayment&task=reimbursment_medical',FALSE)); 
        return;
    }
    
    function cancel()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=voucher',FALSE));
        return;
    }
    
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        $type =JRequest::getInt('application_type');
        
        $model = $this->getModel('voucher'); 
        $number = $model->generateNumber();
        $model = $this->getModel('medicalpayment'); 
        if($type==APPLICATION_TYPE_REIMBURSMENT)
        {
        $stored = $model->store();
        
        
        if($stored && ($task == 'save'))
        {   
           
           $msg = "Successfully Inserted Data";
           $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=medicalpayment&task=reimbursment_medical',FALSE)); 
           return;
           
        }
        } 
        if($type==APPLICATION_TYPE_NORMAL)
        {
          $updated = $model->update();
          if($updated && ($task == 'save'))
        {   
           
           $msg = "Successfully Updated Data";
           $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=medicalpayment&task=normal_medical',FALSE));
           return;
           
        }
          
        }
        $view = $this->getView('medicalreceipt', 'html');
        $view->assignRef('medicalreceipt_list', $model->_data);
        $view->assignRef('voucher_num', $number);
        $view->display();
    }
    
    function medical_voucher()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $bank_model = $this->getModel('banks');
        $bank_array = $bank_model->getBankArray('Select Bank');
        
        $type =JRequest::getInt('type');
        $model = $this->getModel('medicalpayment');
        $model->voucherupdate();
        $model->getSelectedList($type);
        $model->pagination();
       
        $account_nums = array('Select an Account Number');
        
        $view = $this->getView('medicalvoucher', 'html');
        $view->assignRef('releasevoucher_list', $model->_data);
         
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('type', $type);
        $view->assignRef('account_nums', $account_nums);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    
    
    
    
     function savereimburs()
    {   
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
       
        
        $model = $this->getModel('medicalpayment');
        $stored = $model->SelectedVoucherUpdate();
            if($stored)
            {   
           
           $msg = "Successfully Updated Data";
           $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=medicalpayment&task=reimbursment_medical',FALSE)); 
           return;
           
            }
            else
            {
               $msg = "Data Not Updated";
           $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=medicalpayment&task=reimbursment_medical',FALSE)); 
           return; 
                
            }
       
    }
    
    function medical_released()
    {   
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $type =JRequest::getInt('type');
        
        $bank_model = $this->getModel('banks');
        $bank_array = $bank_model->getBankArray('Select Bank');
        
        $model = $this->getModel('medicalpayment');
        $model->getSelectedList($type);
       
        $model->pagination();
        
        $account_nums = array('Select an Account Number');
        $view = $this->getView('reimburspayment', 'html');
        $view->assignRef('releasevoucher_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('type', $type);
        $view->assignRef('account_nums', $account_nums);
        
        $view->display();
    }
    
     function uploadreceipt()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $bank_model = $this->getModel('banks');
        $bank_array = $bank_model->getBankArray('Select Bank');
        $type = JRequest::getInt('type');
        $cid = JRequest::getVar('cid'); 
        $model = $this->getModel('medicalpayment');
        
        $model->getOne($cid);
        
        $account_nums = array('Select an Account Number');
        $view = $this->getView('medicalreceipt', 'html');
        
        $view->assignRef('application_data', $model->_data);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('medical_type', $type);
        $view->assignRef('account_nums', $account_nums);
        
        $view->display();
    }
    
 
    
     function printvoucher()
    {   
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        $type =JRequest::getInt('application_type');
        
        $model = $this->getModel('medicalpayment');
        $voucher_list=$model->getPostData();
        if($type==APPLICATION_TYPE_NORMAL){
           
            $model->SelectedVoucherUpdate();
           
        }
        $model->getSelectedList($type);
        
        $view = $this->getView('printvoucher', 'html');
        $view->assignRef('voucher_list', $voucher_list);
        $view->assignRef('selected_list',$model->_data);
        $view->assignRef('type',$type);
        $view->display();
    }
    
     function reimbursment_medical()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        $type=APPLICATION_TYPE_REIMBURSMENT;
        $model=$this->getModel('medicalpayment');
        $voucher_released=$model->getVoucherList($type,APPLICATION_STATUS_VOUCHER_RELEASED);
        $receipt_uploaded=$model->getVoucherList($type,APPLICATION_STATUS_RECEIPT_UPLOADED);
        $model->getVoucherList($type,APPLICATION_STATUS_VOUCHER_RELEASE_PENDING);
        
        $model->pagination();
        $view = $this->getView('reimbursmentmedicallist', 'html');
        $view->assignRef('medical_payment_list', $model->_data);
        $view->assignRef('voucher_released_list', $voucher_released);
        $view->assignRef('receipt_uploaded_list', $receipt_uploaded);
        $view->assignRef('pagination', $model->_pagination);
       
        $view->display();
    }
    
     function normal_medical()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        $type=APPLICATION_TYPE_NORMAL;
        $model=$this->getModel('medicalpayment');
        $voucher_released=$model->getVoucherList($type,APPLICATION_STATUS_PAYMENT_RELEASED);
        $receipt_uploaded=$model->getVoucherList($type,APPLICATION_STATUS_RECEIPT_UPLOADED);
      
        $model->getVoucherList($type,APPLICATION_STATUS_VOUCHER_RELEASE_PENDING);
        $model->pagination();
        $view = $this->getView('medicalpaymentlist', 'html');
        $view->assignRef('medical_payment_list', $model->_data);
        $view->assignRef('voucher_released_list', $voucher_released);
        $view->assignRef('receipt_uploaded_list', $receipt_uploaded);

        $view->assignRef('pagination', $model->_pagination);
       
        $view->display();
    }
}