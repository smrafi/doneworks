<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   07 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class PFundControllerDsOffice extends JController
{
    
   function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
    }
    
    function display()
    {
        $model = $this->getModel('dsoffice');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('dsofficelist', 'html');
        $view->assignRef('dsoffice_data', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
        
    }
    function add()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model=$this->getModel('dsoffice');
        $model->initData();
          
        $view = $this->getView('dsoffice', 'html');
        $view->assignRef('dsoffice_data', $model->_data);
        $view->display();
    }
    
     function save()
    {
        $task = JRequest::getVar('task');
        
        $model = $this->getModel('dsoffice');
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = "Successfully Inserted Data";
            $this->setRedirect(COMPONENT_LINK.'&controller=dsoffice', $msg);
            return;
        }
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('dsoffice', 'html');
        $view->assignRef('dsoffice_data', $model->_data);
        $view->display();
    }

    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('dsoffice');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $model->getOne($cid);
        
        $view = $this->getView('dsoffice', 'html');
        $view->assignRef('dsoffice_data', $model->_data);
        $view->display();
    }
    
    function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=configure');
        return;
    }
    
    function publish()
    {
        $model = $this->getModel('dsoffice');
        $model->publish(1);
        $this->setRedirect(COMPONENT_LINK.'&controller=dsoffice');
    }
    
    function unpublish()
    {
        $model = $this->getModel('dsoffice');
        $model->publish(0);
        $this->setRedirect(COMPONENT_LINK.'&controller=dsoffice');
    }
    
    function remove()
    {
        $model = $this->getModel('dsoffice');
        if($model->delete())
            $msg = JText::_('Selected Details has been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=dsoffice', $msg);
    }
    
}