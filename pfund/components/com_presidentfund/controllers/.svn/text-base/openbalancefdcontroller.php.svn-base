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

class PFundControllerOpenBalanceFD extends JController
{
	function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
    }
    
    function display()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);

        $model = $this->getModel('openbalancefd');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('openbalancefdlist', 'html');
        $view->assignRef('fd_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    function addnew()
    {
         $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
         $this->addModelPath($path);

         $model = $this->getModel('openbalancefd');
         $bank_model = $this->getModel('banks');
         $account_nums = array('Select an Account Name');
         $model->initData();

         $bank_array = $bank_model->getBankArray('Select a bank');
         $view = $this->getView('openbalancefd', 'html');
         $view->assignRef('fd_list', $model->_data);
         $view->assignRef('bank_array', $bank_array);
         $view->assignRef('account_nums', $account_nums);
         $view->display();
    }
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('openbalancefd');
        $bank_model = $this->getModel('banks');
        $bank_accountmodel = $this->getModel('bankaccount');
        
        $cid = JRequest::getVar('cid');
                
        $model->getOne($cid);
        $bank_array = $bank_model->getBankArray('Select a bank');
        $account_nums = $bank_accountmodel->getAccountNumArray('Select an Account Name', $model->_data->bank_id);
        
        $view = $this->getView('openbalancefd', 'html');
        $view->assignRef('fd_list', $model->_data);
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('account_nums', $account_nums);
        $view->display();
    }
    
     function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('openbalancefd');
        $bank_model = $this->getModel('banks');
        $bank_accountmodel = $this->getModel('bankaccount');
        
        $stored = $model->store();
        $bank_array = $bank_model->getBankArray('Select a bank');
        $account_nums = $bank_accountmodel->getAccountNumArray('Select an Account Name', $model->_data->bank_id);
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('Fixed Diposits Added Successfuly');
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=openbalancefd',FALSE), $msg);
            return;
        }
        
        $view = $this->getView('openbalancefd', 'html');
        $view->assignRef('fd_list', $model->_data);
        $view->assignRef('bank_array', $bank_array);
         $view->assignRef('account_nums', $account_nums);
        $view->display();
    }
    
           
    function remove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('openbalancefd');
        if($model->delete())
            $msg = JText::_('Iterest has been deleted');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=openbalancefd',FALSE), $msg);
    }
    
    function getaccountnum()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $bank_id = JRequest::getInt('bank_id');
        $bank_accountmodel = $this->getModel('bankaccount');
        $account_nums = $bank_accountmodel->getAccountNumArray('Select an Account Name', $bank_id);
        
        $view = $this->getView('accountnums', 'html');
        $view->assignRef('account_nums', $account_nums);
        $view->display();
        return;
    }
    
     function backop()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=openbalance',FALSE));
        return;
    }
    
   
    
}