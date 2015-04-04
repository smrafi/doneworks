<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   23 August 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$cat_dumarray = array('cat1', 'cat2', 'cat3', 'cat4', 'cat5', 'cat6');
$type_dumarray = array('type1', 'type2', 'type3', 'type4', 'type5', 'type6', 'type7', 'type8', 'type9', 'type10');

$document =& JFactory::getDocument();
$document->setTitle('Past Medical History');
?>

<form name="socialform" id="socialform" action="<?php echo COMPONENT_FRONT_LINK; ?>" method="post">
    <input type="hidden" name="controller" value="medical" />
    <input type="hidden" name="task" value="pastsurgical" />
    
    <div class="brown_wrapper clearfix">
        <div class="blue_line clearfix">
            <div id="data-form-box" class="clearfix">
                
                    <div id="cat-tab-bar">
                        <ul>
                        <?php
                        $tab_count = 0;
                        foreach($this->cat_list as $cat_id => $cat_name)
                        {
                            if($tab_count == 0)
                            {
                                $addi_class = 'active';
                            }
                            else
                                $addi_class = '';
                            ?>
                            <li id="tab-<?php echo $cat_id; ?>" class="cat-tab <?php echo $addi_class; ?>"><?php echo $cat_name; ?></li>
                        <?php
                        $tab_count++;
                        }
                        ?>
                        </ul>
                    </div>
                    <div id="type-data">
                        <div id="type-data-inner" class="data-tips"></div>
                    </div>
                
            </div>
            <div id="button-box">
                <div id="button-box-inner">
                <table><tr><td>
                    <div id="skip-button">
                        <button type="button" name="skip">Skip</button>
                    </div>
                    </td><td>
                    <div id="back-button">
                        <button type="submit" name="save_back">Save & Go Back</button>
                    </div>
                    </td><td>
                    <div id="proceed-button">
                        <button type="submit" name="save_proceed">Save & Proceed</button>
                    </div>
                                        </td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>
</form>