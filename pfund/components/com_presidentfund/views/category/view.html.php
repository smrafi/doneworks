<?php

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.html');

class PFundViewCategory  extends JView

{
     function display($tpl = null) 
    {
         
       parent::display($tpl);
     }
}
