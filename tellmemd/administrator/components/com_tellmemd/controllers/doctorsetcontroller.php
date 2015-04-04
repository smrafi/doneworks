<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   28 July 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class TellMeMdControllerDoctorSet extends JController
{
    function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
    }
    
    function display()
    {
        JRequest::setVar('hidemainmenu', 1);
        $setting_model = $this->getModel('docsetting');
        $docsetting_data = $setting_model->getDocSettings();
        
        $view = $this->getView('docsettings', 'html');
        $view->assignRef('setting_data', $docsetting_data);
        $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        $setting_model = $this->getModel('docsetting');
        $stored = $setting_model->store();
        
        if($stored && $task == 'save')
        {
            $msg = JText::_('COM_TELLMEMD_TASK_SAVED');
            $this->setRedirect(COMPONENT_LINK.'&controller=website&task=siteset', $msg);
            return;
        }
        
        JRequest::setVar('hidemainmenu', 1);
        $view = $this->getView('docsettings', 'html');
        $view->assignRef('setting_data', $setting_model->_data);
        $view->display();
    }
    
    function cancel()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=website&task=siteset');
        return;
    }
}
