<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   19 Dec 2011
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class PFundControllerDisease extends JController
{
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
    }
    
    function display()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('disease');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('diseaselist', 'html');
        $view->assignRef('disease_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
        
    }
    
    function addnew()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
                
        $model = $this->getModel('disease');
        $cat_model = $this->getModel('category');
        
        $model->initData();
        $cat_array = $cat_model->getCatArray('Select a category');
        
        $view = $this->getView('disease', 'html');
        $view->assignRef('disease_data', $model->_data);
        $view->assignRef('cat_array', $cat_array);
        $view->display();
        
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('disease');
        $cat_model = $this->getModel('category');
        
        $stored = $model->store();
        $cat_array = $cat_model->getCatArray('Select a category');
        
        if($stored && ($task == 'save'))
        {
            $msg = "Medical condition has been saved";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=disease',FALSE), $msg);
            return;
        }
        
                
        $view = $this->getView('disease', 'html');
        $view->assignRef('disease_data', $model->_data);
        $view->assignRef('cat_array', $cat_array);
        $view->display();
    }
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('disease');
        $cat_model = $this->getModel('category');
        
        $cid = JRequest::getVar('cid');
        
        $model->getOne($cid);
        $cat_array = $cat_model->getCatArray('Select a category');
        
        $view = $this->getView('disease', 'html');
        $view->assignRef('disease_data', $model->_data);
        $view->assignRef('cat_array', $cat_array);
        $view->display();
    }
    
    function remove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('disease');
        if($model->delete())
            $msg = JText::_('Medical condition has been deleted');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=disease',FALSE), $msg);
    }
    
    function linkback()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=configure',FALSE));
    }
}
