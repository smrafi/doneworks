<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   26 August 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class TellMeMdControllerPatient extends JController
{
    function display()
    {
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $case_model = $this->getModel('case');
        $cat_model = $this->getModel('category');
        $case_model->getCaseByUserID();
        $case_model->pagination();
        $cat_list = $cat_model->getCatArrayList('All Categories');
        
        $controller_name = 'patient';
        $task_name = '';
        $view_type = CASE_VIEW_TYPE_PATIENT;
        
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
        $view = $this->getView('individualcase', 'html');
        $view->display();
    }
    
    function newcase()
    {
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $cat_model = $this->getModel('category');
        $labtest_model = $this->getModel('labtest');
        
        $cat_list = $cat_model->getCatArrayList();
        $labtest_list = $labtest_model->getLabListArray();
        
        $view = $this->getView('createcase', 'html');
        $view->assignRef('cat_list', $cat_list);
        $view->assignRef('labtest_list', $labtest_list);
        $view->display();
    }
    
    function templatelink()
    {
        $lab_id = JRequest::getVar('lab_id');
        
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $labtest_model = $this->getModel('labtest');
        $labtest_data = $labtest_model->getOne($lab_id);
        
        $view = $this->getView('templatelink', 'html');
        $view->assignRef('labtest_data', $labtest_data);
        $view->display();
    }
    
    function processque()
    {
        $user =& JFactory::getUser();
        $temp_id = uniqid('temp');
        
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $que_model = $this->getModel('question');
        $cat_model = $this->getModel('category');
        $labtest_model = $this->getModel('labtest');
        
        //if user is not logged in yet we store the information in temp table and redirect to login page
        if($user->guest)
        {
            $que_model->_data->temp_id = $temp_id;
            $stored = $que_model->storeTempData();
            
            if($stored)
            {
                $this->routeLogin($que_model->_data->temp_id, 'quecont');
                return;
            }
        }
        else
        {
            $stored = $que_model->store();
            if($stored)
            {
                $this->setRedirect (COMPONENT_FRONT_LINK.'?controller=cases&case_num='.$que_model->_data->case_num.'&case_type='.CASE_TYPE_QUEANS );
                return;
            }
            else
            {
                $cat_list = $cat_model->getCatArrayList();
                $labtest_list = $labtest_model->getLabListArray();
                
                $view = $this->getView('createcase', 'html');
                $view->assignRef('cat_list', $cat_list);
                $view->assignRef('labtest_list', $labtest_list);
                $view->display();
                return;
            }
        }
    }
    
    function processlab()
    {
        $user =& JFactory::getUser();
        $temp_id = uniqid('temp');
        
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $labcase_model = $this->getModel('labcase');
        $cat_model = $this->getModel('category');
        $labtest_model = $this->getModel('labtest');
        
        //if user is not logged in yet we store the information in temp table and redirect to login page
        if($user->guest)
        {
            $labcase_model->_data->temp_id = $temp_id;
            $stored = $labcase_model->storeTempData();
            
            if($stored)
            {
                $this->routeLogin($labcase_model->_data->temp_id, 'labcont');
                return;
            }
        }
        else
        {
            $stored = $labcase_model->store();
            if($stored)
            {
                $this->setRedirect (COMPONENT_FRONT_LINK.'?controller=cases&case_num='.$labcase_model->_data->case_num.'&case_type='.CASE_TYPE_LABTEST );
                return;
            }
            else
            {
                $cat_list = $cat_model->getCatArrayList();
                $labtest_list = $labtest_model->getLabListArray();
                
                $view = $this->getView('createcase', 'html');
                $view->assignRef('cat_list', $cat_list);
                $view->assignRef('labtest_list', $labtest_list);
                $view->display();
                return;
            }
        }
    }
    
    function quecont()
    {
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $que_model = $this->getModel('question');
        
        $stored = $que_model->storePermenent();
        
        //if stored then we delte the row from temp data
        if($stored)
            $deleted = $que_model->deleteTempData();
        
        if($stored && $deleted)
        {
            $this->setRedirect (COMPONENT_FRONT_LINK.'?controller=cases&case_num='.$que_model->_data->case_num.'&case_type='.CASE_TYPE_QUEANS );
            return;
        }
        else
        {
            $msg = "There was a problem in processing your information.";
            $this->setRedirect (COMPONENT_FRONT_LINK.'?controller=patient&task=newcase', $msg);
            return;
        }
    }
    
    function labcont()
    {
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $labcase_model = $this->getModel('labcase');
        $stored = $labcase_model->storePermenent();
        
        //if stored then we delte the row from temp data
        if($stored)
            $deleted = $labcase_model->deleteTempData();
        
        if($stored && $deleted)
        {
            $this->setRedirect (COMPONENT_FRONT_LINK.'?controller=cases&case_num='.$labcase_model->_data->case_num.'&case_type='.CASE_TYPE_LABTEST );
            return;
        }
        else
        {
            $msg = "There was a problem in processing your information.";
            $this->setRedirect (COMPONENT_FRONT_LINK.'?controller=patient&task=newcase', $msg);
            return;
        }
    }
    
    function alerts()
    {
        $view = $this->getView('patientalerts', 'html');
        $view->display();
    }
    
    function feedback()
    {
        $view = $this->getView('patientfeedback', 'html');
        $view->display();
    }
    
    function docprofile()
    {
        $view = $this->getView('docprofile', 'html');
        $view->display();
    }
    
    function medhistory()
    {
        $view = $this->getView('medhistory', 'html');
        $view->display();
    }
    
    function routeLogin($temp_id, $task)
    {
        $return_url = COMPONENT_FRONT_LINK.'?controller=patient&task='.$task.'&temp_id='.$temp_id;
        $return_url = base64_encode($return_url);
        $login_link = JURI::root().'index.php/component/users/?view=login&temp_id='.$temp_id;
        
        $msg = 'Please login or register to continue';
        $this->setRedirect($login_link.'&return='.$return_url, $msg, 'notice');
        return;
    }
}
