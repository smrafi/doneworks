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

class PFundControllerOpenBalanceLoan extends JController
{   
    
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
        
    }

    function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=openbalanceloan');
        return;
    }
    
    function backob()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=openbalance');
        return;
    }
    
    function display()
    {   
        
        
        $model = $this->getModel('openbalanceloan');
        $model->getLoanList();
        $model->pagination();
        $view = $this->getView('openbalanceloanlist', 'html');
        $view->assignRef('loan_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        
        $view->display();
    }
    
    function add()
    {  
       
        $model=$this->getModel('openbalanceloan');
        $creditor_array = $model->getCreditorArray('Select a Creditor');
        $model->initData();
       
       $view = $this->getView('openbalanceloan', 'html');
       $view->assignRef('creditor_list', $creditor_array);
       $view->assignRef('loan_list', $model->_data);
       $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $model = $this->getModel('openbalanceloan');
        $creditor_array = $model->getCreditorArray('Select a Creditor');
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = "Successfully Inserted Data";
            $this->setRedirect(COMPONENT_LINK.'&controller=loan', $msg);
            return;
        }
        
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
        }
        
        
        
        $view = $this->getView('openbalanceloan', 'html');
        $view->assignRef('loan_list', $model->_data);
        $view->assignRef('creditor_list', $creditor_array);
        $view->display();
    }
 
    
    function edit()
    {
        
        $model = $this->getModel('openbalanceloan');
        $creditor_array = $model->getCreditorArray('Select a Creditor');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $model->getOne($cid);
        
        $view = $this->getView('openbalanceloan', 'html');
        $view->assignRef('loan_list', $model->_data);
        $view->assignRef('creditor_list', $creditor_array);
        $view->display();
    }
    
    
    function remove()
    {
        $model = $this->getModel('openbalanceloan');
        if($model->delete())
            $msg = JText::_('Loan Details have been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=openbalanceloan', $msg);
    }
    
    
}
