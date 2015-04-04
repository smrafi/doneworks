<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   19 Dec 2011
 * ***************************************************************************** */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class PFundControllerPaySetting extends JController
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
        
        $model = $this->getModel('paysetting');
        $model->getPaySettingList();
        $model->pagination();
        
        $ledger_itemmodel = $this->getModel('ledgeritem');
        $credit_ledger = $ledger_itemmodel->getLedgerItemArray('Select an Income Source','');
        $debit_ledger = $ledger_itemmodel->getLedgerItemArray('Select an Ledger Item', '');
        
        $view = $this->getView('paysettinglist', 'html');
        $view->assignRef('ledger_debit_array', $debit_ledger);
        $view->assignRef('ledger_credit_array', $credit_ledger);
        $view->assignRef('paysetting_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
            
    }
    
    function addnew()
    {
         $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
         $this->addModelPath($path);
        
         $model = $this->getModel('paysetting');
         $model->initData();
         $ledger_itemmodel = $this->getModel('ledgeritem');
         
         $credit_ledger = $ledger_itemmodel->getLedgerItemArray('Select an Income Source',1);
         $debit_ledger = $ledger_itemmodel->getLedgerItemArray('Select an Ledger Item', 2);
         
         $view = $this->getView('paysetting', 'html');
         $view->assignRef('ledger_debit_array', $debit_ledger);
         $view->assignRef('ledger_credit_array', $credit_ledger);
         $view->assignRef('paysetting_list', $model->_data);
         $view->display();
   
    }
    
    function save()
    {
         $task = JRequest::getVar('task');
         
         $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
         $this->addModelPath($path);
         
         $model = $this->getModel('paysetting');
         $ledger_itemmodel = $this->getModel('ledgeritem');
        
         $stored = $model->store();
         $credit_ledger = $ledger_itemmodel->getLedgerItemArray('Select an Income Source',1);
         $debit_ledger = $ledger_itemmodel->getLedgerItemArray('Select an Ledger Item', 2);
        
         if($stored && ($task == 'save'))
         {
            $msg = JText::_('Payable Item Added Successfuly');
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=paysetting',FALSE), $msg);
            return;
         }
        
         $view = $this->getView('paysetting', 'html');
         $view->assignRef('ledger_debit_array', $debit_ledger);
         $view->assignRef('ledger_credit_array', $credit_ledger);
         $view->assignRef('paysetting_list', $model->_data);
         $view->display();
    }
    
    function edit()
    {
         $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
         $this->addModelPath($path);
         
         $model = $this->getModel('paysetting');
         $ledger_itemmodel = $this->getModel('ledgeritem');
        
         $cid = JRequest::getVar('cid');
                
         $model->getOne($cid);
         $credit_ledger = $ledger_itemmodel->getLedgerItemArray('Select an Income Source',1);
         $debit_ledger = $ledger_itemmodel->getLedgerItemArray('Select an Ledger Item', 2);
        
         $view = $this->getView('paysetting', 'html');
         $view->assignRef('paysetting_list', $model->_data);
         $view->assignRef('ledger_debit_array', $debit_ledger);
         $view->assignRef('ledger_credit_array', $credit_ledger);
         $view->display();
    }
    
     function backop()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=account',FALSE));
        return;
    }
}


