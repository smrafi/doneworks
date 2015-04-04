<?php
/**
 * @package XpertScroller
 * @version 2.2
 * @author ThemeXpert http://www.themexpert.com
 * @copyright Copyright (C) 2009 - 2011 ThemeXpert
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted accessd');
$index=0;
?>
<!--ThemeXpert: XpertScroller module version 2.0 Start here-->


<div class="<?php echo $moduleId;?> <?php echo $params->get('moduleclass_sfx');?> <?php echo $params->get('scroller_layout');?>">
    <?php if($params->get('navigator')):?>
    <!-- wrapper for navigator elements -->
    <div class="navi"></div>
    <?php endif;?>
    <div class="scroller_wrapper clearfix">
        <div class="nav_right"><a class="next browse right"></a></div>
       <div id="<?php echo $moduleId;?>" class="scroller">

        <div class="items">
        <?php for($i = 0; $i<$totalPane; $i++){?>
            <div class="pane">
                
            <?php for($col=0; $col<(int)$params->get('col_amount'); $col++, $index++) {?>
                <?php if($index>=count($items)) break;?>
                <?php //$link = "index.php?option=com_brandboodle&controller=domainpages&view=domainpage&cid=".$items[$index]->id; ?>
                <div class="item">
                    <div class="item_wrapper">
					<div class="image"><img height="140px" width="192px" src="<?php echo JURI::root(); ?>templates/tellmemd_template/images/dummy_doctor.jpg"></div>
                    <div class="details clearfix"><span class="name"><?php echo ($items[$index]->name) ?></span> <span class="percentage">89%</span></div>
                    <div class="description">Qualified Medical Doctor, Ph.D, FRCP, Director of...</div>
                    <div class="ask_question">Ask Question >></div>
                        
                    </div>
                </div>
                <?php if($col == (int)$params->get('col_amount') ){$col=0; break;} ?>
            <?php } ?>
            </div>
        <?php }?>
            
        </div>

    </div>
       <div class="nav_left"><a class="prev browse left"></a></div>
    </div>
</div>


<!--ThemeXpert: XpertScroller module version 2.0 End Here-->