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
        $model=$this->getModel('medicalpayment');
        $model->getList();
        $model->pagination();
        $view = $this->getView('medicalpaymentlist', 'html');
        $view->assignRef('medical_payment_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
       
        $view->display();
        
    }
    
    function add()
    {    
        $view = $this->getView('medicalpayment', 'html');
        
        $view->display();
    }
    
    function backentry()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=accountentry');
        return;
    }
    
    function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=medicalpayment');
        return;
    }
    
    function medical_voucher()
    {
        $view = $this->getView('medicalvoucher', 'html');
        
        $view->display();
    }
    
    
}
