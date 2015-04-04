<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   16 August 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class TellMeMdControllerDoctor extends JController
{
    function display()
    {
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        //get the common model
        $common_model = $this->getModel('common');
        $user_info = $common_model->getUserInfo();
        
        $view = $this->getView('doctorform', 'html');
        $view->assignRef('user_info', $user_info);
        $view->display();
    }
    
    function saveform()
    {
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        //get the common model
        $common_model = $this->getModel('common');
        $cat_model = $this->getModel('category');
        
        $cat_list = $cat_model->getCatArrayList('Select a category');
        $stored = $common_model->storeForm();
        
        if($stored)
        {
            $view = $this->getView('qualifyform', 'html');
            $view->assignRef('user_id', $common_model->_data->user_id);
            $view->assignRef('cat_list', $cat_list);
            $view->display();
            return;
        }
        
        $view = $this->getView('doctorform', 'html');
        $view->assignRef('user_info', $common_model->_data);
        $view->display();
    }
    
    function savequalification()
    {
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        //get the common model
        $common_model = $this->getModel('common');
        $cat_model = $this->getModel('category');
        
        $cat_list = $cat_model->getCatArrayList('Select a category');
        $stored = $common_model->storeQualification();
        
        if($stored)
        {
            $view = $this->getView('docthanks', 'html');
            $view->display();
            return;
        }
        
        $view = $this->getView('qualifyform', 'html');
        $view->assignRef('user_id', $common_model->_data->user_id);
        $view->assignRef('cat_list', $cat_list);
        $view->display();
    }
    
    function casestable()
    {
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $case_model = $this->getModel('case');
        $cat_model = $this->getModel('category');
        $case_model->getCaseByUserID('doc');
        $case_model->pagination();
        $cat_list = $cat_model->getCatArrayList('All Categories');
        
        $controller_name = 'doctor';
        $task_name = 'casestable';
        $view_type = CASE_VIEW_TYPE_DOCTOR;
        
        $view = $this->getView('casestable', 'html');
        $view->assignRef('case_data', $case_model->_data);
        $view->assignRef('pagination', $case_model->_pagination);
        $view->assignRef('controller_name', $controller_name);
        $view->assignRef('task_name', $task_name);
        $view->assignRef('view_type', $view_type);
        $view->assignRef('cat_list', $cat_list);
        $view->display();
    }
    
    function viewcase()
    {
        $view = $this->getView('docviewcase', 'html');
        $view->display();
    }
    
    function medicalhistory()
    {
        $view = $this->getView('patientmedicalhistory', 'html');
        $view->display();
    }
    
    function casepool()
    {
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $case_model = $this->getModel('case');
        $cat_model = $this->getModel('category');
        $case_model->getCaseByUserID('pool');
        $case_model->pagination();
        $cat_list = $cat_model->getCatArrayList('All Categories');
        
        $controller_name = 'doctor';
        $task_name = 'casepool';
        $view_type = CASE_VIEW_TYPE_POOL;
        
        $view = $this->getView('casestable', 'html');
        $view->assignRef('case_data', $case_model->_data);
        $view->assignRef('pagination', $case_model->_pagination);
        $view->assignRef('controller_name', $controller_name);
        $view->assignRef('task_name', $task_name);
        $view->assignRef('view_type', $view_type);
        $view->assignRef('cat_list', $cat_list);
        $view->display();
    }
    
    function poolcase()
    {
        $view = $this->getView('poolviewcase', 'html');
        $view->display();
    }
    
    function docalerts()
    {
        $view = $this->getView('docalerts', 'html');
        $view->display();
    }
    
    function docfeedback()
    {
        $view = $this->getView('docfeedback', 'html');
        $view->display();
    }
    
    function docprofile()
    {
        $view = $this->getView('docprofile', 'html');
        $view->display();
    }
    
    function editprofile()
    {
        $view = $this->getView('editdocprofile', 'html');
        $view->display();
    }
}