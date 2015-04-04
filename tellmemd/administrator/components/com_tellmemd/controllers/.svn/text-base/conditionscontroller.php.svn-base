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

class TellMeMdControllerConditions extends JController
{
    function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
    }
    
    function display()
    {
        $condtion_model = $this->getModel('condition');
        $condition_list = $condtion_model->getList();
        $pagination = $condtion_model->pagination();
        
        $view = $this->getView('conditionlist', 'html');
        $view->assignRef('condition_list', $condition_list);
        $view->assignRef('pagination', $pagination);
        $view->display();
    }
    
    function add()
    {
        JRequest::setVar('hidemainmenu', 1);
        $cat_model = $this->getModel('category');
        $condtion_model = $this->getModel('condition');
        
        $catlist_array = $cat_model->getCatArrayList(JText::_('COM_TELLMEMD_SELECT_CATEGORY'));
        $condtion_model->initData();
        
        $view = $this->getView('newcondition', 'html');
        $view->assignRef('condition_data', $condtion_model->_data);
        $view->assignRef('catlist_array', $catlist_array);
        $view->display();
    }
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        
        $cat_model = $this->getModel('category');
        $condtion_model = $this->getModel('condition');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $catlist_array = $cat_model->getCatArrayList(JText::_('COM_TELLMEMD_SELECT_CATEGORY'));
        $condtion_model->getOne($cid);
        
        $view = $this->getView('newcondition', 'html');
        $view->assignRef('condition_data', $condtion_model->_data);
        $view->assignRef('catlist_array', $catlist_array);
        $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $condtion_model = $this->getModel('condition');
        $cat_model = $this->getModel('category');
        
        $stored = $condtion_model->store();
        $catlist_array = $cat_model->getCatArrayList(JText::_('COM_TELLMEMD_SELECT_CATEGORY'));
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('COM_TELLMEMD_CONDITION_SAVED');
            $this->setRedirect(COMPONENT_LINK.'&controller=conditions', $msg);
            return;
        }
        elseif($stored && ($task == 'save2new'))
        {
            $condtion_model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('newcondition', 'html');
        $view->assignRef('condition_data', $condtion_model->_data);
        $view->assignRef('catlist_array', $catlist_array);
        $view->display();
    }
    
    function publish()
    {
        $condtion_model = $this->getModel('condition');
        $condtion_model->publish(1);
        $this->setRedirect(COMPONENT_LINK.'&controller=conditions');
    }
    
    function unpublish()
    {
        $condtion_model = $this->getModel('condition');
        $condtion_model->publish(0);
        $this->setRedirect(COMPONENT_LINK.'&controller=conditions');
    }
    
    function remove()
    {
        $condtion_model = $this->getModel('condition');
        if($condtion_model->delete())
            $msg = JText::_('COM_TELLMEMD_TASK_DELETED');
        $this->setRedirect(COMPONENT_LINK.'&controller=conditions', $msg);
    }
    
    function backop()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=website');
        return;
    }
}
