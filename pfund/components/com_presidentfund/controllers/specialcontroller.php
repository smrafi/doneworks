<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   11 January 2012
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class PFundControllerSpecial extends JController
{
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
    }
    
    function presidentlist()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        //set the status to get the applications according to it
        JRequest::setVar('app_status', APPLICATION_STATUS_PRESIDENT_PENDING);
        
        $application_model = $this->getModel('application');
        $application_model->getList();
        $application_model->pagination();
        
        $view = $this->getView('presidentlist', 'html');
        $view->assignRef('application_list', $application_model->_data);
        $view->assignRef('pagination', $application_model->_pagination);
        $view->display();
    }
    
    function upprresponse()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        //set the status to get the applications according to it
        JRequest::setVar('app_status', APPLICATION_STATUS_PRESIDENT_APPROVAL_PENDING);
        
        $application_model = $this->getModel('application');
        $application_model->getList();
        $application_model->pagination();
        
        $view = $this->getView('prwaitlist', 'html');
        $view->assignRef('application_list', $application_model->_data);
        $view->assignRef('pagination', $application_model->_pagination);
        $view->display();
    }
    
    function uploadprfile()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $application_model = $this->getModel('application');
        if(!$application_model->uploadPresidentLetter())
        {
            $msg = 'Problem in uploading president reply.';
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=special&task=upprresponse',FALSE), $msg, 'error');
            return;
        }
        
        $msg = 'Operation was successful.';
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=special&task=upprresponse',FALSE), $msg);
        return;
    }
    
    function reimbursact()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $application_model = $this->getModel('application');
        $application_model->getList();
        $application_model->pagination();
        
        $view = $this->getView('reimbursactlist', 'html');
        $view->assignRef('application_list', $application_model->_data);
        $view->assignRef('pagination', $application_model->_pagination);
        $view->display();
    }
    
    function changeapptype()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $application_model = $this->getModel('application');
        if(!$app_id = $application_model->changeApplicationType())
            echo '0';
        
        echo $app_id;
    }
    
    function recommendationlist()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        //set the status to get the applications according to it
        JRequest::setVar('app_status', APPLICATION_STATUS_PENDING);
        
        //set the office type to make the list generated today
        JRequest::setVar('office_type', OFFICE_TYPE_HEALTH_MINISTRY);
        
        $application_model = $this->getModel('application');
        $application_model->getList();
        $application_model->pagination();
        
        $view = $this->getView('healthminlist', 'html');
        $view->assignRef('application_list', $application_model->_data);
        $view->assignRef('pagination', $application_model->_pagination);
        $view->display();
    }
    
    function savehealthmin()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        $template_id = JRequest::getInt('template_id');
        if(!$template_id)
        {
            $msg = 'No template has been selected.';
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=special&task=recommendationlist',FALSE), $msg, 'error');
            return;
        }
        if($cids[0] == 0)
        {
            $msg = 'No Application has been selected.';
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=special&task=recommendationlist',FALSE), $msg, 'error');
            return;
        }
        
        $application_model = $this->getModel('application');
        $manageapp_model = $this->getModel('manageapp');
        
        if(!$manageapp_model->noteHeathMinistryLetter())
        {
            $msg = 'A letter has been created already today!';
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=special&task=recommendationlist',FALSE), $msg, 'error');
            return;
        }
        
        $manageapp_model->updateHMStatus();
        $list_data = $manageapp_model->getAllHMLetters();
        $pagination = $manageapp_model->pagination();
        
        // we change the sataus for each application by runing a for loop ather e
        foreach($cids as $cid)
        {
            if($manageapp_model->checkAllStatusPending($cid))
                $application_model->changeApplicationStatus($cid, APPLICATION_STATUS_SUBJECT_CLEARK_PENDING);
            else
                $application_model->changeApplicationStatus($cid, APPLICATION_STATUS_PENDING);
        }
        
        $view = $this->getView('hmletterlist', 'html');
        $view->assignRef('list_data', $list_data);
        $view->assignRef('pagination', $pagination);
        $view->display();
    }
    
