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

class PFundViewVoucherFile extends JView
{
    function display($tpl = null) 
    {
	   //make the top heading a menu bar
        JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('Add Voucher Reciept File').'</small></small>');
    
        JToolBarHelper::cancel('back');
        JToolBarHelper::divider();
        JToolBarHelper::apply('applyreciept');
        JToolBarHelper::save('savereciept');
        JToolBarHelper::divider();
	
        parent::display($tpl);
    }
}