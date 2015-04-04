<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class PfundControllerFile extends JController
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
        
        $model=$this->getModel('file');
        $model->getList();
        $model->pagination();
        
        $view=$this->getView('filelist','html');
        $view->assignRef('file_list',$model->_data);
        $view->assignRef('pagination', $model->_pagination);
       
        $view->display();
        
    }
    
    function addnew()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model=$this->getModel('file');
        $model->initData();
        
        $view=$this->getView('file','html');
        $view->assignRef('file_data', $model->_data);
        $view->display();
                
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model=$this->getModel('file');
        $stored=$model->store();
        
        //store a note at application
        if($stored and $model->_data->trackid)
        {
            $model->addApplicationNote('updated');
                
        }
        elseif($stored and !$model->_data->trackid)
        {
                $model->addApplicationNote('uploaded');
                $model->addApplicationDetailNote();
        }
        
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('Document Added Successfuly');
            $pnum = JRequest::getint('pnum');
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=file&application_id='.$model->_data->application_id.'&pnum='.$pnum, FALSE), $msg);
            return;
        }
       
        $view=$this->getView('file','html');
        $view->assignRef('file_data',$model->_data);
        $view->display();
    }
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('file');
        
        $cid = JRequest::getVar('cid');
        
        
        $model->getOne($cid);
        
        $view = $this->getView('file', 'html');
        $view->assignRef('file_data', $model->_data);
        $view->display();
    }
    
    //dev meril 27 jan 2012
    //requierd documet upload
    
    function reqAppDocUpload()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $task = JRequest::getVar('task');
        
        $model=$this->getModel('file');
        
        $model->initData();
        
        $view=$this->getView('reqdocument','html');
        $view->assignRef('file_data', $model->_data);
        $view->display();
    } 
    
    function storeReqAppDoc()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model=$this->getModel('file');
        
        if($model->storeReqDocumet())
        {
            $application_id = JRequest::getInt('application_id');
            $pnum = JRequest::getint('pnum');
            $msg = "Required files have been uploaded";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$application_id.'&pnum='.$pnum, FALSE), $msg);
        }
    }

    
    function remove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $application_id = JRequest::getInt('application_id');
        $pnum = JRequest::getint('pnum');
        
        $model = $this->getModel('file');
        if($model->delete())
            $msg = JText::_('Document Details have been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=file&application_id='.$application_id.'&pnum='.$pnum, $msg);
        return;
    }
    
    function backop()
    {
        $application_id = JRequest::getInt('application_id');
        $pnum = JRequest::getint('pnum');
        $app_type = JRequest::getInt('app_type');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$application_id.'&pnum='.$pnum.'&app_type='.$app_type, FALSE));
    }
}
