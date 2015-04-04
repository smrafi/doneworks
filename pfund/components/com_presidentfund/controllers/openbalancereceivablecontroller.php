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

class PFundControllerOpenbalanceReceivable extends JController
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
        
        $model = $this->getModel('openbalancereceivable');
        $model->getList();
        $model->pagination();
        $view = $this->getView('openbalancereceivablelist', 'html');
        $view->assignRef('openbalancereceivable_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        
        $view->display();
    }
    
       
    function addnew()
    {  
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model=$this->getModel('openbalancereceivable');
        $model->initData();
       
        $view = $this->getView('openbalancereceivable', 'html');
        $view->assignRef('openbalancereceivable_list', $model->_data);
        $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('openbalancereceivable');
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = "Successfully Inserted Data";
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=openbalancereceivable',FALSE), $msg);
            return;
        }
        
        $view = $this->getView('openbalancereceivable', 'html');
        $view->assignRef('openbalancereceivable_list', $model->_data);
        $view->display();
    }
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('openbalancereceivable');
        
        $cid = JRequest::getVar('cid');
        
        $model->getOne($cid);
        
        $view = $this->getView('openbalancereceivable', 'html');
        $view->assignRef('openbalancereceivable_list', $model->_data);
        $view->display();
    }
    
    function remove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('openbalancereceivable');
        if($model->delete())
            $msg = JText::_('Receivable Details have been deleted');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=openbalancereceivable',FALSE), $msg);
    }
    
    function backop()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=openbalance',FALSE));
        return;
    }
    
}