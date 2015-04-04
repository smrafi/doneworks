<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Jazeer
 * Developer Email  :   jazeermim@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   06 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class PFundControllerCategory extends JController
{
	function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
    }
    
    function display()
    {
        $model = $this->getModel('category');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('categorylist', 'html');
        $view->assignRef('category_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
     function add()
    {
         JRequest::setVar('hidemainmenu', 1);
         $model = $this->getModel('category');
         $model->initData();
         
         $view = $this->getView('category', 'html');
         $view->assignRef('category_data', $model->_data);
         $view->display();
    }
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('category');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $model->getOne($cid);
        
        $view = $this->getView('category', 'html');
        $view->assignRef('category_data', $model->_data);
        $view->display();
    }
    
     function save()
    {
        $task = JRequest::getVar('task');
        
        $model = $this->getModel('category');
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('Category Added Successfuly');
            $this->setRedirect(COMPONENT_LINK.'&controller=category', $msg);
            return;
        }
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('category', 'html');
        $view->assignRef('category_data', $model->_data);
        $view->display();
    }
    
    function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=configure');
        return;
    }
    
    function publish()
    {
        $model = $this->getModel('category');
        $model->publish(1);
        $this->setRedirect(COMPONENT_LINK.'&controller=category');
    }
    
    function unpublish()
    {
        $model = $this->getModel('category');
        $model->publish(0);
        $this->setRedirect(COMPONENT_LINK.'&controller=category');
    }
    
    function remove()
    {
        $model = $this->getModel('category');
        if($model->delete())
            $msg = JText::_('Category has been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=category', $msg);
    }
}
