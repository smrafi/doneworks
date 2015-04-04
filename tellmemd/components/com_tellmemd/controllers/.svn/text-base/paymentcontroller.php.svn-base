<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   25 August 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class TellMeMdControllerPayment extends JController
{
    function ppreturn()
    {
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $payment_model = $this->getModel('payment');
        
        if(!$payment_model->verifyPayment())
            $this->setRedirect (COMPONENT_FRONT_LINK.'?controller=payment&task=ppfail');
        
        //if payment is not completed or pending we route to payment not completed
        if($payment_model->_data->status != PAYMENT_COOMPLETED)
            $this->setRedirect (COMPONENT_FRONT_LINK.'?controller=payment&task=ppnotcomplete');
        
        //get list of doctors according to the category user selected
        $doctor_data = $payment_model->getCategoryDoctors();
        
        //store the informations to case table
        $payment_model->storeCasesTable();
        
        //we then take the user to doctor selection part
        $view = $this->getView('doctorselect', 'html');
        $view->assignRef('doctor_data', $doctor_data);
        $view->display();
    }
    
    function ppcancel()
    {
        $vars = JRequest::get();
        print_r($vars);
    }
    
    function ppfail()
    {
        echo 'payment process failed';
    }
    
    function ppnotcomplete()
    {
        echo 'Your payment is not completed yet';
    }
}
