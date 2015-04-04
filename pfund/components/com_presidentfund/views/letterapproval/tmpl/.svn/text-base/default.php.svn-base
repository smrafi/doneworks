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

JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

$document =& JFactory::getDocument();
$document->addStyleSheet(JURI::root().'components/com_presidentfund/assets/styles/print.css', '', 'print');

$controller = JRequest::getVar('rtcontroller');
$letter_id = JRequest::getInt('cid');

$print_link = COMPONENT_LINK.'&controller=letter&task=printletter&letter_id='.$letter_id.'&tmpl=component';

?>
<div class="comp-button">
    <button type="button" name="spback_btn" class="spback_btn" onclick="routeback('<?php echo $controller; ?>', 'backletterreview');">Back</button>
    <button type="button" name="sp_btn" class="sp_btn" onclick="routeback('letter', 'digitalsign');">Digitally Sign</button>
    <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 500}}" href="<?php echo $print_link;  ?>">
        <button type="button" name="sp_btn" class="sp_btn">Manually Sign</button>
    </a>
</div>
<div class="comp-print">
    <form class="submit-form" action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" id="task" value="" />
        <input type="hidden" name="controller" id="controller" value="letter" />
        <input type="hidden" name="rtcontroller" value="<?php echo $controller; ?>" />
        <input type="hidden" name="letter_id" value="<?php echo $letter_id; ?>" />
        
        <div id="letter-content">
            <?php echo $this->letter_data->letter_content; ?>
        </div>
    </form>
    
</div>