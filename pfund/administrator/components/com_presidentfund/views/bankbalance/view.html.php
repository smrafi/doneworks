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

class PFundViewBankBalance  extends JView

{
     function display($tpl = null) 
    {
          //make the top heading a menu bar
        
    if($this->bankbalance_data->id)
          JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('Edit Bank Balance').'</small></small>');
      else
          JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('New Bank Balance').'</small></small>');
        
       JToolBarHelper::apply();
       JToolBarHelper::save2new();
       JToolBarHelper::save();
       JToolBarHelper::cancel();
        parent::display($tpl);
     }
}
