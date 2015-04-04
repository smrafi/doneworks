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


class PFundControllerPRSec extends JController
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
        
        //set the status to get the applications according to it
        JRequest::setVar('app_status', APPLICATION_STATUS_SECRETORY_PENDING);
        
        $model = $this->getModel('application');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('prseclist', 'html');
        $view->assignRef('application_list', $model->_data);
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
        $sas_data = $model->getSASRecord($cid);
        
        //Dev Rafi
        //check the applicaton type and change the data flow
        if($model->_data->application_type == APPLICATION_TYPE_REIMBURSMENT)
            $sas_data = $model->getAccountRecord($cid);
        
        $view = $this->getView('prsecview', 'html');
        $view->assignRef('application_data', $model->_data);
        $view->assignRef('hospitals', $hospitals);
        $view->assignRef('sas_data', $sas_data);
        $view->display();
    }
    
    function recommend()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $application_id = JRequest::getInt('application_id');
        
        $model = $this->getModel('application');
        if(!$model->recordPRSecRecommend() || !$model->changeApplicationStatus($application_id, APPLICATION_STATUS_PRESIDENT_PENDING))
        {
            $msg = "There is a problem in processing your recommendation.";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=prsec',FALSE), $msg, 'error');
            return;
        }
        
        $msg = "Application successfully recommended.";
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=prsec',FALSE), $msg);
    }
    
    function amend()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $application_id = JRequest::getInt('application_id');
        
        $model = $this->getModel('application');
        if(!$model->changeApplicationStatus($application_id, APPLICATION_STATUS_SAS_PENDING))
        {
            $msg = "There is a problem in processing your request.";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=prsec',FALSE), $msg, 'error');
            return;
        }
        
        $model->addApplicationNote($application_id, 'Secretary of President Fund', 'amended');
        
        $msg = "Application successfully amended.";
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=prsec',FALSE), $msg);
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
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=prsec',FALSE), $msg, 'error');
            return;
        }
        
        $model->addApplicationNote($application_id, 'Secretary of President Fund', 'rejected');
        
        $msg = "Application successfully rejected.";
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=prsec',FALSE), $msg);
    }
    
    function backop()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=prsec',FALSE));
        return;
    }
    
    function linkback()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=application',FALSE));
        return;
    }
}
