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

class PFundControllerDsOffice extends JController
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
        
        $model = $this->getModel('dsoffice');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('dsofficelist', 'html');
        $view->assignRef('dsoffice_data', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
        
    }
    
    function addnew()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model=$this->getModel('dsoffice');
        $model->initData();
          
        $view = $this->getView('dsoffice', 'html');
        $view->assignRef('dsoffice_data', $model->_data);
        $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('dsoffice');
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = "Successfully Inserted Data";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=dsoffice',FALSE), $msg);
            return;
        }
                
        $view = $this->getView('dsoffice', 'html');
        $view->assignRef('dsoffice_data', $model->_data);
        $view->display();
        
    }
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('dsoffice');
        
        $cid = JRequest::getVar('cid');
        
        
        $model->getOne($cid);
        
        $view = $this->getView('dsoffice', 'html');
        $view->assignRef('dsoffice_data', $model->_data);
        $view->display();
    }
    
    function remove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('dsoffice');
        if($model->delete())
            $msg = JText::_('Selected Details has been deleted');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=dsoffice',FALSE), $msg);
    }
    
    function linkback()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=configure',FALSE));
    }
}

