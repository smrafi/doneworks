<?php

/* * *****************************************************************************
 * Developer        :   Saraniptha Nonis
 * Developer Email  :   saraniptha@archmage.lk
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   19 October 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class TellMeMdControllerNotice extends JController
{
    function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
    }
    
    function display()
    {   
        $model = $this->getModel('notices');  
        $data=$model->getNotices();
        $pagination = $model->pagination();
        
        $view = $this->getView('noticelist', 'html');
        $view->assignRef('notice_list', $data);
        $view->assignRef('pagination', $pagination);
        $view->display();
    }
    
    function add(){
        
           JRequest::setVar('hidemainmenu', 1);      
            
           $model = $this->getModel('notices');  
            
           $data = $model->initData();   
           $doc_list=$model->getRegDoctors();            
           $pat_list=$model->getRegPatients();
           
	   $view = $this->getView('notice', 'html');
           $view->assignRef('notice_data', $data);
           $view->assignRef('doc_list', $doc_list);
           $view->assignRef('pat_list', $pat_list);
           
	   $view->display();
    }
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        
        $model = $this->getModel('notices');
        $doc_list=$model->getRegDoctors();            
        $pat_list=$model->getRegPatients();
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $notice_data = $model->getOne($cid);
        
        $view = $this->getView('notice', 'html');
        $view->assignRef('notice_data', $notice_data);
        $view->assignRef('doc_list', $doc_list);
        $view->assignRef('pat_list', $pat_list);
        $view->display();
    }
    
    function save(){
        $task = JRequest::getVar('task');  
               
        $model = $this->getModel('notices');
        $doc_list=$model->getRegDoctors();            
        $pat_list=$model->getRegPatients();
        
        $stored = $model->store();  
        
        
        if ($stored and ($task == 'apply'))
	{      			
	      JFactory::getApplication()->enqueueMessage(JText::_('COM_TELLMEMD_TASK_SAVED'));
              JToolBarHelper::custom('send_notice', 'send.png', 'send.png', JText::_('Send eMail'), false);
	}
        if($stored && $task == 'save')
        {
            $msg = JText::_('COM_TELLMEMD_TASK_SAVED');
            $this->setRedirect(COMPONENT_LINK.'&controller=notice', $msg);
            return;
        }               
        
        $view = $this->getView('notice', 'html'); 
        $view->assignRef('notice_data', $model->_data);
        $view->assignRef('doc_list', $doc_list);
        $view->assignRef('pat_list', $pat_list);
        $view->display();    
      
    }
    
    function remove()
    {
        $model = $this->getModel('notices');
        if($model->delete())
            $msg = JText::_('COM_TELLMEMD_TASK_DELETED');
        $this->setRedirect(COMPONENT_LINK.'&controller=notice', $msg);
    }
    
    function send_notice(){
        
        $cid = JRequest::getInt('id','');  
        $model = $this->getModel('notices');
        $send=$model->send($cid);
        $model->updateEmailSentStatus($cid,$send);//TODO check the fucntion 
        if($send)
        {
            $msg = JText::_('COM_TELLMEMD_NOTICE_EMAIL_SEND');
            $this->setRedirect(COMPONENT_LINK.'&controller=notice', $msg);
            return;
        }    
        //TODO 
    }
}
