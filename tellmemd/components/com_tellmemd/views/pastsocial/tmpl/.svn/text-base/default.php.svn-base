<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   19 August 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//make a years array
$years_array = TellMeMDGeneralHelper::getYearsArray();

//crate a pack array
$pack_array = TellMeMDGeneralHelper::getPackArray();

//not to say array
$nottosay_array = array(OPTION_NOT_TO_SAY => 'Prefer not to say');
$never_array = array(OPTION_NEVER => 'Never');
$quit_array = array(OPTION_QUIT => 'Quit');
$yes_array = array(OPTION_YES => 'Yes');
$occational_array = array(OPTION_OCCATIONALLY => 'Occationaly');
$frequent_array = array(OPTION_FREQUENT => 'Frequent');
$none_array = array(OPTION_NONE => 'None');
$previous_array = array(OPTION_PREVIOUS => 'Previous');
$drugs_array = TellMeMDGeneralHelper::getDrugsArray();

$document =& JFactory::getDocument();
$document->setTitle('Past Social History');

?>

<form name="socialform" id="socialform" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post">
    <input type="hidden" name="controller" value="medical" />
    <input type="hidden" name="task" value="medication" />
    
    <div class="brown_wrapper clearfix">
            <div id="data-form-box">
                <div id="data-form-inner-dummy" class="clearfix">
                    <div id="left-social-box">
                        <div id="left-box-inner">
                            <div id="smoking-box" class="clearfix">
                                <h3>Smoking</h3>
                                <div class="radio-box smoke-single">
                                    <?php echo TellMeMDHelper::createRadio('smoking_status', $this->social_data->smoking_status, $nottosay_array); ?>
                                </div>
                                <div class="radio-box smoke-single">
                                    <?php echo TellMeMDHelper::createRadio('smoking_status', $this->social_data->smoking_status, $never_array); ?>
                                </div>
                                <div class="radio-box" id="smoke-quit">
                                    <?php echo TellMeMDHelper::createRadio('smoking_status', $this->social_data->smoking_status, $quit_array); ?>
                                    <div class="radio-inner-wrapper">
                                        <div class="radio-inner-left">
                                            <h4>How long ago?</h4>
                                            <?php echo TellMeMDHelper::createRadio('quit_smoke_timeago', $this->social_data->quit_smoke_timeago, $years_array); ?>
                                        </div>
                                        <div class="radio-inner-right">
                                            <h4>Duration of smoking?</h4>
                                            <?php echo TellMeMDHelper::createRadio('quit_smoke_duration', $this->social_data->quit_smoke_duration, $years_array); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="radio-box" id="smoke-yes">
                                    <?php echo TellMeMDHelper::createRadio('smoking_status', $this->social_data->smoking_status, $yes_array); ?>
                                    <div class="radio-inner-wrapper">
                                        <div class="radio-inner-left">
                                            <h4>Average packs per day?</h4>
                                            <?php echo TellMeMDHelper::createRadio('yes_packpd', $this->social_data->yes_packpd, $pack_array); ?>
                                        </div>
                                        <div class="radio-inner-right">
                                            <h4>Duration of smoking?</h4>
                                            <?php echo TellMeMDHelper::createRadio('yes_smoke_duration', $this->social_data->yes_smoke_duration, $years_array); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="right-social-box">
                        <div id="right-box-inner">
                            <div id="alchohol-box">
                                <h3>Alcohol</h3>
                                <div class="radio-box">
                                    <?php echo TellMeMDHelper::createRadio('alchohol_status', $this->social_data->alchohol_status, $nottosay_array); ?>
                                </div>
                                <div class="radio-box">
                                    <?php echo TellMeMDHelper::createRadio('alchohol_status', $this->social_data->alchohol_status, $never_array); ?>
                                </div>
                                <div class="radio-box">
                                    <?php echo TellMeMDHelper::createRadio('alchohol_status', $this->social_data->alchohol_status, $occational_array); ?>
                                </div>
                                <div class="radio-box">
                                    <?php echo TellMeMDHelper::createRadio('alchohol_status', $this->social_data->alchohol_status, $frequent_array); ?>
                                </div>
                            </div>
                            <div id="drug-box">
                                <h3>Drug Use</h3>
                                <div class="radio-box drug-single">
                                    <?php echo TellMeMDHelper::createRadio('drug_usage', $this->social_data->drug_usage, $nottosay_array); ?>
                                </div>
                                <div class="radio-box drug-single">
                                    <?php echo TellMeMDHelper::createRadio('drug_usage', $this->social_data->drug_usage, $none_array); ?>
                                </div>
                                <div class="radio-box drug-single">
                                    <?php echo TellMeMDHelper::createRadio('drug_usage', $this->social_data->drug_usage, $previous_array); ?>
                                </div>
                                <div class="radio-box drug-yes">
                                    <?php echo TellMeMDHelper::createRadio('drug_usage', $this->social_data->drug_usage, $yes_array); ?>
                                    <div class="radio-inner-wrapper">
                                        <h4>Type:</h4>
                                        <div class="inner-checkbox">
                                            <?php
                                            foreach($drugs_array as $value => $name)
                                                echo TellMeMDHelper::createCheckBox('drug_type[]', 0, $value, $name, '', TRUE).'<br/>';
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="button-box">
                <div id="button-box-inner">
                    <span id="skip-button">
                        <button type="button" name="skip">Skip</button>
                    </span>
                    <span id="proceed-button">
                        <button type="submit" name="save_proceed">Save & Proceed</button>
                    </span>
                </div>
            </div>
        </div>
    
</form>