<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   30 December 2011
 * ***************************************************************************** */


defined( '_JEXEC' ) or die( 'Restricted access' );
$editor =& JFactory::getEditor();
$editor->initialise();
//print_r($editor);
echo $editor->display('letter_content', $this->letter_data->template_content, 550, 400, 70, 10);

?>
