<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   08 December 2011
 * ***************************************************************************** */


defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class PFundControllerApplication extends JController
{
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
    }
    
    function display()
    {
        $model = $this->getModel('application');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('applicationlist', 'html');
        $view->assignRef('application_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    function add()
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
        
        $model = $this->getModel('application');
        
        //first check exist record
        if(!$model->getExistByNIC($nic_num))
            $this->setRedirect (JRoute::_(COMPONENT_LINK.'&controller=application&nic_num='.$nic_num,FALSE));
        else
        {
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=application&task=addapplication&nic_num='.$nic_num,FALSE));
        }
    }
    
    function addapplication()
    {
        JRequest::setVar('hidemainmenu', 1);
        
        $model = $this->getModel('application');
        $dsoffice_model = $this->getModel('dsoffice');
        $hospital_model = $this->getModel('hospital');
        
        $model->initData();
        $model->generateApplicationNumber();
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
    
    function newexistapp()
    {
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
           
        $model = $this->getModel('application');
        $dsoffice_model = $this->getModel('dsoffice');
        $hospital_model = $this->getModel('hospital');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
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
            $this->setRedirect(COMPONENT_LINK.'&controller=application', $msg);
            return;
        }
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
            $this->setRedirect(COMPONENT_LINK.'&controller=application&task=add', $msg);
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
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
    
    
    
    function getdsoffice()
    {
        $district_id = JRequest::getVar('district_id');
        $dsoffice_model = $this->getModel('dsoffice');
        
        $dsoffices = $dsoffice_model->dsOfficeListArray('Select', $district_id);
        echo PFundHelper::createList('patient_dsoffice', 0, $dsoffices);
        return;
    }
    
    function gethospitaladdress()
    {
        $hospital_id = JRequest::getVar('hospital_id');
        $hospital_model = $this->getModel('hospital');
        
        $address = $hospital_model->getHospitalAddress($hospital_id);
        echo $address;
        return;
    }
    
    function getrecords()
    {
        $nic_num = JRequest::getVar('nic_num');
        
        $model = $this->getModel('application');
        $model->getExistByNIC($nic_num, $result);
        $total = count($result);
        echo $total;
    }
    
    function remove()
    {
        $model = $this->getModel('application');
        if($model->delete())
            $msg = JText::_('Application Details has been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=application', $msg);
    }
}
