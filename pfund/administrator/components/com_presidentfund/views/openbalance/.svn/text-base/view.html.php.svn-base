<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Jazeer
 * Developer Email  :   jazeermim@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   08 December 2011
 * ***************************************************************************** */


//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');

class PFundViewOpenbalance  extends JView

{
    function display($tpl = null) 
    {
       //make the top heading a menu bar
       JToolBarHelper::title(COMPONENT_NAME.': <small><small>'.JText::_('Opening Balance').'</small></small>');
 
       JToolBarHelper::apply('applyopenbalance');
       JToolBarHelper::save('saveopenbalance');
       JToolBarHelper::cancel();
       parent::display($tpl);
    }
}
