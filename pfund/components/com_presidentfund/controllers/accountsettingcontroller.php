<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   19 Dec 2011
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');


class PFundControllerAccountsetting extends JController
{
    
    function banks()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('banks');
        $model->getBanksList();
        
        $view = $this->getView('banks', 'html');
        $view->assignRef('banks', $model->_data);
        $view->display();
    }
    
    function cancel()
    {
       $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=account',FALSE));
        return;
    }
    
    function backop()
    {
       $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=bankaccount&task=addnew',FALSE));
        return;
    }
    
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('banks');
        $stored = $model->storeBanks();
        $model->getBanksList();
        $bankmodel = $this->getModel('banks');
        $bank_array = $bankmodel->getBankArray('Select Bank');
        
        if($stored and $task == 'save')
        {
            $msg = "Banks Are Added";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=accountsetting&task=banks',FALSE), $msg);
            return;
        }
        
        JRequest::setVar('hidemainmenu', 1);
        $view = $this->getView('banks', 'html');
        $view->assignRef('banks', $model->_data);
         $view->assignRef('bank_array', $bank_array);
        $view->display();
    }
 
}
