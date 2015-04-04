<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class PfundControllerFile extends JController
{
    function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
    }
    
    function display()
    {
        $model=$this->getModel('file');
        $model->getList();
        $model->pagination();
        
        $view=$this->getView('filelist','html');
        $view->assignRef('file_list',$model->_data);
        $view->assignRef('pagination', $model->_pagination);
       
        $view->display();
        
    }
    
    function add()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model=$this->getModel('file');
        $model->initData();
        
        $view=$this->getView('file','html');
        $view->assignRef('file_data', $model->_data);
        $view->display();
                
    }
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('file');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $model->getOne($cid);
        
        $view = $this->getView('file', 'html');
        $view->assignRef('file_data', $model->_data);
        $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $model=$this->getModel('file');
        $stored=$model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('Document Added Successfuly');
            $this->setRedirect(COMPONENT_LINK.'&controller=file&application_id='.$model->_data->application_id, $msg);
            return;
        }
        
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view=$this->getView('file','html');
        $view->assignRef('file_data',$model->_data);
        $view->display();
    }
    
    function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=application');
        return;
    }
    
    function publish()
    {
        $model = $this->getModel('file');
        $model->publish(1);
        $this->setRedirect(COMPONENT_LINK.'&controller=file');
    }
    
    function unpublish()
    {
        $model = $this->getModel('file');
        $model->publish(0);
        $this->setRedirect(COMPONENT_LINK.'&controller=file');
    }
    
    function remove()
    {
        $model = $this->getModel('file');
        if($model->delete())
            $msg = JText::_('Document Details have been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=file', $msg);
    }
    
   
}