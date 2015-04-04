<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   26 July 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class TellMeMdControllerWebsite extends JController
{
    function __construct() 
    {
        parent::__construct();
        $this->registerTask('apply', 'save');
    }
    
    function display()
    {
        $view = $this->getView('settinglist', 'html');
        $view->display();
    }
    
    function siteset()
    {
        $view = $this->getView('coresettings', 'html');
        $view->display();
    }
}
