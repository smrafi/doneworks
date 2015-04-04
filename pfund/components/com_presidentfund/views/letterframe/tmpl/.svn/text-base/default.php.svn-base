<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   09 January 2012
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

$document =& JFactory::getDocument();
$document->addStyleSheet(JURI::root().'components/com_presidentfund/assets/styles/print.css', '', 'print');

if($this->letter_data->letter_title)
    $document->setTitle($this->letter_data->letter_title);

$task = '';
$controller = '';

?>
<div class="comp-button">
    <?php
    if($this->drive_data)
    {
        $task = $this->drive_data->task;
        $controller = $this->drive_data->controller;
        echo '<button type="button" name="dummy_btn" class="dummy_btn">Back</button>';
    }
    ?>
    <button type="button" name="print_btn" class="print_btn">Print</button>
</div>
<div class="comp-print">
    <form class="submit-form" action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" id="task" value="<?php echo $task ; ?>" />
        <input type="hidden" name="controller" value="<?php echo $controller; ?>" />
        
        <div id="letter-content">
            <?php echo $this->letter_data->letter_content; ?>
        </div>
    </form>
    
</div>