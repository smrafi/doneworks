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

class PFundControllerContact extends JController
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
        
        $model = $this->getModel('contact');
        $model->getList();
        $model->pagination();
        
        $view = $this->getView('contactlist', 'html');
        $view->assignRef('contact_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    function addnew()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('contact');
        $model->initData();
		
        $view = $this->getView('contact', 'html');
        $view->assignRef('contact_data', $model->_data);
        $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('contact');
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('Contact Added Successfuly');
            $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=contact',FALSE), $msg);
            return;
        }
       
                    
        $view = $this->getView('contact', 'html');
        $view->assignRef('contact_data', $model->_data);
        $view->display();
    }
    
    function edit()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('contact');
        
        $cid = JRequest::getVar('cid');
                
        $model->getOne($cid);
        
        $view = $this->getView('contact', 'html');
        $view->assignRef('contact_data', $model->_data);
        $view->display();
    }
    
    function remove()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('contact');
        if($model->delete())
            $msg = JText::_('Contact has been deleted');
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=contact',FALSE), $msg);
    }
    
    function getContactList()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);

        
        $result_id = JRequest::getVar('result_id');
        $contact_model=$this->getModel('contact');
        $contact_list = $contact_model->getContactArray($result_id);
        
        $view = $this->getView('comboresult', 'html');
        $view->assignRef('result_out', $contact_list);
        $view->display();
        return;
    }
    
    function newpopupContact()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);

        
        $view = $this->getView('popcontact', 'html');
        $view->display();
        return;
    }
    
    function linkback()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=configure',FALSE));
    }
}
