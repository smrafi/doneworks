<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   27 July 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class TellMeMdControllerDispute extends JController
{
    function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
    }
    
    function display()
    {   
        $dispute_model = $this->getModel('disputes');
        $dispute_list = $dispute_model->getDisputes();        
        $pagination =  $dispute_model->pagination();
        
        $view = $this->getView('disputelist', 'html');
        $view->assignRef('dispute_list', $dispute_list);
        $view->assignRef('pagination', $pagination);
        $view->display();
    }
    
    function view(){
        JRequest::setVar('hidemainmenu', 1);
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $cat_model = $this->getModel('category');
        $cat_list = $cat_model->getCatArrayList("Select a Category");
        
        $case_model = $this->getModel('case');
        $case_data=$case_model->getOne($cid);   
        
        $disputes_model = $this->getModel('disputes');
        $disputes_model->setStatusUpdate($cid);
        
        $p_feedback=$case_model->getFeedBackByUserId($case_data->patient_feedback_id);
        $d_feedback=$case_model->getFeedBackByUserId($case_data->doctor_feedback_id);        
        
        $view = $this->getView('dispute', 'html');
        $view->assignRef('dispute_data', $case_data);
        $view->assignRef('cat_list', $cat_list);        
        $view->assignRef('p_feedback', $p_feedback);
        $view->assignRef('d_feedback', $d_feedback);
        
        $view->display();
    } 
    
    function cancel(){
        $this->setRedirect(COMPONENT_LINK.'&controller=dispute');
        return;
    }
    
    
    
    function remove()
    {
        $dispute_model = $this->getModel('disputes');
        if($dispute_model->delete())
            $msg = JText::_('COM_TELLMEMD_TASK_DELETED');
        $this->setRedirect(COMPONENT_LINK.'&controller=dispute', $msg);
    }
}
