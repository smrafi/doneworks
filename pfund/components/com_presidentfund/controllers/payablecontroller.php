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

class PFundControllerPayable extends JController
{   
    
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
                
    }

       
    function display()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model=$this->getModel('payable');
        $model->getList();
        $model->pagination();
        $view = $this->getView('payablelist', 'html');
        $view->assignRef('payable_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
       
        $view->display();
    }
    
    function addnew()
    {  
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
       
        $model=$this->getModel('payable');
        $ledgermodel=$this->getModel('ledgeritem');
        $ledger_array = $ledgermodel->getLedgerItemArray('Select a Expensess Type',2);
        $creditormodel=$this->getModel('loan');
        $creditor_array = $creditormodel->getCreditorArray('Select a Creditor');
        $model->initData();
        
       $view = $this->getView('payable', 'html');
       $view->assignRef('ledger_list', $ledger_array);
       $view->assignRef('creditor_list', $creditor_array);
       $view->assignRef('payable_list', $model->_data);
       $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('payable');
        $ledgermodel=$this->getModel('ledgeritem');
        $ledger_array = $ledgermodel->getLedgerItemArray('Select a Expensess Type',2);
        $creditormodel=$this->getModel('loan');
        $creditor_array = $creditormodel->getCreditorArray('Select a Creditor');
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = "Successfully Inserted Data";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=payable',FALSE), $msg);
            return;
        }
                
        $view = $this->getView('payable', 'html');
        $view->assignRef('payable_list', $model->_data);
        $view->assignRef('ledger_list', $ledger_array);
        $view->assignRef('creditor_list', $creditor_array);
        $view->display();
    }
 
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('payable');
        $ledgermodel=$this->getModel('ledgeritem');
        $ledger_array = $ledgermodel->getLedgerItemArray('Select a Expensess Type',2);
        $creditormodel=$this->getModel('loan');
        $creditor_array = $creditormodel->getCreditorArray('Select a Creditor');
        
        $cid = JRequest::getVar('cid');
        
        $model->getOne($cid);
        
        $view = $this->getView('payable', 'html');
        $view->assignRef('payable_list', $model->_data);
        $view->assignRef('ledger_list', $ledger_array);
        $view->assignRef('creditor_list', $creditor_array);
        $view->display();
    }
    
    
    function remove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('payable');
        if($model->delete())
            $msg = JText::_('Payable Details have been deleted');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=payable',FALSE), $msg);
    }
    
   
    
    
}
