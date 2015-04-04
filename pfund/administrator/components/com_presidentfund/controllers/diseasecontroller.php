<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   06 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class PFundControllerDisease extends JController
{
    
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
    }
    
    function display()
    {
        $model = $this->getModel('disease');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('diseaselist', 'html');
        $view->assignRef('disease_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
        
    }
    
    function add()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('disease');
        $cat_model = $this->getModel('category');
        
        $model->initData();
        $cat_array = $cat_model->getCatArray('Select a category');
        
        $view = $this->getView('disease', 'html');
        $view->assignRef('disease_data', $model->_data);
        $view->assignRef('cat_array', $cat_array);
        $view->display();
        
    }
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('disease');
        $cat_model = $this->getModel('category');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $model->getOne($cid);
        $cat_array = $cat_model->getCatArray('Select a category');
        
        $view = $this->getView('disease', 'html');
        $view->assignRef('disease_data', $model->_data);
        $view->assignRef('cat_array', $cat_array);
        $view->display();
    }
    
     function save()
    {
        $task = JRequest::getVar('task');
        
        $model = $this->getModel('disease');
        $cat_model = $this->getModel('category');
        
        $stored = $model->store();
        $cat_array = $cat_model->getCatArray('Select a category');
        
        if($stored && ($task == 'save'))
        {
            $msg = "Medical condition has been saved";
            $this->setRedirect(COMPONENT_LINK.'&controller=disease', $msg);
            return;
        }
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('disease', 'html');
        $view->assignRef('disease_data', $model->_data);
        $view->assignRef('cat_array', $cat_array);
        $view->display();
    }
    
    function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=configure');
        return;
    }
    
    function publish()
    {
        $model = $this->getModel('disease');
        $model->publish(1);
        $this->setRedirect(COMPONENT_LINK.'&controller=disease');
    }
    
    function unpublish()
    {
        $model = $this->getModel('disease');
        $model->publish(0);
        $this->setRedirect(COMPONENT_LINK.'&controller=disease');
    }
    
    function remove()
    {
        $model = $this->getModel('disease');
        if($model->delete())
            $msg = JText::_('Medical condition has been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=disease', $msg);
    }

}
