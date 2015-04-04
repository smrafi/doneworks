<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   25 August 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::_('behavior.tooltip');

$document =& JFactory::getDocument();
$document->setTitle('Confirmation');

$medium_array = TellMeMDHelper::getMediumArray();
$state_array = TellMeMDHelper::getPriorityArray();

?>

<form name="confirmationform" id="confirmationform" action="<?php echo $this->confirm_data->paypal_url; ?>" method="post">
    <?php echo $this->html_data; ?>
    
    <div class="brown_wrapper clearfix">
        <div class="blue_line clearfix">
            <div id="data-form-box">
                <div id="data-form-inner" class="clearfix">
                    <div id="confirmation-box">
                        <div id="confirm-msg">
                            <p>
                                You have selected the below options and chose to contribute the below amount for this case. If you're happy with this, please Confirm to make a PayPal payment, otherwise you can always go back via the Go Back button to make any changes.
                            </p>
                        </div>
                        <div id="detail-summary">
                            <table id="summary-table" align="center">
                                <tr>
                                    <td class="topic">Answer Medium:</td>
                                    <td class="details"><?php echo $medium_array[$this->confirm_data->answer_medium]; ?></td>
                                </tr>
                                <tr>
                                    <td class="topic">Urgency Level:</td>
                                    <td class="details"><?php echo $state_array[$this->confirm_data->urgency_level]; ?></td>
                                </tr>
                                <tr>
                                    <td class="topic">Level of Detail:</td>
                                    <td class="details"><?php echo $state_array[$this->confirm_data->detail_level]; ?></td>
                                </tr>
                                <tr>
                                    <td class="topic">Payment Amount:</td>
                                    <td class="details"><?php echo '$'.$this->confirm_data->price_amount; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="button-box">
                <div id="button-box-inner">
                    <span id="skip-button">
                        <button type="button" name="go_back">Go Back</button>
                        <input type="hidden" name="payment_id" id="payment_id" value="<?php echo $this->confirm_data->payment_id; ?>" />
                        <input type="hidden" name="case_num" id="case_num" value="<?php echo $this->confirm_data->case_num; ?>" />
                        <input type="hidden" name="case_type" id="case_type" value="<?php echo $this->confirm_data->case_type; ?>" />
                    </span>
                    <span id="proceed-button">
                        <button type="submit" name="confim">Confirm</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
</form>