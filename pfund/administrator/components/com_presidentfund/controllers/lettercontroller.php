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

class PFundControllerLetter extends JController
{
    function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
        $this->registerTask('save2new', 'save');
    }
    
    function display()
    {
        $model = $this->getModel('letter');
        $model->getlist();
        $model->Pagination();
        
        $view = $this->getView('letterlist', 'html');
        $view->assignRef('letter_list', $model->_data);
        $view->assignRef('pagination', $model->_pagination);
        $view->display();
    }
    
    function add()
    {
        
        $model = $this->getModel('letter');
        $template_model = $this->getModel('template');
        
        $model->initData();
        $template_array = $template_model->getTemplateListArray('Select a template');
        
        $view = $this->getView('letter', 'html');
        $view->assignRef('letter_data', $model->_data);
        $view->assignRef('template_array', $template_array);
        $view->display();
    }
    
    function getletter()
    {
        
        $model = $this->getModel('letter');
        $template_model = $this->getModel('template');
        
        $model->getPostData();
        $template_model->getOne($model->_data->template_id);
        $template_array = $template_model->getTemplateListArray('Select a template');
        $letter_data = $model->getLetterData($model->_data->application_id);
        
        $model->_data->letter_content = $template_model->prepareTemplateLetter($letter_data, $template_model->_data->template_content);
        
        $view = $this->getView('letter', 'html');
        $view->assignRef('letter_data', $model->_data);
        $view->assignRef('template_array', $template_array); 
        $view->display();
    }
    
    function save()
    {
        
        $model = $this->getModel('letter');
        $template_model = $this->getModel('template');
        
        $stored = $model->store();
        $template_array = $template_model->getTemplateListArray('Select a template');
        
        if($stored)
            $model->updateManageTable($model->_data->application_id, $model->_data->office_type);
        
        $view = $this->getView('letter', 'html');
        $view->assignRef('letter_data', $model->_data);
        $view->assignRef('template_array', $template_array);
        $view->display();
    }
    
   
}

