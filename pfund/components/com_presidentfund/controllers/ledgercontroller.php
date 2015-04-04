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

class PFundcontrollerLedger extends JController
{
    
    
    function display()
    {   
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        $search = JRequest::getInt('search_by');
        $model = $this->getModel('ledger');
        
        $model->getLedgerList($search);
        $model->pagination();
        
        $view = $this->getView('ledgerlist', 'html');
        $view->assignRef('ledgerlist', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
       
    }
    
    function subledger()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
        
        $search = JRequest::getInt('search_by');
        
        $model = $this->getModel('ledger');
        $model->getlist($search);
        $model->pagination();
        
        $view = $this->getView('subledgerlist', 'html');
        $view->assignRef('subledger_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    function cancel()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=accountview'));
        return;
    }
    
    function backop()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=ledger'));
        return;
    }
}
 



