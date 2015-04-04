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

class TellMeMdControllerLabTest extends JController
{
    function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
    }
    
    function display()
    {
        $model = $this->getModel('labtest');
        
        $test_list = $model->getList();
        $pagination = $model->pagination();
        
        $view = $this->getView('labtestlist', 'html');
        $view->assignRef('test_list', $test_list);
        $view->assignRef('pagination', $pagination);
        $view->display();
    }
    
    function add()
    {
        JRequest::setVar('hidemainmenu', 1);
        
        $model = $this->getModel('labtest');
        $cat_model = $this->getModel('category');
        
        $labtest_data = $model->initData();
        $complex_array = TellMeMDHelper::getComplexityArray(JText::_('COM_TELLMEMD_SELECT_COMPLEXITY'));
        $catlist_array = $cat_model->getCatArrayList(JText::_('COM_TELLMEMD_SELECT_CATEGORY'));
        
        $view = $this->getView('newlabtest', 'html');
        $view->assignRef('labtest_data', $labtest_data);
        $view->assignRef('complex_array', $complex_array);
        $view->assignRef('catlist_array', $catlist_array);
        $view->display();
    }
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        
        $model = $this->getModel('labtest');
        $cat_model = $this->getModel('category');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $labtest_data = $model->getOne($cid);
        $complex_array = TellMeMDHelper::getComplexityArray(JText::_('COM_TELLMEMD_SELECT_COMPLEXITY'));
        $catlist_array = $cat_model->getCatArrayList(JText::_('COM_TELLMEMD_SELECT_CATEGORY'));
        
        $view = $this->getView('newlabtest', 'html');
        $view->assignRef('labtest_data', $labtest_data);
        $view->assignRef('complex_array', $complex_array);
        $view->assignRef('catlist_array', $catlist_array);
        $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $model = $this->getModel('labtest');
        $cat_model = $this->getModel('category');
        
        $complex_array = TellMeMDHelper::getComplexityArray(JText::_('COM_TELLMEMD_SELECT_COMPLEXITY'));
        $catlist_array = $cat_model->getCatArrayList(JText::_('COM_TELLMEMD_SELECT_CATEGORY'));
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('COM_TELLMEMD_LABTEST_SAVED');
            $this->setRedirect(COMPONENT_LINK.'&controller=labtest', $msg);
            return;
        }
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('newlabtest', 'html');
        $view->assignRef('labtest_data', $model->_data);
        $view->assignRef('complex_array', $complex_array);
        $view->assignRef('catlist_array', $catlist_array);
        $view->display();
    }
    
    function publish()
    {
        $model = $this->getModel('labtest');
        $model->publish(1);
        $this->setRedirect(COMPONENT_LINK.'&controller=labtest');
    }
    
    function unpublish()
    {
        $model = $this->getModel('labtest');
        $model->publish(0);
        $this->setRedirect(COMPONENT_LINK.'&controller=labtest');
    }
    
    function remove()
    {
        $model = $this->getModel('labtest');
        if($model->delete())
            $msg = JText::_('COM_TELLMEMD_TASK_DELETED');
        $this->setRedirect(COMPONENT_LINK.'&controller=labtest', $msg);
    }
    
    function backop()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=website');
        return;
    }
}
