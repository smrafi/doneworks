<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Jazeer
 * Developer Email  :   jazeermim@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   09 December 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class PFundControllerFD extends JController
{
	function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
    }
    
    function display()
    {

        $model = $this->getModel('fd');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('fdlist', 'html');
        $view->assignRef('fd_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    function add()
    {
         JRequest::setVar('hidemainmenu', 1);
         $model = $this->getModel('fd');
         $bank_model = $this->getModel('banks');
         $account_nums = array('Select an Account Number');
         $model->initData();
         
         $bank_array = $bank_model->getBankArray('Select a bank');
         $view = $this->getView('fd', 'html');
         $view->assignRef('fd_list', $model->_data);
         $view->assignRef('bank_array', $bank_array);
         $view->assignRef('account_nums', $account_nums);
         $view->display();
    }
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('fd');
        $bank_model = $this->getModel('banks');
        $bank_accountmodel = $this->getModel('bankaccount');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $model->getOne($cid);
        $bank_array = $bank_model->getBankArray('Select a bank');
        $account_nums = $bank_accountmodel->getAccountNumArray('Select an Account Number', $model->_data->bank_id);
        
        $view = $this->getView('fd', 'html');
        $view->assignRef('fd_list', $model->_data);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('account_nums', $account_nums);
        $view->display();
    }
    
     function save()
    {
        $task = JRequest::getVar('task');
        
        $model = $this->getModel('fd');
        $bank_model = $this->getModel('banks');
        $bank_accountmodel = $this->getModel('bankaccount');
        
        $stored = $model->store();
        $bank_array = $bank_model->getBankArray('Select a bank');
        $account_nums = $bank_accountmodel->getAccountNumArray('Select an Account Number', $model->_data->bank_id);
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('Fixed Diposits Added Successfuly');
            $this->setRedirect(COMPONENT_LINK.'&controller=fd', $msg);
            return;
        }
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('fd', 'html');
        $view->assignRef('fd_list', $model->_data);
        $view->assignRef('bank_array', $bank_array);
         $view->assignRef('account_nums', $account_nums);
        $view->display();
    }
    
    function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=fd');
        return;
    }
    
     function backentry()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=accountentry');
        return;
    }
    
    function publish()
    {
        $model = $this->getModel('fd');
        $model->publish(1);
        $this->setRedirect(COMPONENT_LINK.'&controller=fd');
    }
    
    function unpublish()
    {
        $model = $this->getModel('fd');
        $model->publish(0);
        $this->setRedirect(COMPONENT_LINK.'&controller=fd');
    }
    
    function remove()
    {
        $model = $this->getModel('fd');
        if($model->delete())
            $msg = JText::_('Iterest has been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=fd', $msg);
    }
}
