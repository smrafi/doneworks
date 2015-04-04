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

class PFundControllerAccountReport extends JController
{
    
    
    function display()
    {      
        $view = $this->getView('accountreport', 'html');
        $view->display();
    }
    
    function profitLost()
    {   
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('accountreport');
//        $model->profit_loss();

        $model->pagination();
        
        $view = $this->getView('profitlosslist', 'html');        
//        $view->assignRef('profit_loss',$model->data);
        $view->assignRef('pagination',$model->_pagination);
        $view->display();
       
    }
    
    function getBalanceSheet()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('accountreport');
//        $model->balance_sheet();

        $model->pagination();
        $view = $this->getView('balancesheetlist', 'html');        
//        $view->assignRef('balance_sheet',$model->data);
        $view->assignRef('pagination',$model->_pagination);
        $view->display();
        
    }
    
    function budgetAnalysis()
    {   
        
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('accountreport');
//        $model->getBudgetAnalys();

        $model->pagination();
        $view = $this->getView('budgetanalysislist', 'html');       
//        $view->assignRef('budget_analys',$model->data);
        $view->assignRef('pagination',$model->_pagination);
        $view->display();
        
    }
    
    function getAccReceivable()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('accountreport');
//        $model->getAccReceivable();

        $model->pagination();
        $view = $this->getView('accountreceivablelist', 'html');       
//        $view->assignRef('acc_receivable',$model->data);
        $view->assignRef('pagination',$model->_pagination);
        $view->display();
        
    }
    
    function accountPayable()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('accountreport');
//        $model->getAccPayable();

        $model->pagination();
        $view = $this->getView('accountpayablelist', 'html');         
//        $view->assignRef('acc_payable',$model->data);
        $view->assignRef('pagination',$model->_pagination);
        $view->display();
       
        
    }
    
    function guarantyletter()
    {   
        
        $view = $this->getView('guarantyletterlist', 'html');        
        $view->display();
        
    }
    
    function trialbalance()
    {   
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'Models';
        $this->addModelPath($path);
        
        $model = $this->getModel('accountreport');
        $model->gettrialbalance();
        $model->pagination();
        
        $view = $this->getView('trialbalancelist', 'html');
        $view->assignRef('trial_data',$model->_data);
        $view->assignRef('pagination',$model->_pagination);
        $view->display();
        
    }
    
    
    function cancel()
    {
        $this->setRedirect(JRoute::_(COMPONENT_LINK.'&controller=accountreport',FALSE));
        return;
    }
    
    function search_app()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
       
        $dsoffice_model = $this->getModel('dsoffice');
        $cat_model = $this->getModel('category');
        $disease_model = $this->getModel('disease');
        $report_model = $this->getModel('accountreport');
        $dsoffices = $dsoffice_model->dsOfficeListArray('All');
        $cat_array = $cat_model->getCatArray('All');
        $disease_array = $disease_model->getDiseaseList('All', '');
       
        $report_model->getsearchlist();
        $report_model->pagination();
       
        $view = $this->getView('search', 'html');
        $view->assignRef('dsoffices', $dsoffices);
        $view->assignRef('cat_array', $cat_array);
        $view->assignRef('disease_array', $disease_array);
        $view->assignRef('report_data',$report_model->_data);
        $view->assignRef('pagination', $report_model->_pagination);
        $view->display();
    }
   
    function getdsoffice()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
       
        $district_id = JRequest::getVar('patient_district');
        $dsoffice_model = $this->getModel('dsoffice');
       
        $dsoffices = $dsoffice_model->dsOfficeListArray('All', $district_id);
        echo PFundHelper::createList('patient_dsoffice', 0, $dsoffices);
        return;
    }
   
    function getdisease()
    {
        $path = JPATH_COMPONENT_ADMINISTRATOR.DS.'models';
        $this->addModelPath($path);
       
        $cat_id = JRequest::getInt('medical_cat');
        $disease_model = $this->getModel('disease');
       
        $disease_array = $disease_model->getDiseaseList('Select a medical condition', $cat_id);
        echo PFundHelper::createList('disease_id', 0, $disease_array);
    }
    
}
