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

class PFundControllerHealthMin extends JController
{
    function display()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('manageapp');
        
        $view = $this->getView('healthminresponse', 'html');
        $view->display();
    }
    
    function recommend()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $app_id = JRequest::getInt('app_id');
        $pnum = JRequest::getint('pnum');
        $app_type = JRequest::getInt('app_type');
        
        $model = $this->getModel('manageapp');
        $application_model = $this->getModel('application');
        
        if(!$model->uploadHMResponse(COMMON_STATUS_RECOMMEND))
        {
            $msg = "There is a problem in processing your recommendation.";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$app_id.'&pnum='.$pnum.'&app_type='.$app_type,FALSE), $msg, 'error');
            return;
        }
        
        if($model->checkAllStatusDone($app_id))
            $application_model->changeApplicationStatus($app_id, APPLICATION_STATUS_SAS_PENDING);
        else
            $application_model->changeApplicationStatus($app_id, APPLICATION_STATUS_SUBJECT_CLEARK_PENDING);
        
        $msg = "Application successfully recommended.";
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$app_id.'&pnum='.$pnum,FALSE), $msg);
    }
    
    function reject()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $app_id = JRequest::getInt('app_id');
        $pnum = JRequest::getint('pnum');
        $app_type = JRequest::getInt('app_type');
        
        $model = $this->getModel('manageapp');
        $application_model = $this->getModel('application');
        
        if(!$model->uploadHMResponse(COMMON_STATUS_NOTPROCESSED))
        {
            $msg = "There is a problem in processing your rejection.";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$app_id.'&pnum='.$pnum.'&app_type='.$app_type,FALSE), $msg, 'error');
            return;
        }
        
        if($model->checkAllStatusDone($app_id))
            $application_model->changeApplicationStatus($app_id, APPLICATION_STATUS_SAS_PENDING);
        else
            $application_model->changeApplicationStatus($app_id, APPLICATION_STATUS_SUBJECT_CLEARK_PENDING);
        
        $msg = "Application successfully rejected.";
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$app_id.'&pnum='.$pnum,FALSE), $msg);
    }
    
    function backop()
    {
        $pnum = JRequest::getint('pnum');
        $app_id = JRequest::getint('app_id');
        $app_type = JRequest::getInt('app_type');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$app_id.'&pnum='.$pnum.'&app_type='.$app_type,FALSE));
    }
}
