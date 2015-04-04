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

class PFundViewAccountSetting extends JView

{
     function display($tpl = null) 
    {
          //make the top heading a menu bar
        
       
              JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('Account Settings').'</small></small>');
          
           
       JToolBarHelper::cancel();
       parent::display($tpl);
     }
}
