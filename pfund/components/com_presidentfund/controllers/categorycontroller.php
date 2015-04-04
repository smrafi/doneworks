<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   18 December 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class PFundControllerCategory extends JController
{
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
    }
    
    function display()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('category');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('categorylist', 'html');
        $view->assignRef('category_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    function addnew()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('category');
        $model->initData();

        $view = $this->getView('category', 'html');
        $view->assignRef('category_data', $model->_data);
        $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('category');
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('Category Added Successfuly');
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=category',FALSE), $msg);
            return;
        }
        
        
        $view = $this->getView('category', 'html');
        $view->assignRef('category_data', $model->_data);
        $view->display();
    }
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('category');
        
        $cid = JRequest::getVar('cid');
        
        $model->getOne($cid);
        
        $view = $this->getView('category', 'html');
        $view->assignRef('category_data', $model->_data);
        $view->display();
    }
    
    function remove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('category');
        if($model->delete())
            $msg = JText::_('Category has been deleted');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=category',FALSE), $msg);
    }
    
    function linkback()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=configure',FALSE));
    }
}
