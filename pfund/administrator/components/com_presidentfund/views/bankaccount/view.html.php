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
class PFundViewBankAccount extends JView
{
    function display($tpl = null) 
    {
        //make the top heading a menu bar
         
        if($this->bankaccount_list->id)
              JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('Edit Bank Account').'</small></small>');
          else
              JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('New Bank Account').'</small></small>');
          
        JToolBarHelper::apply();
        JToolBarHelper::save2new();
        JToolBarHelper::save();
        JToolBarHelper::cancel();
	JToolBarHelper::custom('help', 'help.png', 'help_f2.png', JText::_('JHELP'), false);
        
        parent::display($tpl);
    }
}
