<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   20 Dec 2011
 * ***************************************************************************** */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class PFundControllerOpenbalancePayable extends JController
{
    
    function __construct()
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
    }
    
    Function display()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model=$this->getModel('openbalancepayable');
        $model->getList();
        $model->pagination();
        $view = $this->getView('openbalancepayablelist', 'html');
        $view->assignRef('openbalancepayable_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
       
        $view->display();
    }
    
    function addnew()
    {  
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model=$this->getModel('openbalancepayable');
        $ledgermodel=$this->getModel('ledgeritem');
        $ledger_array = $ledgermodel->getLedgerItemArray('Select Ledger Type',2);
        
        $model->initData();
        
       $view = $this->getView('openbalancepayable', 'html');
       $view->assignRef('ledger_list', $ledger_array);
       $view->assignRef('openbalancepayable_list', $model->_data);
       $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('openbalancepayable');
        $ledgermodel=$this->getModel('ledgeritem');
        $ledger_array = $ledgermodel->getLedgerItemArray('Select Ledger Type',2);
       
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = "Successfully Inserted Data";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=openbalancepayable',FALSE), $msg);
            return;
        }
                 
        $view = $this->getView('openbalancepayable', 'html');
        $view->assignRef('openbalancepayable_list', $model->_data);
        $view->assignRef('ledger_list', $ledger_array);
        $view->display();
    }
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('openbalancepayable');
        $ledgermodel=$this->getModel('ledgeritem');
        $ledger_array = $ledgermodel->getLedgerItemArray('Select Ledger Type',2);
        
        $cid = JRequest::getVar('cid');
        
        $model->getOne($cid);
        
        $view = $this->getView('openbalancepayable', 'html');
        $view->assignRef('openbalancepayable_list', $model->_data);
        $view->assignRef('ledger_list', $ledger_array);
        $view->display();
    }
    
     function remove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('openbalancepayable');
        if($model->delete())
            $msg = JText::_('Payable Details have been deleted');
       $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=openbalancepayable',FALSE), $msg);
    }
    
    function backop()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=openbalance',FALSE));
        return;
    }
}