//    function saveprletter()
//    {
//        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
//        $this->addModelPath($path);
//        
//        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
//        $template_id = JRequest::getInt('template_id');
//        $letterfile_num = JRequest::getVar('letterfile_num');
//        if(!$template_id)
//        {
//            $msg = 'No template has been selected.';
//            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=special&task=presidentlist',FALSE), $msg, 'error');
//            return;
//        }
//        if(!$letterfile_num)
//        {
//            $msg = 'File number is not entered.';
//            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=special&task=presidentlist',FALSE), $msg, 'error');
//            return;
//        }
//        if($cids[0] == 0)
//        {
//            $msg = 'No Application has been selected.';
//            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=special&task=presidentlist',FALSE), $msg, 'error');
//            return;
//        }
//        
//        $manage_model = $this->getModel('manageapp');
//        $list_data = $manage_model->getAllPRLetters();
//        $pagination = $manage_model->pagination();
//        
//        $manage_model->notePrLetters();
//                
//        $view = $this->getView('prletterlist','html');
//        $view->assignRef('letter_list',$list_data);
//        $view->assignRef('pagination',$pagination);
//        $view->display();
//        
//        
//    }
    
    function hmletters()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $manageapp_model = $this->getModel('manageapp');
        
        $list_data = $manageapp_model->getAllHMLetters();
        $pagination = $manageapp_model->pagination();
        
        $view = $this->getView('hmletterlist', 'html');
        $view->assignRef('list_data', $list_data);
        $view->assignRef('pagination', $pagination);
        $view->display();
    }
    
    function viewletterlist()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $application_model = $this->getModel('application');
        $manageapp_model = $this->getModel('manageapp');
        $list_data = $manageapp_model->getIndividualDocuments();
        
        $view = $this->getView('hmdetaillist', 'html');
        $view->assignRef('list_data', $list_data);
        $view->display();
    }
    
    function viewprletters()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $manageapp_model = $this->getModel('manageapp');
        
        $list_data = $manageapp_model->getAllPRLetters();
        $pagination = $manageapp_model->pagination();
        
        $view = $this->getView('prletterlist', 'html');
        $view->assignRef('letter_list', $list_data);
        $view->assignRef('pagination', $pagination);
        $view->display();
    }
    
    function printhmletter()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $application_model = $this->getModel('application');
        $manageapp_model = $this->getModel('manageapp');
        $template_model = $this->getModel('template');
        
        $content_data = $application_model->prepareHMAppListData();
        $template_model->getOne($content_data->template_id);
        $content_data->letterfile_num = '';
        $letter_data->letter_content = $template_model->prepareTemplateLetter($template_model->_data->template_content, '', $content_data);
        $letter_data->letter_title = '';
        
        $view = $this->getView('letterframe', 'html');
        $view->assignRef('letter_data', $letter_data);
        $view->assignRef('drive_data', $drive_data);
        $view->display();
    }
    
    function tempselect()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $template_model = $this->getModel('template');
        $template_array = $template_model->getTemplateListArray('Select a template');
        
        $view = $this->getView('tempselect', 'html');
        $view->assignRef('template_array', $template_array);
        $view->display();
    }
    
    function printletter()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
        $template_id = JRequest::getInt('template_id');
        $letterfile_num = JRequest::getVar('letterfile_num');
//        if(!$template_id)
//        {
//            $msg = 'No template has been selected.';
//            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=special&task=presidentlist',FALSE), $msg, 'error');
//            return;
//        }
//        if(!$letterfile_num)
//        {
//            $msg = 'File number is not entered.';
//            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=special&task=presidentlist',FALSE), $msg, 'error');
//            return;
//        }
//        if($cids[0] == 0)
//        {
//            $msg = 'No Application has been selected.';
//            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=special&task=presidentlist',FALSE), $msg, 'error');
//            return;
//        }
        
        $template_model = $this->getModel('template');
        $application_model = $this->getModel('application');
        $letter_model = $this->getModel('letter');
        $manage_model = $this->getModel('manageapp');
        
        $template_array = $template_model->getTemplateListArray('Select a template');
        $application_table = $application_model->createApplicationListTable();
        $template_model->getOne($template_id);
        $manage_model->notePrLetters();
        $letter_data->application_table = $application_table;
        $letter_data->applist_table = '';
        $letter_data->letterfile_num = $letterfile_num;
        $letter_data->letter_content = $template_model->prepareTemplateLetter($template_model->_data->template_content, '', $letter_data);
        $letter_data->letter_title = $template_model->_data->template_name;
        
        //define drive data
        $drive_data->task = 'presidentlist';
        $drive_data->controller = 'special';
        
        $view = $this->getView('letterframe', 'html');
        $view->assignRef('letter_data', $letter_data);
        $view->assignRef('drive_data', $drive_data);
        $view->display();
    }
    
    function hmlistback()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=special&task=hmletters',FALSE));
        return;
    }
    
    function backop()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=application',FALSE));
        return;
    }
}
