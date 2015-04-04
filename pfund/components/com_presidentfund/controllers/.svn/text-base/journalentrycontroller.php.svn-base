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

class PFundControllerJournalEntry extends JController
{
    
    function display()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $ledger_model=$this->getModel('ledgeritem');
        $ledgertype_list = $ledger_model->getLedgerItemArray('Select a Type');
        
        $model = $this->getModel('journalentry');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('journalentry', 'html');
        $view->assignRef('journalentry_data', $model->_data);
       
        $view->assignRef('ledgeritemtype_list', $ledgertype_list);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
     function backop()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=accountentry');
        return;
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $model = $this->getModel('journalentry');
        $stored = $model->store();
        $model->getList();
        $model->pagination();
        
        if($stored and $task == 'save')
        {
            $msg = "Journal Entry Added";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=journalentry',FALSE), $msg);
            return;
        }
        $view = $this->getView('journalentry', 'html');
        $view->assignRef('journalentry_data', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
        
    }
    
    function back()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=accountentry',FALSE));
        return;
    }
    
}
