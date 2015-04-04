<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   15 January 2012
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class PFundControllerAsstSec extends JController
{
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
    }
    
    function display()
    {
        $link_data->controller = 'asstsec';
        $link_data->apptask = 'appreview';
        $link_data->lettertask = 'letterreview';
        
        $view = $this->getView('asstseclinks', 'html');
        $view->assignRef('link_data', $link_data);
        $view->display();
    }
    
    function appreview()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        //set the status to get the applications according to it
        JRequest::setVar('app_status', APPLICATION_STATUS_SAS_PENDING);
        
        $model = $this->getModel('application');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('asstseclist', 'html');
        $view->assignRef('application_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    function letterreview()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        //set the letter status search value to 1
        //if we set 1, it means we are searching for the letter that are being waiting for the approval
        JRequest::setVar('letter_status', 1);
        
        $model = $this->getModel('letter');
        $model->getApprovalList();
        $model->pagination();
        
        $link_data->controller = 'asstsec';
        
        $view = $this->getView('approveletterlist', 'html');
        $view->assignRef('link_data', $link_data);
        $view->assignRef('letter_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    function viewapp()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $cid = JRequest::getVar('cid');
        
        $model = $this->getModel('application');
        $hospital_model = $this->getModel('hospital');
        
        $model->getOneForSAS($cid);
        $hospitals = $hospital_model->getHospitalListArray('Select a hospital');
        
        $view = $this->getView('asstsecview', 'html');
        $view->assignRef('application_data', $model->_data);
        $view->assignRef('hospitals', $hospitals);
        $view->display();
    }
    
    function recommend()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $application_id = JRequest::getInt('application_id');
        
        $model = $this->getModel('application');
        if(!$model->recordSASRecommend() || !$model->changeApplicationStatus($application_id, APPLICATION_STATUS_SECRETORY_PENDING))
        {
            $msg = "There is a problem in processing your recommendation.";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=asstsec',FALSE), $msg, 'error');
            return;
        }
        
        $msg = "Application successfully recommended.";
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=asstsec',FALSE), $msg);
    }
    
    function amend()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $application_id = JRequest::getInt('application_id');
        
        $model = $this->getModel('application');
        if(!$model->changeApplicationStatus($application_id, APPLICATION_STATUS_SUBJECT_CLEARK_PENDING))
        {
            $msg = "There is a problem in processing your request.";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=asstsec',FALSE), $msg, 'error');
            return;
        }
        
        $model->addApplicationNote($application_id, 'SAS', 'amended');
        
        $msg = "Application successfully amended.";
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=asstsec',FALSE), $msg);
    }
    
    function reject()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $application_id = JRequest::getInt('application_id');
        
        $model = $this->getModel('application');
        if(!$model->changeApplicationStatus($application_id, APPLICATION_STATUS_CANCELED))
        {
            $msg = "There is a problem in processing your request.";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=asstsec',FALSE), $msg, 'error');
            return;
        }
        
        $model->addApplicationNote($application_id, 'SAS', 'rejected');
        
        $msg = "Application successfully rejected.";
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=asstsec',FALSE), $msg);
    }
    
    function backop()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=asstsec',FALSE));
        return;
    }
    
    function linkback()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=application',FALSE));
        return;
    }
    
    function backappreview()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=asstsec&task=appreview',FALSE));
        return;
    }
    
    function backletterreview()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=asstsec&task=letterreview',FALSE));
        return;
    }
    
    function appview()
    {
        $application_id = JRequest::getInt('application_id');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$application_id,FALSE));
        return;
    }
}