<?php

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');

class PFundViewContact  extends JView

{
     function display($tpl = null) 
    {
       
       //make the top heading a menu bar
       if($this->contact_data->id)
              JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('Edit Contact').'</small></small>');
       else
              JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('New Contact').'</small></small>');

       JToolBarHelper::apply();
       JToolBarHelper::save2new();
       JToolBarHelper::save();
       JToolBarHelper::cancel();
       parent::display($tpl);
     }
}
