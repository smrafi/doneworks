<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   07 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class PFundControllerAccount extends JController
{
    
    
    function display()
    {
      
        $view = $this->getView('account', 'html');
        $view->display();
    }
    
    function accountsettings()
    {
          $view = $this->getView('accountsetting', 'html');
          $view->display();
    }
    
    //Dev Rafi
    //Following all functions are created by Dev Rafi
    function accountapps()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        //set the status to get the applications according to it
        JRequest::setVar('app_status', APPLICATION_STATUS_ACCOUNT_HEAD_PENDING);
        
        $model = $this->getModel('application');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('accountheadlist', 'html');
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
        
        $view = $this->getView('accountheadview', 'html');
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
        if(!$model->recordAccountRecommend() || !$model->changeApplicationStatus($application_id, APPLICATION_STATUS_SECRETORY_PENDING))
        {
            $msg = "There is a problem in processing your recommendation.";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=account&task=accountapps',FALSE), $msg, 'error');
            return;
        }
        
        $msg = "Application successfully recommended.";
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=account&task=accountapps',FALSE), $msg);
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
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=account&task=accountapps',FALSE), $msg, 'error');
            return;
        }
        
        $msg = "Application successfully amended.";
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=account&task=accountapps',FALSE), $msg);
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
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=account&task=accountapps',FALSE), $msg, 'error');
            return;
        }
        
        $msg = "Application successfully rejected.";
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=account&task=accountapps',FALSE), $msg);
    }
    
    function linkback()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=application',FALSE));
        return;
    }
    
    function backop()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=account&task=accountapps',FALSE));
        return;
    }
    
}