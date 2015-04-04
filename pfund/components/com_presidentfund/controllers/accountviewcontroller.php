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

class PFundControllerAccountView extends JController
{
    
    
    function display()
    {
      
        $view = $this->getView('accountview', 'html');
        $view->display();
    }
    
    function receivable()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $date_from =  JRequest::getVar('date_from');
        $date_to = JRequest::getVar('date_to');
        
        $interest_model = $this->getModel('receivable');
        $loan_model = $this->getModel('receivable');
        $interest_model->getinterestList($date_from, $date_to);
        $loan_model->getloantList($date_from, $date_to);
        $interest_model->pagination();
        
        $view = $this->getView('acviewreceivable', 'html');
        $view->assignRef('receivable_data',$interest_model->_data);
        $view->assignRef('loan_data',$loan_model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    function payable()
    {
      
        $view = $this->getView('acviewpayable', 'html');
        $view->display();
    }
    
    //viewledgerbook
    function ledger()
    {
      
        $view = $this->getView('acviewledgerbook', 'html');
        $view->display();
    }
    
    function subledger()
    {
      
        $view = $this->getView('subledgerlist', 'html');
        $view->display();
    }
    
//view recipt summery
    function recpts()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $bankmodel=$this->getModel('banks');
        $bank_array = $bankmodel->getBankArray('*');
        $model = $this->getModel('income');
        
        $date_from = JRequest::getVar('date_from');
        $date_to = JRequest::getVar('date_to');
        
        $model->viewrecipt($date_from,$date_to);
        $model->pagination();
        
        $view = $this->getView('receiptsummerylist', 'html');
        $view->assignRef('receipt_summery',$model->_data);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    //voucher summery
    function voucher()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $date_from = JRequest::getVar('date_from');
        $date_to = JRequest::getVar('date_to');
        
        $model = $this->getModel('voucher');
        $model->getvoucherviewList($date_from,$date_to);
        $model->pagination();
      
        $view = $this->getView('acviewvouchersummary', 'html');
        $view->assignRef('voucher_summary',$model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    
        
}