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

class PFundControllerHospital extends JController
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
        
        $model = $this->getModel('hospital');
        $model->getList();
        
        $view = $this->getView('hospitallist', 'html');
        $view->assignRef('hospital_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    function addnew()
    {
         $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
         $this->addModelPath($path);
         
         $model = $this->getModel('hospital');
         $bank_model = $this->getModel('banks');
         $model->initData();
         
         $bank_array = $bank_model->getBankArray('Select a bank');
         $view = $this->getView('hospital', 'html');
         $view->assignRef('bank_array', $bank_array);
         $view->assignRef('hospital_list', $model->_data);
        
         $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
         
        $model = $this->getModel('hospital');
        $bank_model = $this->getModel('banks');
        
        
        $stored = $model->store();
        $bank_array = $bank_model->getBankArray('Select a bank');
        
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('Hospital Details Added Successfuly');
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=hospital',FALSE), $msg);
            return;
        }
        
                
        $view = $this->getView('hospital', 'html');
        $view->assignRef('bank_array', $bank_array);
        $view->assignRef('hospital_list', $model->_data);
        $view->display();
    }
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('hospital');
        $bank_model = $this->getModel('banks');
        
        $cid = JRequest::getVar('cid');
        
        $model->getOne($cid);
        $bank_array = $bank_model->getBankArray('Select a bank');
        
        $view = $this->getView('hospital', 'html');
        $view->assignRef('hospital_list', $model->_data);
        $view->assignRef('bank_array', $bank_array);
        $view->display();
    }
    
    function remove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('hospital');
        if($model->delete())
            $msg = JText::_('Hospital Detail has been deleted');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=hospital',FALSE), $msg);
    }
    
    function linkback()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=configure',FALSE));
    }
}