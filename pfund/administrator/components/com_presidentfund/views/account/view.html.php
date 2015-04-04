<?php

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');

class PFundViewAccount  extends JView

{
     function display($tpl = null) 
    {
         
          //make the top heading a menu bar
         
       JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('View Account').'</small></small>');
       
       JToolBarHelper::cancel();
       parent::display($tpl);
     }
}
