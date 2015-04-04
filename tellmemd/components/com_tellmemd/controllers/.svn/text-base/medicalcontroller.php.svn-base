<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   17 August 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class TellMeMdControllerMedical extends JController
{
    function display()
    {
        $user =& JFactory::getUser();
        if($user->guest)
        {
            $this->redirectLogin();
            return;
        }
        
        $view = $this->getView('entermedical', 'html');
        $view->display();
    }
    
    function entermedical()
    {
        $report_select = JRequest::getInt('report_select');
        
        if($report_select == PATIENT_MEDICAL_INFO_LATER)
        {
            $this->setRedirect (JURI::root ());
            return;
        }
        if($report_select == PATIENT_MEDICAL_INFO_NOW)
        {
            $this->setRedirect (COMPONENT_FRONT_LINK.'?controller=medical&task=pastsocial');
            return;
        }
        
        $app =& JFactory::getApplication();
        $app->enqueueMessage('Please select an option', 'error');
        
        $view = $this->getView('entermedical', 'html');
        $view->display();
    }
    
    function pastsocial()
    {  
        $user =& JFactory::getUser();
        if($user->guest)
        {
            $this->redirectLogin();
            return;
        }     
        
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('socialhistory');
        $model->initData();
        
        $view = $this->getView('pastsocial', 'html');
        $view->assignRef('social_data', $model->_data);
        $view->display();
    }
    
    function medication()
    {
        $user =& JFactory::getUser();
        if($user->guest)
        {
            $this->redirectLogin();
            return;
        }
        
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('socialhistory');
        $medication_model = $this->getModel('medicationhistory');
        
        $stored = $model->store();
        $medi_initdata = $medication_model->initData();
        
        if(!$stored)
        {
            $view = $this->getView('medicationform', 'html');
            $view->assignRef('medi_data', $medi_initdata);
            $view->display();
            return;
        }
        
        $view = $this->getView('pastsocial', 'html');
        $view->assignRef('social_data', $model->_data);
        $view->display();
    }
    
    function addMedication()
    {
        $user =& JFactory::getUser();
        if($user->guest)
        {
            $this->redirectLogin();
            return;
        }
        
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $medication_model = $this->getModel('medicationhistory');
        $stored = $medication_model->store();
        $summary_data = $medication_model->getAllMedication();
        
        $view = $this->getView('medicationform', 'html');
        
        if(!$stored)
            $view->assignRef('medi_data', $medication_model->_data);
        
        $view->assignRef('summary_data', $summary_data);
        $view->display();
    }
    
    function allergyform()
    {
        $user =& JFactory::getUser();
        if($user->guest)
        {
            $this->redirectLogin();
            return;
        }
        
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $medication_model = $this->getModel('medicationhistory');
        $idstored = $medication_model->storeIDs();
        
        $view = $this->getView('allergyform', 'html');
        $view->display();
    }
    
    function addalergy()
    {
        $user =& JFactory::getUser();
        if($user->guest)
        {
            $this->redirectLogin();
            return;
        }
        
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $allergy_model = $this->getModel('allergyhistory');
        $stored = $allergy_model->store();
        $all_allergy = $allergy_model->getAllAllergy();
        
        $view = $this->getView('allergyform', 'html');
        $view->assignRef('summary_data', $all_allergy);
        $view->display();
    }
    
    function pastmedical()
    {
        $user =& JFactory::getUser();
        if($user->guest)
        {
            $this->redirectLogin();
            return;
        }
        
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $allergy_model = $this->getModel('allergyhistory');
        $condition_model = $this->getModel('condition');
        $cat_model = $this->getModel('category');
        
        $idstored = $allergy_model->storeIDs();
        //get list of categories
        $cat_list = $cat_model->getCatArrayList();
        
        $view = $this->getView('pastmedical', 'html');
        $view->assignRef('cat_list', $cat_list);
        $view->display();
    }
    
    function conditions()
    {
        $cat_id = JRequest::getInt('cat_id');
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $condition_model = $this->getModel('condition');
        $condition_list = $condition_model->getByCatID($cat_id);
        
        $view = $this->getView('conditiontable', 'html');
        $view->assignRef('condition_list', $condition_list);
        $view->display();
    }
    
    function pastsurgical()
    {
        $user =& JFactory::getUser();
        if($user->guest)
        {
            $this->redirectLogin();
            return;
        }
        
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $condition_model = $this->getModel('condition');
        $surgical_model = $this->getModel('surgery');
        $cat_model = $this->getModel('category');
        
        $idstored = $condition_model->storePastMedical();
        $cat_list = $cat_model->getCatArrayList();
        
        $view = $this->getView('pastsurgical', 'html');
        $view->assignRef('cat_list', $cat_list);
        $view->display();
    }
    
    function surgeries()
    {
        $cat_id = JRequest::getInt('cat_id');
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $surgical_model = $this->getModel('surgery');
        $surgery_list = $surgical_model->getByCatID($cat_id);
        
        $view = $this->getView('surgerytable', 'html');
        $view->assignRef('surgery_list', $surgery_list);
        $view->display();
    }
    
    function finalstep()
    {
        $user =& JFactory::getUser();
        if($user->guest)
        {
            $this->redirectLogin();
            return;
        }
        
        //add the model path
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $surgical_model = $this->getModel('surgery');
        
        $idstored = $surgical_model->storePastSugery();
        print_r('Thank you. All the information have been saved successfully.');
    }
    
    function redirectLogin()
    {
        $return_url = COMPONENT_FRONT_LINK.'?controller=medical';
        $return_url = base64_encode($return_url);
        $login_link = JURI::root().'index.php/component/users/?view=login';
        
        $msg = 'Please login to continue';
        $this->setRedirect($login_link.'&return='.$return_url, $msg, 'notice');
        return;
    }
}