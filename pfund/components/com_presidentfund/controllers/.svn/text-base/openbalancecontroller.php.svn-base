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

class PFundControllerOpenBalance extends JController
{   
    
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
    }
    
    function display()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
    
        $model = $this->getModel('openbalance');
        $result=$model->getOpenBalanceList(); 
        $model->getList(); 
        $view = $this->getView('openbalancelist', 'html');
        $view->assignRef('openbalance_list', $model->_data);
        $view->assignRef('result', $result);
        $view->display();
       
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
                
        $model = $this->getModel('openbalance');
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = "Successfully Inserted Data";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=openbalance',FALSE), $msg);
            return;
        }
        
        $view = $this->getView('openbalancelist', 'html');
        $view->assignRef('openbalance_list', $model->_data);
        $view->display();
    }
    
    function backop()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=ledgeritem&task=addnew',FALSE));
        return;
    }
    
} 
