<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   19 Dec 2011
 * ***************************************************************************** */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');


class PFundControllerTemplate extends JController
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
        
        $model = $this->getModel('template');
        $template_data=$model->getone(8);
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('templatelist', 'html');
        $view->assignRef('template_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        
        $view->display();
    }
    
    function addnew()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model=$this->getModel('template');
        $model->initData();
        
        $view=$this->getview('template','html');
        $view->assignRef('template_data',$model->_data);
        $view->display();
       
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('template');
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('Template has been saved');
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=template',FALSE), $msg);
            return;
        }
               
        $view = $this->getView('template', 'html');
        $view->assignRef('template_data', $model->_data);
        $view->display();
    }
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('template');
        
        $cid = JRequest::getVar('cid');
                
        $model->getOne($cid);
        
        $view = $this->getView('template', 'html');
        $view->assignRef('template_data', $model->_data);
        $view->display();
    }
    
    function linkback()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=configure',FALSE));
    }
}

