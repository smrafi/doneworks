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

class PFundControllerBankReconcilate extends JController
{
    
    
    function display()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('bankreconcilate');
        $credit_data=$model->getList(ACCOUNT_TYPE_DEBIT);
        $debit_data=$model->getList(ACCOUNT_TYPE_CREDIT);
        $model->pagination();
        
        $view = $this->getView('bankreconcilate', 'html');
        $view->assignRef('credit_data',$credit_data);
        $view->assignRef('debit_data',$debit_data);
        $view->assignRef('pagination',$model->_pagination);
        $view->display();
    }
    
   function linkback()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=accountentry',FALSE));
        return;
    }
    
     function statusupdate()
    {
         
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        $model = $this->getModel('bankreconcilate');
        $updated = $model->updateStatus();
        
        if($updated)
        {
            $msg = 'Record Has Been Updated';
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=bankreconcilate',$msg));
            return;
        }
        
        $msg = 'There is a problem in Updating the Record';
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=bankreconcilate',$msg));
        return;
    }
}