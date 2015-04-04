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

class PFundControllerManageApp extends JController
{
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
       
    }
    
    function display()
    {
                
        $view = $this->getView('manageapplink', 'html');
        $view->display();
    }
    
    function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=application');
        return;
    }
    
    function app_action()
    {
               
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
        $task = JRequest::getVar('task');
        
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
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$model->_data->application_id,FALSE), $msg);
            return;
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('appaction', 'html');
        $view->assignRef('manage_data', $model->_data);
        $view->assignRef('cat_array', $cat_array);
        $view->assignRef('disease_array', $disease_array);
        $view->assignRef('application_notes', $application_notes);
        $view->display();
    }
    
    function getdisease()
    {
        
        $cat_id = JRequest::getInt('cat_id');
        $disease_model = $this->getModel('disease');
        
        $disease_array = $disease_model->getDiseaseList('Select a medical condition', $cat_id);
        echo PFundHelper::createList('disease_id', 0, $disease_array);
    }
    
    function getamount()
    {
        
        $cat_model = $this->getModel('category');
        $disease_model = $this->getModel('disease');
        
        $disease_id = JRequest::getInt('disease_id');
        $amount_type = JRequest::getVar('amount_type');
        
        if($disease_id)
            $disease_model->getOne($disease_id);
        
        echo $disease_model->_data->$amount_type;
    }
    
    
}
