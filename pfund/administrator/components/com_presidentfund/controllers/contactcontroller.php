<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Jazeer
 * Developer Email  :   jazeermim@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   07 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class PFundControllerContact extends JController
{
	function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
    }
    
    function display()
    {
        $model = $this->getModel('contact');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('contactlist', 'html');
        $view->assignRef('contact_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    function add()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('contact');
        $model->initData();
		
        $view = $this->getView('contact', 'html');
        $view->assignRef('contact_data', $model->_data);
        $view->display();
    }
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('contact');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $model->getOne($cid);
        
        $view = $this->getView('contact', 'html');
        $view->assignRef('contact_data', $model->_data);
        $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $model = $this->getModel('contact');
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('Contact Added Successfuly');
            $this->setRedirect(COMPONENT_LINK.'&controller=contact', $msg);
            return;
        }
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('contact', 'html');
        $view->assignRef('contact_data', $model->_data);
        $view->display();
    }
    
    function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=configure');
        return;
    }
    
    function publish()
    {
        $model = $this->getModel('contact');
        $model->publish(1);
        $this->setRedirect(COMPONENT_LINK.'&controller=contact');
    }
    
    function unpublish()
    {
        $model = $this->getModel('contact');
        $model->publish(0);
        $this->setRedirect(COMPONENT_LINK.'&controller=contact');
    }
    
    function remove()
    {
        $model = $this->getModel('contact');
        if($model->delete())
            $msg = JText::_('Contact has been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=contact', $msg);
    }
}
