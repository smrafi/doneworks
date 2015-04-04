<?php
/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class PFundControllerTemplate extends JController
{
    	function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
    }
    
    function display()
    {
        $model = $this->getModel('template');
        $template_data=$model->getone(8);
        $model->getList();
        $model->pagination();
        
        $test_data->patient_title='Mr.';
        $test_data->patient_fullname='clinton';
        $test_data->application_num='1122114';
        $test_data->patient_nic='342312454v';
        $test_data->patient_address='colombo';
        $test_data->ds_office='col-6';
        
        $replaced_text = $model->prepareTemplateLetter($template_data->template_content, $test_data);
                
        $view = $this->getView('templatelist', 'html');
        $view->assignRef('template_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        
        $view->display();
    }
    
    function add()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('template');
        $model->initData();
        
        $view = $this->getView('template', 'html');
        $view->assignRef('template_data', $model->_data);
        $view->display();
    }
    
     function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        $model = $this->getModel('template');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $model->getOne($cid);
        
        $view = $this->getView('template', 'html');
        $view->assignRef('template_data', $model->_data);
        $view->display();
    }
    
    function save()
    {
        $task = JRequest::getVar('task');
        
        $model = $this->getModel('template');
        $stored = $model->store();
        
        if($stored && ($task == 'save'))
        {
            $msg = JText::_('Template has been saved');
            $this->setRedirect(COMPONENT_LINK.'&controller=template', $msg);
            return;
        }
        elseif($stored && ($task == 'save2new'))
        {
            $model->initData();
        }
        
        JRequest::setVar('hidemainmenu', 1);
        
        $view = $this->getView('template', 'html');
        $view->assignRef('template_data', $model->_data);
        $view->display();
    }
    
    function back()
    {
        $this->setRedirect(COMPONENT_LINK.'&controller=configure');
        return;
    }
    
    
   function publish()
    {
        $model = $this->getModel('template');
        $model->publish(1);
        $this->setRedirect(COMPONENT_LINK.'&controller=template');
    }
    
    function unpublish()
    {
        $model = $this->getModel('template');
        $model->publish(0);
        $this->setRedirect(COMPONENT_LINK.'&controller=template');
    }
    
    function remove()
    {
        $model = $this->getModel('template');
        if($model->delete())
            $msg = JText::_('Template has been deleted');
        $this->setRedirect(COMPONENT_LINK.'&controller=template', $msg);
    }
    
}