<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   A plugin to override joomla default component files and joomla core files
 * Date             :   10 August 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.plugin.plugin');


class plgSystemJoomoverride extends JPlugin
{
    public function __construct(& $subject, $config = array())
    {
        define('OVERRIDE', true);
        parent::__construct($subject, $config);
	$this->loadLanguage();
    }
    
    function onAfterInitialise()
    {
        JLoader::register('UsersModelRegistration', dirname(__FILE__).'/com_users/models/registration.php');
        //JLoader::register('UsersController', dirname(__FILE__).'/com_users/controller.php');
    }
}
