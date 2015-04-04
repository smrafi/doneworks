<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   21 December 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class PFundControllerApplication extends JController
{
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
    }
    
    function display()
    {
        $view = $this->getView('applicationlinks', 'html');
        $view->display();
    }
    
    function applist()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('application');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('applicationlist', 'html');
        $view->assignRef('application_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    function addnew()
    {
        $view = $this->getView('appchoice', 'html');
        $view->display();
    }
    
    function appnic()
    {
        $view = $this->getView('nicform', 'html');
        $view->display();
    }
    
    function processnic()
    {
        //get the NIC number and check weather application is exist
        $nic_num = JRequest::getVar('nic_num');
        $app_type = JRequest::getint('app_type');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('application');
        
        //first check exist record
        if(!$model->getExistByNIC($nic_num))
            $this->setRedirect (JRoute::_(COMPONENT_LINK.'&controller=application&task=applist&nic_num='.$nic_num,FALSE));
        else
        {
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=application&task=addapplication&nic_num='.$nic_num.'&app_type='.$app_type,FALSE));
        }
    }
    
    
    function addapplication()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('application');
        $dsoffice_model = $this->getModel('dsoffice');
        $hospital_model = $this->getModel('hospital');
        
        $model->initData();
        $model->generateApplicationNumber();
        $dsoffices = $dsoffice_model->dsOfficeListArray('Select');
        $hospitals = $hospital_model->getHospitalListArray('Select a hospital');
        $income_data = array();
        $other_source = array();
        
        $view = $this->getView('appmain', 'html');
        $view->assignRef('application_data', $model->_data);
        $view->assignRef('dsoffices', $dsoffices);
        $view->assignRef('hospitals', $hospitals);
        $view->assignRef('income_data', $income_data);
        $view->assignRef('other_source', $other_source);
        $view->display();
    }
    
    function newexistapp()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('application');
        $dsoffice_model = $this->getModel('dsoffice');
        $hospital_model = $this->getModel('hospital');
        
        $model->initData();
        $model->syncExistData();
        $dsoffices = $dsoffice_model->dsOfficeListArray('Select');
        $hospitals = $hospital_model->getHospitalListArray('Select a hospital');
        $income_data = array();
        $other_source = array();
        
        $view = $this->getView('application', 'html');
        $view->assignRef('application_data', $model->_data);
        $view->assignRef('dsoffices', $dsoffices);
        $view->assignRef('hospitals', $hospitals);
        $view->assignRef('income_data', $income_data);
        $view->assignRef('other_source', $other_source);
        $view->display();
    }
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $cid = JRequest::getInt('cid');
        
        $model = $this->getModel('application');
        $dsoffice_model = $this->getModel('dsoffice');
        $hospital_model = $this->getModel('hospital');
        
        $model->getOne($cid);
        $dsoffices = $dsoffice_model->dsOfficeListArray('Select');
        $hospitals = $hospital_model->getHospitalListArray('Select a hospital');
        $income_data = $model->getIncomeData($cid);
        $other_source = $model->getOtherSourceData($cid);
        
        $view = $this->getView('application', 'html');
        $view->assignRef('application_data', $model->_data);
        $view->assignRef('dsoffices', $dsoffices);
        $view->assignRef('hospitals', $hospitals);
        $view->assignRef('income_data', $income_data);
        $view->assignRef('other_source', $other_source);
        $view->display();
    }
    
    function save()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $task = JRequest::getVar('task');
        
        $model = $this->getModel('application');
        $dsoffice_model = $this->getModel('dsoffice');
        $hospital_model = $this->getModel('hospital');
        
        $stored = $model->store();
        $dsoffices = $dsoffice_model->dsOfficeListArray('Select');
        $hospitals = $hospital_model->getHospitalListArray('Select a hospital');
        
        if($stored and $model->_data->type)
            $model->insertManageData();
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('Application has been saved');
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=application',FALSE), $msg);
            return;
        }
        
        //on this instance if the edit is going then we need to get the income data from the table
        $income_data = $model->getIncomeData($model->_data->id);
        //get other source data
        $other_source = $model->getOtherSourceData($model->_data->id);
        
        $view = $this->getView('application', 'html');
        $view->assignRef('application_data', $model->_data);
        $view->assignRef('dsoffices', $dsoffices);
        $view->assignRef('income_data', $income_data);
        $view->assignRef('hospitals', $hospitals);
        $view->assignRef('other_source', $other_source);
        $view->display();
    }
    
    function savefirst()
    {
        $vars = JRequest::get();
        print_r($vars);
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $task = JRequest::getVar('task');
        
        $model = $this->getModel('application');
        $dsoffice_model = $this->getModel('dsoffice');
        $hospital_model = $this->getModel('hospital');
        
        $stored = $model->storefirst();
        $dsoffices = $dsoffice_model->dsOfficeListArray('Select');
        $hospitals = $hospital_model->getHospitalListArray('Select a hospital');
        
        if($stored and $model->_data->type)
            $model->insertManageData();
        
        if($stored)
        {
            $msg = JText::_('Application has been saved');
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=manageapp&app_id='.$model->_data->id.'&pnum='.$model->_data->patient_num.'&app_type='.$model->_data->application_type,FALSE), $msg);
            return;
        }
        
        $view = $this->getView('appmain', 'html');
        $view->assignRef('application_data', $model->_data);
        $view->assignRef('dsoffices', $dsoffices);
        $view->assignRef('income_data', $income_data);
        $view->assignRef('hospitals', $hospitals);
        $view->assignRef('other_source', $other_source);
        $view->display();
    }
    
    function getdsoffice()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $district_id = JRequest::getVar('district_id');
        $dsoffice_model = $this->getModel('dsoffice');
        
        $dsoffices = $dsoffice_model->dsOfficeListArray('Select', $district_id);
        echo PFundHelper::createList('patient_dsoffice', 0, $dsoffices);
        return;
    }
    
    function gethospitaladdress()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $hospital_id = JRequest::getVar('hospital_id');
        $hospital_model = $this->getModel('hospital');
        
        $address = $hospital_model->getHospitalAddress($hospital_id);
        echo $address;
        return;
    }
    
    function getrecords()
    {
        $nic_num = JRequest::getVar('nic_num');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('application');
        $model->getExistByNIC($nic_num, $result);
        $total = count($result);
        echo $total;
    }
    
    function interback()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=application&task=addnew',FALSE));
        return;
    }
    
    function linkback()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=application',FALSE));
        return;
    }
    
    function backop()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=application&task=applist',FALSE));
        return;
    }
    
    function cancel()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=application&task=applist',FALSE));
        return;
    }
    
    function remove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('application');
        if($model->delete())
            $msg = JText::_('application has been deleted');
        
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=application&task=applist',FALSE), $msg);
    }
}
