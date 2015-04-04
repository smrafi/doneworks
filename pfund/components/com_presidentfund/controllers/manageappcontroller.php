<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   28 December 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class PFundControllerManageApp extends JController
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
        
        $view = $this->getView('manageapplink', 'html');
        $view->display();
    }
    
    function app_action()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $app_id = JRequest::getInt('app_id');
        
        $model = $this->getModel('manageapp');
        $cat_model = $this->getModel('category');
        $disease_model = $this->getModel('disease');
        
        if(!$app_id or !($model->getManageAppData($app_id)))
            $this->setRedirect (JRoute::_(COMPONENT_LINK.'&controller=application'), 'Couldn\'t reach the link you were trying.', 'error');
        
        $cat_array = $cat_model->getCatArray('Select a category');
        $disease_array = $disease_model->getDiseaseList('Select a medical condition', $model->_data->cat_id);
        $application_notes = $model->getApplicationNotes($app_id);
        
        $view = $this->getView('appaction', 'html');
        $view->assignRef('manage_data', $model->_data);
        $view->assignRef('cat_array', $cat_array);
        $view->assignRef('disease_array', $disease_array);
        $view->assignRef('application_notes', $application_notes);
        $view->display();
    }
    
    function save()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $task = JRequest::getVar('task');
        $pnum = JRequest::getint('pnum');
        $app_type = JRequest::getInt('app_type');
        
        $model = $this->getModel('manageapp');
        $cat_model = $this->getModel('category');
        $disease_model = $this->getModel('disease');
        
        $stored = $model->store();
        $cat_array = $cat_model->getCatArray('Select a category');
        $disease_array = $disease_model->getDiseaseList('Select a medical condition', $model->_data->cat_id);
        $application_notes = $model->getApplicationNotes($model->_data->application_id);
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('Details has been updated');
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$model->_data->application_id.'&pnum='.$pnum.'&app_type='.$app_type, FALSE), $msg);
            return;
        }
        
        $view = $this->getView('appaction', 'html');
        $view->assignRef('manage_data', $model->_data);
        $view->assignRef('cat_array', $cat_array);
        $view->assignRef('disease_array', $disease_array);
        $view->assignRef('application_notes', $application_notes);
        $view->display();
    }
    
    function getdisease()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $cat_id = JRequest::getInt('cat_id');
        $disease_model = $this->getModel('disease');
        
        $disease_array = $disease_model->getDiseaseList('Select a medical condition', $cat_id);
        echo PFundHelper::createList('disease_id', 0, $disease_array);
    }
    
    function getamount()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $cat_model = $this->getModel('category');
        $disease_model = $this->getModel('disease');
        
        $disease_id = JRequest::getInt('disease_id');
        $amount_type = JRequest::getVar('amount_type');
        
        if($disease_id)
            $disease_model->getOne($disease_id);
        
        echo $disease_model->_data->$amount_type;
    }
    
    function dsresponse()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('manageapp');
        
        $view = $this->getView('dsresponse', 'html');
        $view->display();
    }
    
    function recommend()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $app_id = JRequest::getInt('app_id');
        $pnum = JRequest::getint('pnum');
        $app_type = JRequest::getint('app_type');
        
        $model = $this->getModel('manageapp');
        $application_model = $this->getModel('application');
        
        if(!$model->uploadDSResponse(COMMON_STATUS_RECOMMEND,$app_type))
        {
            $msg = "There is a problem in processing your recommendation.";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$app_id.'&pnum='.$pnum.'&app_type='.$app_type,FALSE), $msg, 'error');
            return;
        }
        
        if($model->checkAllStatusDone($app_id)&& $app_type == APPLICATION_TYPE_NORMAL)
        {
            $application_model->changeApplicationStatus($app_id, APPLICATION_STATUS_SAS_PENDING);
        }
        elseif($model->checkAllStatusDone($app_id)&& $app_type == APPLICATION_TYPE_REIMBURSMENT)
        {
            $application_model->changeApplicationStatus($app_id, APPLICATION_STATUS_ACCOUNT_HEAD_PENDING);
        }
        else
            $application_model->changeApplicationStatus($app_id, APPLICATION_STATUS_SUBJECT_CLEARK_PENDING);
        
        $msg = "Application successfully recommended.";
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$app_id.'&pnum='.$pnum.'&app_type='.$app_type,FALSE), $msg);
    }
    
    function reject()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $app_id = JRequest::getInt('app_id');
        $pnum = JRequest::getint('pnum');
        
        $model = $this->getModel('manageapp');
        $application_model = $this->getModel('application');
        
        if(!$model->uploadDSResponse(COMMON_STATUS_NOTPROCESSED))
        {
            $msg = "There is a problem in processing your rejection.";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$app_id.'&pnum='.$pnum,FALSE), $msg, 'error');
            return;
        }
        
        if($model->checkAllStatusDone($app_id))
            $application_model->changeApplicationStatus($app_id, APPLICATION_STATUS_SAS_PENDING);
        else
            $application_model->changeApplicationStatus($app_id, APPLICATION_STATUS_SUBJECT_CLEARK_PENDING);
        
        $msg = "Application successfully rejected.";
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$app_id,FALSE), $msg);
    }
    
    function printrecpt()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $app_id = JRequest::getint('application_id');
        
        $app_model = $this->getmodel('application');
        
        $app_model->getfirstreciptdata($app_id);
        
        $view = $this->getView('printreceipt','html');
        $view->assignRef('receipt_data',$app_model->_data);
        $view->display();
    }
    
    function backop()
    {
        $pnum = JRequest::getint('pnum');
        $app_type = JRequest::getInt('app_type');
        $app_id = JRequest::getint('app_id');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$app_id.'&pnum='.$pnum.'&app_type='.$app_type,FALSE));
    }
}
