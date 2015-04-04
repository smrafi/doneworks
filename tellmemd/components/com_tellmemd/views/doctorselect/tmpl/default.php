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
$document->setTitle('Doctor Selection');

$loreum_tip = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";

?>

<form name="socialform" id="caseform" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post">
    <input type="hidden" name="controller" value="cases" />
    <input type="hidden" name="task" value="doctorselect" />
    
    <div class="brown_wrapper clearfix">
        <div class="blue_line clearfix">
            <div id="data-form-box">
                <div id="data-form-inner" class="clearfix">
                    <div id="doctors-box">
                        <div class="msg-box">
                            <p>
                                This is the final step before your case is submitted!
                            </p>
                        </div>
                        <div class="msg-box-tooltip clearfix">
                        <div class="tool_tip_image">
                            <?php echo JHtml::tooltip($loreum_tip, 'Doctor Selection', JURI::root().'templates/tellmemd_template/images/tooltip.png'); ?>
                        </div>
                        <div class="doc_select_descrip">    
                            <p>
                                If you have a favorite doctor, select below from the doctors currently online in the category you assigned for this case. If your doctor is not currently online or you don't really have a doctor in mind, then just leave the default selection and press the Done button.
                            </p>
                            </div>
                        </div>
                        <div class="msg-box">
                            <p>
                                To understand more about requesting for a new doctor and it's deadline or any other help topics, please <a class="link" href="javscript:void(0);">click here</a>.
                            </p>
                        </div>
                        <div id="doctor-select">
                            <table id="docselect-table" width="100%">
                                <tr>
                                    <td>
                                        <div class="docimage">
                                            <img src="<?php echo JURI::root().'components/com_tellmemd/assets/image/doc_any.jpg'; ?>" />
                                        </div>
                                        <div class="docradio">
                                            <input type="radio" name="mydoctor" value="1" /><span>Any Doctor</span>
                                        </div>
                                    </td>
                                    <?php
                                    $count = 1;
                                    $total = count($this->doctor_data);
                                    if($total != 0)
                                    {
                                        foreach($this->doctor_data as $doctor)
                                        {
                                            if($count % 3 == 0)
                                                echo '<tr>';
                                            ?>
                                    <td>
                                        <div class="docimage">
                                            <img src="<?php echo JURI::root().'components/com_tellmemd/assets/image/doc_dummy.jpg'; ?>" />
                                        </div>
                                        <div class="docradio">
                                            <input type="radio" name="mydoctor" value="<?php echo $doctor->user_id; ?>" /><span>Dr. <?php echo $doctor->first_name.' '.$doctor->last_name; ?></span>
                                        </div>
                                    </td>
                                    <?php
                                            if($count % 3 == 2)
                                                echo '</tr>';
                                            $count++;
                                        }
                                    }
                                    ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="button-box">
                <div id="button-box-inner">
                    <span id="proceed-button">
                        <button type="submit" name="confim">Done</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</form>