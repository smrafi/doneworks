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

class TellMeMdControllerDoctors extends JController
{
    function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
    }
    
    function display()
    {
        $model = $this->getModel('doctors');
        $doctors_list = $model->getNewDoctors();
        $pagination = $model->pagination();
        
        $view = $this->getView('doctorslist', 'html');
        $view->assignRef('doc_list', $doctors_list);
        $view->assignRef('pagination', $pagination);
        $view->display();
    }
    
    function add()
    {
        JRequest::setVar('hidemainmenu', 1);
        $cat_model = $this->getModel('category');
        $condtion_model = $this->getModel('condition');
        
        $catlist_array = $cat_model->getCatArrayList(JText::_('COM_TELLMEMD_SELECT_CATEGORY'));
        $condtion_model->initData();
        
        $view = $this->getView('newcondition', 'html');
        $view->assignRef('condition_data', $condtion_model->_data);
        $view->assignRef('catlist_array', $catlist_array);
        $view->display();
    }
    
    function edit()
    {
        JRequest::setVar('hidemainmenu', 1);
        
        $model = $this->getModel('doctors');
        
        $cid = JRequest::getVar('cid',  0, '', 'array');
        $cid = (int) $cid[0];
        
        $doc_data = $model->getNewDoctor($cid);
        
        $view = $this->getView('newdoctors', 'html');
        $view->assignRef('doc_data', $doc_data);
        $view->display();
    }
}
