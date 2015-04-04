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

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');

class PFundViewLedgerItem  extends JView

{
     function display($tpl = null) 
    {
          //make the top heading a menu bar
        
    if($this->ledgeritem_data->id)
          JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('Edit Ledger Item').'</small></small>');
      else
          JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('New Ledger Item').'</small></small>');
        
       JToolBarHelper::apply();
       JToolBarHelper::save2new();
       JToolBarHelper::save();
       JToolBarHelper::cancel();
        parent::display($tpl);
     }
}
