<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   23 September 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

?>
<table id="tips-table" width="100%">
    <?php
    
    $count = 0;
    $total = count($this->condition_list);
    foreach($this->condition_list as $condition)
    {
        if($count % 4 == 0)
            echo '<tr>';
        echo '<td>';
        echo TellMeMDHelper::createCheckBox('medical_type[]', 0, $condition->id, $condition->condition_name, '', TRUE);
        echo '</td>';
        if($count % 4 == 3 || $count == $total)
            echo '</tr>';
        $count++;
    }
    
    ?>
</table>