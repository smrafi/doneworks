<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   25 August 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class TellMeMdControllerCases extends JController
{
    function display()
    {
        //get the case type
        $case_type = JRequest::getInt('case_type');
        
        //check weather user is logged in
        $user =& JFactory::getUser();
        if($user->guest)
        {
            $msg = 'Invalid Access.';
            $this->setRedirect(COMPONENT_FRONT_LINK.'?controller=patient&task=newcase');
        }
        
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $que_model = $this->getModel('question');
        $labcase_model = $this->getModel('labcase');
        
        if($case_type == CASE_TYPE_QUEANS)
            $pass = $que_model->checkQuestionCase();
        if($case_type == CASE_TYPE_LABTEST)
            $pass = $labcase_model->checkLabCase();
        
        if(!$pass)
        {
            $this->setRedirect(COMPONENT_FRONT_LINK.'?controller=patient&task=newcase');
        }
        
        $view = $this->getView('casesetting', 'html');
        $view->display();
    }
    
    function casecalc()
    {
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $case_model = $this->getModel('case');
        $price = $case_model->priceCalculation();
        echo $price;
    }
    
    function confirmation()
    {
        $case_type = JRequest::getInt('case_type');
        $case_num = JRequest::getVar('case_num', '');
        
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $case_model = $this->getModel('case');
        $que_model = $this->getModel('question');
        
        //validate the price entered is correct
        if(!$case_model->validatePrice())
        {
            $this->setRedirect(COMPONENT_FRONT_LINK.'?controller=cases&case_num='.$case_num.'&case_type='.$case_type);
            return;
        }
        
        //get hidden html data to process the paypal payment
        $html_data = $case_model->createPaypalHtml();
        
        //store these informations on payment table and get the id for it
        $case_model->storePaymentData();
        
        $view = $this->getView('confirmation', 'html');
        $view->assignRef('confirm_data', $case_model->_data);
        $view->assignRef('html_data', $html_data);
        $view->display();
    }
    
    function viewcase()
    {
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $view_type = JRequest::getVar('view_type');
        $cid = JRequest::getVar('cid');
        
        //if the user not logged in then we route the user to login page
        $user =& JFactory::getUser();
        if($user->guest)
        {
            $this->routeLogin('viewcase', $cid, $view_type);
            return;
        }
        
        $case_model = $this->getModel('case');
        
        if(!$case_model->validatePermitUser($view_type))
            $this->setRedirect ('index.php', 'Oops! You have entered a wrong url', 'error');
        
        $case_model->getUserCaseInfo($cid, $view_type);
        
        if($view_type == CASE_VIEW_TYPE_PATIENT)
        {
            $view = $this->getView('individualcase', 'html');
            $view->assignRef('case_data', $case_model->_data);
            $view->display();
            return;
        }
        elseif($view_type == CASE_VIEW_TYPE_DOCTOR)
        {
            $view = $this->getView('docviewcase', 'html');
            $view->assignRef('case_data', $case_model->_data);
            $view->display();
            return;
        }
        elseif($view_type == CASE_VIEW_TYPE_POOL)
        {
            $view = $this->getView('poolviewcase', 'html');
            $view->assignRef('case_data', $case_model->_data);
            $view->display();
            return;
        }
        else
            $this->setRedirect ('index.php', 'Oops! You have entered a wrong url', 'error');
    }
    
    function caseaction()
    {
        //patient post the message at here
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $case_model = $this->getModel('case');
        
        if($case_model->processPatientAnswer())
            $msg = 'Message has been posted';
        else
            $msg = 'Operation was failed!';
        
        $this->setRedirect(COMPONENT_FRONT_LINK.'?controller=patient', $msg);
        return;
    }
    
    function poolcaseaccept()
    {
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $case_model = $this->getModel('case');
        
        if(!$case_model->validatePermitUser($view_type))
            $this->setRedirect ('index.php', 'Oops! You have entered a wrong url', 'error');
        
        if($case_model->acceptCase())
        {
            $msg = "Case has been added in your list";
            $this->setRedirect(COMPONENT_FRONT_LINK.'?controller=doctor&task=casestable', $msg);
            return;
        }
        else
        {
            $msg = "You cannot accept this case.";
            $this->setRedirect(COMPONENT_FRONT_LINK.'?controller=doctor&task=casepool', $msg, 'notice');
            return;
        }
    }
    
    function casepost()
    {
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $case_model = $this->getModel('case');
        
        if($case_model->processAnswer())
        {
            $msg = "The message has been posted.";
            
        }
        else
            $msg = 'Task failed in process!';
        
        $this->setRedirect(COMPONENT_FRONT_LINK.'?controller=doctor&task=casestable', $msg);
        return;
            
    }
    
    function setanswer()
    {
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $case_model = $this->getModel('case');
        
        if($case_model->updateStatusAnswered())
            $msg = "Case has been saved";
        else
            $msg = "Task failed in process!";
        
        $this->setRedirect(COMPONENT_FRONT_LINK.'?controller=doctor&task=casestable', $msg);
        return;
    }
    
    function doctorselect()
    {
        $view = $this->getView('doctorselect', 'html');
        $view->display();
    }
    
    function routeLogin($task, $cid = '', $view_type = '')
    {
        $return_url = COMPONENT_FRONT_LINK.'?controller=cases&task='.$task;
        
        if($cid)
            $return_url .= '&cid='.$cid;
        if($view_type)
            $return_url .= '&view_type='.$view_type;
        
        $return_url = base64_encode($return_url);
        $login_link = JURI::root().'index.php/component/users/?view=login';
        
        $msg = 'Please login or register to continue';
        $this->setRedirect($login_link.'&return='.$return_url, $msg, 'notice');
        return;
    }
}
