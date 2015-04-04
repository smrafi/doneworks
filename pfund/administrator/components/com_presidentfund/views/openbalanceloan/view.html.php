<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Asfaran
 * Developer Email  :   asfaransl@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   
 * ***************************************************************************** */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');

class PFundViewOpenBalanceLoan extends JView
{
    function display($tpl = null) 
    {
	   //make the top heading a menu bar
        if($this->loan_list->id)
              JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('Edit Added Loan Opening Balance Detialed Item').'</small></small>');
        else
              JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('Add Loan Opening Balance Detialed Item').'</small></small>');
    
        JToolBarHelper::cancel('back');
        JToolBarHelper::divider();
        JToolBarHelper::apply();
        JToolBarHelper::save2new();
        JToolBarHelper::save();
        JToolBarHelper::divider();
	JToolBarHelper::custom('help', 'help.png', 'help_f2.png', JText::_('JHELP'), false);

        parent::display($tpl);
    }
}