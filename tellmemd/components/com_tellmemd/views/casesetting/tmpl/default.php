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

$document =& JFactory::getDocument();
$document->setTitle('Case Settings');

JHTML::_('behavior.tooltip');

$case_num = JRequest::getVar('case_num', '');
$case_type = JRequest::getInt('case_type');

$document =& JFactory::getDocument();
$document->setTitle('Case Settings');

$medium_array = TellMeMDHelper::getMediumArray();
$state_array = TellMeMDHelper::getPriorityArray();

$tip_form = "Form Submit allows you to receive responses from doctors and request for clarifications but they are not live communications. Since the doctor's commitment is lower, so is the suggested price. Note that a full refund is available for this choice if response is unsatisfactory.";
$loreum_tip = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";

?>

<form name="socialform" id="caseform" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post">
    <input type="hidden" name="controller" value="cases" />
    <input type="hidden" name="task" value="confirmation" />
    <input type="hidden" name="case_num" id="case_num" value="<?php echo $case_num; ?>" />
    <input type="hidden" name="case_type" id="case_type" value="<?php echo $case_type; ?>" />
    <input type="hidden" name="suggest_price" id="suggest_price" value="" />
    <input type="hidden" name="max_price" id="max_price" value="" />
    <input type="hidden" name="min_price" id="min_price" value="" />
    
    <div class="brown_wrapper clearfix">
            <div id="data-form-box">
                <div id="data-form-inner" class="clearfix">
                    <div id="left-case-box">
                        <div id="left-box-inner">
                            <div id="medium-box">
                                <div id="medium-box-inner">
                                    <div class="info-label">
                                        Please select the <span>Answer Medium</span> for this case.
                                    </div>
                                    <div class="radio-box clearfix">
                                        <div class="leftside">
                                            <?php echo TellMeMDHelper::createRadio('answer_medium', '', $medium_array); ?>
                                        </div>
                                        <div class="rightside">
                                            <?php echo JHtml::tooltip($tip_form, 'Form Submit', JURI::root().'templates/tellmemd_template/images/tooltip.png' ); ?><br/>
                                            <?php echo JHtml::tooltip($loreum_tip, 'Live Chat Session'); ?><br/>
                                            <?php echo JHtml::tooltip($loreum_tip, 'Skype Call'); ?><br/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="urgency-box">
                                <div id="urgency-box-inner">
                                    <div class="info-label">
                                        Please select the <span>Urgency Level</span> for this case.
                                    </div>
                                    <div class="radio-box clearfix">
                                        <div class="leftside">
                                            <?php echo TellMeMDHelper::createRadio('urgency_level', '', $state_array); ?>
                                        </div>
                                        <div class="rightside">
                                            <?php echo JHtml::tooltip($loreum_tip, 'Lorem Ipsum'); ?><br/>
                                            <?php echo JHtml::tooltip($loreum_tip, 'Lorem Ipsum'); ?><br/>
                                            <?php echo JHtml::tooltip($loreum_tip, 'Lorem Ipsum'); ?><br/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="detail-box">
                                <div id="detail-box-inner">
                                    <div class="info-label">
                                        Please select the <span>Level of Detail</span> for this case.
                                    </div>
                                    <div class="radio-box clearfix">
                                        <div class="leftside">
                                            <?php echo TellMeMDHelper::createRadio('detail_level', '', $state_array); ?>
                                        </div>
                                        <div class="rightside">
                                            <?php echo JHtml::tooltip($loreum_tip, 'Lorem Ipsum'); ?><br/>
                                            <?php echo JHtml::tooltip($loreum_tip, 'Lorem Ipsum'); ?><br/>
                                            <?php echo JHtml::tooltip($loreum_tip, 'Lorem Ipsum'); ?><br/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="right-case-box">
                        <div id="right-case-box-inner">
                            <div id="explain-box">
                                <div id="suggest-price">
                                    <?php echo JHtml::tooltip($loreum_tip, ''); ?>&nbsp;&nbsp;&nbsp;<span>Suggested Price:</span>
                                    <div class="count">
                                    $X
                                    </div>
                                </div>
                                <div id="max-price">
                                    <?php echo JHtml::tooltip($loreum_tip, ''); ?>&nbsp;&nbsp;&nbsp;<span>Maximum Price:</span>
                                    <div class="count">
                                    $X + 20%
                                    </div>
                                </div>
                                <div id="min-price">
                                    <?php echo JHtml::tooltip($loreum_tip, ''); ?>&nbsp;&nbsp;&nbsp;<span>Minimum Price:</span>
                                    <div class="count">
                                    $X - 20%
                                    </div>
                                </div>
                                <div id="price-input">
                                    <div class="contribution">Higher the contribution, higher the case value for the doctors!</div>
                                    <span>Enter Price ($):</span><br/>
                                    <input type="text" name="price_amount" id="price_amount" value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="button-box">
                <div id="button-box-inner">
                    <span id="proceed-button">
                        <button type="submit" name="save_proceed" id="case-proceed">Proceed</button>
                    </span>
                </div>
            </div>
        </div>
    
</form>