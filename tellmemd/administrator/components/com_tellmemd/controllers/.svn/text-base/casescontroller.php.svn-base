<?php
/* * *****************************************************************************
 * Developer        :   Saraniptha Nonis
 * Developer Email  :   saraniptha@archmage.lk
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   18 October 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class TellMeMdControllerCases extends JController
{
    function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
    }
    
    function display()
    {   
        $case_model = $this->getModel('case');
        $case_list=$case_model->getCases();
        $pagination = $case_model->pagination();
         
        $view = $this->getView('caselist', 'html');
        $view->assignRef('case_list', $case_list);
        $view->assignRef('pagination', $pagination);
        $view->display();
    }
    
    function edit(){
        JRequest::setVar('hidemainmenu', 1);
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $cat_model = $this->getModel('category');
        $cat_list = $cat_model->getCatArrayList("Select a Category");
        
        $case_model = $this->getModel('case');
        $case_data=$case_model->getOne($cid);
        $doc_list = $case_model->getDoctorNameList("Select a Doctor");        
        $p_feedback=$case_model->getFeedBackByUserId($case_data->patient_feedback_id);
        $d_feedback=$case_model->getFeedBackByUserId($case_data->doctor_feedback_id);
        
        
        $view = $this->getView('case', 'html');
        $view->assignRef('case_data', $case_data);
        $view->assignRef('cat_list', $cat_list);
        $view->assignRef('doc_list', $doc_list);       
        $view->assignRef('p_feedback', $p_feedback);
        $view->assignRef('d_feedback', $d_feedback);
        
        $view->display();
    } 
    
    function cancel(){
        $this->setRedirect(COMPONENT_LINK.'&controller=cases');
        return;
    }
    
    function save(){
        
        $task = JRequest::getVar('task');
        
        $case_model = $this->getModel('case');
        $stored = $case_model->store();
        
        $cat_model = $this->getModel('category');
        $cat_list = $cat_model->getCatArrayList("Select a Category");
       
        
        if($stored && $task == 'save')
        {
            $msg = JText::_('COM_TELLMEMD_TASK_SAVED');
            $this->setRedirect(COMPONENT_LINK.'&controller=cases', $msg);
            return;
        }
        
        $data=$case_model->getOne($case_model->_data->id);
        $doc_list = $case_model->getDoctorNameList("Select a Doctor");                           
        $p_feedback=$case_model->getFeedBackByUserId($case_model->_data->patient_feedback_id);
        $d_feedback=$case_model->getFeedBackByUserId($case_model->_data->doctor_feedback_id);
        
        JRequest::setVar('hidemainmenu', 1);
        $view = $this->getView('case', 'html');
        $view->assignRef('case_data', $data);
        $view->assignRef('cat_list', $cat_list);
        $view->assignRef('doc_list', $doc_list);        
        $view->assignRef('p_feedback', $p_feedback);
        $view->assignRef('d_feedback', $d_feedback);
        $view->display();       
    }
    
    function remove()
    {
        $case_model = $this->getModel('case');
        if($case_model->delete())
            $msg = JText::_('COM_TELLMEMD_TASK_DELETED');
        $this->setRedirect(COMPONENT_LINK.'&controller=cases', $msg);
    }
}

?>
