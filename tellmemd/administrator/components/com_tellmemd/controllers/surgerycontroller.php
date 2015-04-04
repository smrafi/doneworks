<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   21 September 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class TellMeMdControllerSurgery extends JController
{
    function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
    }
    
    function display()
    {
        $surgery_model = $this->getModel('surgery');
        $surgery_list = $surgery_model->getList();
        $pagination = $surgery_model->pagination();
        
        $view = $this->getView('surgerylist', 'html');
        $view->assignRef('surgery_list', $surgery_list);
        $view->assignRef('pagination', $pagination);
        $view->display();
    }
    
    function add()
    {
        JRequest::setVar('hidemainmenu', 1);
        $cat_model = $this->getModel('category');
        $surgery_model = $this->getModel('surgery');
        
        $catlist_array = $cat_model->getCatArrayList(JText::_('COM_TELLMEMD_SELECT_CATEGORY'));
        $surgery_model->initData();
        
        $view = $this->getView('newsurgery', 'html');
        $view->assignRef('surgery_data', $surgery_model->_data);
        $view->assignRef('catlist_array', $catlist_array);
        $view->display();
    }
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        
        $cat_model = $this->getModel('category');
        $surgery_model = $this->getModel('surgery');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $catlist_array = $cat_model->getCatArrayList(JText::_('COM_TELLMEMD_SELECT_CATEGORY'));
        $surgery_model->getOne($cid);
        
        $view = $this->getView('newsurgery', 'html');
        $view->assignRef('surgery_data', $surgery_model->_data);
        $view->assignRef('catlist_array', $catlist_array);
        $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $surgery_model = $this->getModel('surgery');
        $cat_model = $this->getModel('category');
        
        $stored = $surgery_model->store();
        $catlist_array = $cat_model->getCatArrayList(JText::_('COM_TELLMEMD_SELECT_CATEGORY'));
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('COM_TELLMEMD_SURGERY_SAVED');
            $this->setRedirect(COMPONENT_LINK.'&controller=surgery', $msg);
            return;
        }
        elseif($stored && ($task == 'save2new'))
        {
            $surgery_model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('newsurgery', 'html');
        $view->assignRef('surgery_data', $surgery_model->_data);
        $view->assignRef('catlist_array', $catlist_array);
        $view->display();
    }
    
    function publish()
    {
        $surgery_model = $this->getModel('surgery');
        $surgery_model->publish(1);
        $this->setRedirect(COMPONENT_LINK.'&controller=surgery');
    }
    
    function unpublish()
    {
        $surgery_model = $this->getModel('surgery');
        $surgery_model->publish(0);
        $this->setRedirect(COMPONENT_LINK.'&controller=surgery');
    }
    
    function remove()
    {
        $surgery_model = $this->getModel('surgery');
        if($surgery_model->delete())
            $msg = JText::_('COM_TELLMEMD_TASK_DELETED');
        $this->setRedirect(COMPONENT_LINK.'&controller=surgery', $msg);
    }
    
    function backop()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=website');
        return;
    }
}
