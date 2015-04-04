<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafiitfac@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Defined/Closed
 * Prduct           :   President Fund Process
 * Date             :   21 December 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

JHTML::_('behavior.modal');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

$app_id = JRequest::getInt('app_id');
$pnum = JRequest::getInt('pnum');
$app_type = JRequest::getInt('app_type');
$status_array = PFundHelper::getStatusArray();
$common_status = PFundHelper::getCommonStatus();
$amount_type = PFundHelper::getAmountTypeList('Select a type');

//if amount type is not selected yet we are going to show it as zero
if($this->manage_data->amount_type == '')
    $this->manage_data->amount_type = 0;

//if the value of grant amount is zero, we show it as empty
if($this->manage_data->grant_amount == 0)
    $this->manage_data->grant_amount = '';

if(!$app_id)
    $application->redirect(JRoute::_(COMPONENT_LINK.'&controller=application'), 'Couldn\'t reach the link you were trying.', 'error');

?>

<h1>Process Application <?php echo '&nbsp;&nbsp;'.$pnum; ?></h1>
<div class="comp-button">
    <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="back_btn" class="back_btn">Back</button>
</div>
<div class="comp-content">
    <form class="submit-form" action="index.php" method="post" name="adminForm">
        <input type="hidden" name="option" value="<?php echo OPTION_NAME ; ?>" />
        <input type="hidden" name="task" id="task" value="" />
        <input type="hidden" name="controller" value="manageapp" />
        <input type="hidden" name="id" value="<?php echo $this->manage_data->id; ?>" />
        <input type="hidden" name="app_id" value="<?php echo $this->manage_data->application_id; ?>" />
        <input type="hidden" name="pnum" value="<?php echo $pnum; ?>" />
        <input type="hidden" name="app_type" id="app_type" value="<?php echo $app_type; ?>" />
        
        <table>
            <tr>
                <td>Application Status</td>
                <td>
                    <?php echo PFundHelper::createList('status', (int)$this->manage_data->status, $status_array); ?>
                </td>
            </tr>
            <tr>
                <td>View Application</td>
                <td>
                    <a class="modal"  rel="{handler: 'iframe', size: {x: 800, y: 500}}" href=<?php echo COMPONENT_LINK.'&controller=application&task=edit&cid='.$this->manage_data->application_id.'&tmpl=component&action=view';  ?> >
                        <?php echo 'View Application'; ?>
                    </a>
                </td>
            </tr>
            <tr>
                <td>Application Action</td>
                <td>
                    <?php echo JHtml::link(COMPONENT_LINK.'&controller=application&task=edit&cid='.$this->manage_data->application_id, 'Edit Application') ?>
                </td>
            </tr>
            <tr>
                <td>DS Office Response</td>
                <td>
                    <?php echo $common_status[$this->manage_data->dsoffice_status]; ?>
                    <input type="hidden" name="dsoffice_status" id="dsoffice_status" value="<?php echo $this->manage_data->dsoffice_status; ?>" />
                </td>
            </tr>
            <tr>
                <td>Health Ministry Response</td>
                <td>
                    <?php echo $common_status[$this->manage_data->healthministry_status]; ?>
                    <input type="hidden" name="healthministry_status" id="healthministry_status" value="<?php echo $this->manage_data->healthministry_status; ?>" />
                </td>
            </tr>
            <tr>
                <td>Medical Condition Category</td>
                <td id="cat-list">
                    <?php echo PFundHelper::createList('cat_id', (int)$this->manage_data->cat_id, $this->cat_array, 0, 'catid-select'); ?>
                </td>
            </tr>
            <tr>
                <td>Medical Condition</td>
                <td id="disease_list">
                    <?php echo PFundHelper::createList('disease_id', (int)$this->manage_data->disease_id, $this->disease_array); ?>
                </td>
            </tr>
            <tr>
                <td>Grant Amount Type</td>
                <td>
                    <?php echo PFundHelper::createList('amount_type', $this->manage_data->amount_type, $amount_type); ?>
                </td>
            </tr>
            <tr>
                <td>Grant Amount</td>
                <td>
                    <input type="text" name="grant_amount" id="grant_amount" value="<?php echo $this->manage_data->grant_amount; ?>" />
                </td>
            </tr>
            <tr>
                <td>Application Note</td>
                <td>
                    <textarea name="app_note" id="app_note" rows="5" cols="35"></textarea>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php
if(!empty ($this->application_notes))
{
    $count = 1;
    ?>
<div class="notes-table">
    <table class="adminlist">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Date</th>
                <th>Application Note</th>
                <th>Marked User</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($this->application_notes as $app_note)
        {
            $user =& JFactory::getUser($app_note->user_id);
            ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td>
                <?php echo date('d-m-Y  H:i:s', strtotime($app_note->added_time)); ?>
            </td>
            <td>
                <?php echo $app_note->application_note; ?>
            </td>
            <td>
                <?php echo $user->name; ?>
            </td>
        </tr>
        <?php
        $count++;
        }
        ?>
        </tbody>
    </table>
</div>
<?php
}
?>
