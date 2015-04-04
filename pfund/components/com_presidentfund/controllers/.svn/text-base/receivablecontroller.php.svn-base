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

class PFundControllerReceivable extends JController
{
    Function display()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('receivable');
        $model->getList();
        $model->pagination();
        $view = $this->getView('receivablelist', 'html');
        $view->assignRef('receivable_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        
        $view->display();
    }
    
       
    function addnew()
    {  
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model=$this->getModel('receivable');
        $debtor_array = $model->getDebtorArray('Select a Debtor');
        $model->initData();
       
        $view = $this->getView('receivable', 'html');
        $view->assignRef('debtor_list', $debtor_array);
        $view->assignRef('receivable_list', $model->_data);
        $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('receivable');
        $debtor_array = $model->getDebtorArray('Select a Debtor');
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = "Successfully Inserted Data";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=receivable',FALSE), $msg);
            return;
        }
        
            $model->initData();
        
        $view = $this->getView('receivable', 'html');
        $view->assignRef('receivable_list', $model->_data);
        $view->assignRef('debtor_list', $debtor_array);
        $view->display();
    }
}