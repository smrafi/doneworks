<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   27 July 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class TellMeMdControllerCategory extends JController
{
    function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
    }
    
    function display()
    {
        $cat_model = $this->getModel('category');
        $cat_list = $cat_model->getList();
        $pagination = $cat_model->pagination();
        
        $view = $this->getView('categorylist', 'html');
        $view->assignRef('cat_list', $cat_list);
        $view->assignRef('pagination', $pagination);
        $view->display();
    }
    
    function add()
    {
        JRequest::setVar('hidemainmenu', 1);
        
        $cat_model = $this->getModel('category');
        $cat_data = $cat_model->initData();
        
        $view = $this->getView('newcategory', 'html');
        $view->assignRef('cat_data', $cat_data);
        $view->display();
    }
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        
        $cat_model = $this->getModel('category');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $cat_data = $cat_model->getOne($cid);
        
        $view = $this->getView('newcategory', 'html');
        $view->assignRef('cat_data', $cat_data);
        $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $cat_model = $this->getModel('category');
        $stored = $cat_model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('COM_TELLMEMD_CATEGORY_SAVED');
            $this->setRedirect(COMPONENT_LINK.'&controller=category', $msg);
            return;
        }
        elseif($stored && ($task == 'save2new'))
        {
            $cat_model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('newcategory', 'html');
        $view->assignRef('cat_data', $cat_model->_data);
        $view->display();
    }
    
    function publish()
    {
        $cat_model = $this->getModel('category');
        $cat_model->publish(1);
        $this->setRedirect(COMPONENT_LINK.'&controller=category');
    }
    
    function unpublish()
    {
        $cat_model = $this->getModel('category');
        $cat_model->publish(0);
        $this->setRedirect(COMPONENT_LINK.'&controller=category');
    }
    
    function remove()
    {
        $cat_model = $this->getModel('category');
        if($cat_model->delete())
            $msg = JText::_('COM_TELLMEMD_TASK_DELETED');
        $this->setRedirect(COMPONENT_LINK.'&controller=category', $msg);
    }
    
    function backop()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=website');
        return;
    }
}
