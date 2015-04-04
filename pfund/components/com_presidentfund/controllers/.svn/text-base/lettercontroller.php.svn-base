<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   30 December 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');


class PFundControllerLetter extends JController
{
    function display()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('letter');
        
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('letterlist', 'html');
        $view->assignRef('letter_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    
    
    function addnew()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('letter');
        $template_model = $this->getModel('template');
        
        $model->initData();
        $template_array = $template_model->getTemplateListArray('Select a template');
        
        $view = $this->getView('letter', 'html');
        $view->assignRef('letter_data', $model->_data);
        $view->assignRef('template_array', $template_array);
        $view->display();
    }
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $cid = JRequest::getInt('cid');
        
        $model = $this->getModel('letter');
        $template_model = $this->getModel('template');
        
        $model->getOne($cid);
        $template_array = $template_model->getTemplateListArray('Select a template');
        
        $view = $this->getView('letter', 'html');
        $view->assignRef('letter_data', $model->_data);
        $view->assignRef('template_array', $template_array);
        $view->display();
    }
    
    function save()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $app_type = JRequest::getInt('app_type');
        
        $model = $this->getModel('letter');
        $template_model = $this->getModel('template');
        $manageapp_model = $this->getModel('manageapp');
        $application_model = $this->getModel('application');
        
        $stored = $model->store();
        $template_array = $template_model->getTemplateListArray('Select a template');
        
        if($stored)
        {
            $model->updateManageTable($model->_data->application_id, $model->_data->office_type);
            $model->addApplicationNote();
            $model->addDetailApplicationNote();
            if($manageapp_model->checkAllStatusPending($model->_data->application_id,$app_type))
                $application_model->changeApplicationStatus($model->_data->application_id, APPLICATION_STATUS_SUBJECT_CLEARK_PENDING);
            elseif($app_type == APPLICATION_TYPE_REIMBURSMENT)
                $application_model->changeApplicationStatus($model->_data->application_id, APPLICATION_STATUS_SUBJECT_CLEARK_PENDING);
        }
        else{
            $application_model->changeApplicationStatus($model->_data->application_id, APPLICATION_STATUS_PENDING);
        }
        
        $view = $this->getView('letter', 'html');
        $view->assignRef('letter_data', $model->_data);
        $view->assignRef('template_array', $template_array);
        $view->display();
    }
    
    function getletter()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('letter');
        $template_model = $this->getModel('template');
        
        $model->getPostData();
        $template_model->getOne($model->_data->template_id);
        $template_array = $template_model->getTemplateListArray('Select a template');
        $letter_data = $model->getLetterData($model->_data->application_id);
        
        //embed the approved user
        if(!$model->_data->approved)
            $letter_data->imgtag = 0;
        
        $model->_data->letter_content = $template_model->prepareTemplateLetter($template_model->_data->template_content, $letter_data);
        
        $view = $this->getView('letter', 'html');
        $view->assignRef('letter_data', $model->_data);
        $view->assignRef('template_array', $template_array);
        $view->display();
    }
    
    function letterapprove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('letter');
        $template_model = $this->getModel('template');
        $application_model = $this->getModel('application');
        
        $letter_id = JRequest::getInt('cid');
        
        $model->getOne($letter_id);
        $office_array = PFundHelper::getOfficeType('Select');
        $application_data = $application_model->getOne($model->_data->application_id);
        
        $view = $this->getView('letterapproval', 'html');
        $view->assignRef('letter_data', $model->_data);
        $view->display();
    }
    
    function digitalsign()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $letter_id = JRequest::getInt('letter_id');
        $rt_controller = JRequest::getVar('rtcontroller');
        
        $model = $this->getModel('letter');
        $template_model = $this->getModel('template');
        
        $letter_data = $model->getOne($letter_id);
        $template_data = $template_model->getOne($letter_data->template_id);
        $letter_data = $model->getLetterData($letter_data->application_id);
        
        if($rt_controller == 'asstsec')
            $letter_data->imgtag = 'sas';
        if($rt_controller == 'prsec')
            $letter_data->imgtag = 'prsec';
        if($rt_controller == 'account')
            $letter_data->imgtag = 'account';
        
        $letter_data->letter_content = $template_model->prepareTemplateLetter($template_data->template_content, $letter_data);
        
        //finally update the letter table
        if($model->updateApprovedLetter($letter_id, $letter_data->letter_content))
        {
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=asstsec&task=letterreview',FALSE));
            return;
        }
    }
    
    function printletter()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('letter');
        $template_model = $this->getModel('template');
        $application_model = $this->getModel('application');
        
        $letter_id = JRequest::getInt('letter_id');
        
        $model->getOne($letter_id);
        $office_array = PFundHelper::getOfficeType('Select');
        $application_data = $application_model->getOne($model->_data->application_id);
        $model->_data->letter_title = 'PF/M/T/'.$application_data->patient_num.' Letter to '.$office_array[$model->_data->office_type];
        
        $view = $this->getView('letterframe', 'html');
        $view->assignRef('letter_data', $model->_data);
        $view->assignRef('drive_data', $drive_data);
        $view->display();
    }
    
    function remove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $application_id = JRequest::getInt('application_id');
        $pnum = JRequest::getint('pnum');
        $app_type = JRequest::getInt('app_type');

        $model = $this->getModel('letter');
        if($model->delete())
            $msg = JText::_('letter has been deleted');
        
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=letter&application_id='.$application_id.'&pnum='.$pnum.'&app_type='.$app_type,FALSE), $msg);
    }
    
    function backop()
    {
        $application_id = JRequest::getInt('application_id');
        $pnum = JRequest::getint('pnum');
        $app_type = JRequest::getInt('app_type');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$application_id.'&pnum='.$pnum.'&app_type='.$app_type, FALSE));
    }
}
