<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   27 July 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class TellMeMdControllerReport extends JController
{
    function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
    }
    
    function display()
    {
        $view = $this->getView('reportlist', 'html');
        $view->display();
    }
    
    function pending(){      
        
        $model = $this->getModel('pendingpayments');
        $pp_list = $model->getPendingPayments();
        
       
        $pagination =  $model->pagination();
        
        $view = $this->getView('pendingpaymentlist', 'html');
        $view->assignRef('pp_list', $pp_list);
        $view->assignRef('pagination', $pagination);
        $view->display();
    }
    
    function expense(){
        
        $model = $this->getModel('incomeandexpenses');
        $case_list=$model->getCaseDetails();
        $income_list=$model->getIncomeDetails();        
                
        $view = $this->getView('incomeandexpense', 'html');
        $view->assignRef('case_list',$case_list);
        $view->assignRef('income_list',$income_list);
        $view->display();
        
        
    }
    
    function pay(){
        $cid = JRequest::getVar('cid', 0);
        $model = $this->getModel('pendingpayments');
        $model->paymentUpdate($cid);
        $pp_list = $model->getPendingPayments();
        
       
        $pagination =  $model->pagination();
        
        $view = $this->getView('pendingpaymentlist', 'html');
        $view->assignRef('pp_list', $pp_list);
        $view->assignRef('pagination', $pagination);
        $view->display();        
    }
    
    function refundHalf(){        
        
        $case_id = JRequest::getVar('case_id', 0);
        $type = JRequest::getVar('type', 0);
        
        $model = $this->getModel('pendingpayments');
        $result= $model->setRefund($case_id,$type); 
        echo $result;
        
    }
    function refundFull(){
        
        $case_id = JRequest::getVar('case_id', 0);
        $type = JRequest::getVar('type', 0);
        $model = $this->getModel('pendingpayments');
        $result= $model->setRefund($case_id,$type); 
        echo $result;
        
    }
}
