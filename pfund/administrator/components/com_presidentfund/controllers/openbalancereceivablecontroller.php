<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class PFundControllerOpenbalanceReceivable extends JController
{   
    
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
        
    }

    function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=openbalancerecievable');
        return;
    }
    
    function backob()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=openbalance');
        return;
    }
    
    function display()
    {   
        
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('openbalancereceivable');
        $model->getList();
        $model->pagination();
        $view = $this->getView('openbalancereceivablelist', 'html');
        $view->assignRef('openbalancereceivable_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        
        $view->display();
    }
    
    function add()
    {  
       
        $model=$this->getModel('openbalancereceivable');
        $debtor_array = $model->getDebtorArray('Select a Debtor');
        $model->initData();
       
       $view = $this->getView('openbalancereceivable', 'html');
       $view->assignRef('debtor_list', $debtor_array);
       $view->assignRef('openbalancereceivable_list', $model->_data);
       $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $model = $this->getModel('openbalancereceivable');
        $debtor_array = $model->getDebtorArray('Select a Debtor');
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = "Successfully Inserted Data";
            $this->setRedirect(COMPONENT_LINK.'&controller=openbalancereceivable', $msg);
            return;
        }
        
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('openbalancereceivable', 'html');
        $view->assignRef('openbalancereceivable_list', $model->_data);
        $view->assignRef('debtor_list', $debtor_array);
        $view->display();
    }
 
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('openbalancereceivable');
        $debtor_array = $model->getDebtorArray('Select a Debtor');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $model->getOne($cid);
        
        $view = $this->getView('openbalancereceivable', 'html');
        $view->assignRef('openbalancereceivable_list', $model->_data);
        $view->assignRef('debtor_list', $debtor_array);
        $view->display();
    }
    
    
    function remove()
    {
        $model = $this->getModel('openbalancereceivable');
        if($model->delete())
            $msg = JText::_('Receivable Details have been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=openbalancereceivable', $msg);
    }
    
    
}