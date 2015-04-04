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

class PFundControllerOpenBalance extends JController
{   
    
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
        
    }
 
    function display()
    {   
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('openbalance');
        $model->getList(); 
        $view = $this->getView('openbalancelist', 'html');
        $view->assignRef('openbalance_list', $model->_data);
        $view->display();
       
    }
    
     function save()
    {
        $task = JRequest::getVar('task');
        
        $model = $this->getModel('openbalance');
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = "Successfully Inserted Data";
            $this->setRedirect(COMPONENT_LINK.'&controller=openbalance', $msg);
            return;
        }
        
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('openbalancelist', 'html');
        $view->assignRef('openbalance_list', $model->_data);
        $view->display();
    }
    
    function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=account');
        return;
    }
    
   
}
