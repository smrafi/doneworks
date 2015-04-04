<?php

/* * *****************************************************************************
 * Developer        :   Meril Clinton
 * Developer Email  :   mrlclinton@gmail.com
 * Copyright        :   Maadya Digitel.
 * Licence          :   Deifined/Closed
 * Prduct           :   President Fund Process
 * Date             :   19 Dec 2011
 * ***************************************************************************** */

defined( '_JEXEC' ) or die( 'Restricted access' );

$contact_office = PFundHelper::getOfficeType(JText::_('Select a type'));

if($this->contact_data->id == 0)
    echo '<h1>New Contact</h1>';
else
    echo '<h1>Edit contact</h1>';

?>

<div class="comp-button">
    
    <button type="button" name="apply_btn" class="apply_btn">Apply</button>
    <button type="button" name="save_btn" class="save_btn">Save</button>
    <button type="button" name="cancel_btn" class="cancel_btn">Back</button>
    
</div>
<div class="comp-content">
<form  action="index.php" method="post" name="adminForm" class="submit-form">
    <input type="hidden" name="option" value="<?php echo OPTION_NAME; ?>" />
    <input type="hidden" name="task" id="task" value="" />
    <input type="hidden" name="controller" value="contact" />
    <input type="hidden" name="id" value="<?php echo $this->contact_data->id; ?>" />
    
    <table>
        <tr>
            <td>
                Publish
            </td>
            <td>
               <?php echo PFundHelper::createCheckBox('published', $this->contact_data->published, 1); ?>
            </td>
        </tr>
        <tr>
            <td>
                Contact Type
            </td>
            <td>
                <?php  echo PFundHelper::createList('contact_office', (int)$this->contact_data->contact_office, $contact_office ); ?>
            </td>
        </tr>
        <tr>
            <td width="30%">
                Contact Name
            </td>
            <td>
                <input type="text" name="contact_name" id="contact_name" value="<?php echo $this->contact_data->contact_name; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                Address
            </td>
            <td>
                <textarea name="address" id="address" cols="35" rows="5"><?php echo $this->contact_data->address; ?></textarea>
            </td>
        </tr>
        
        <tr>
            <td>
                Email
            </td>
            <td>
                <input type="text" name="email" id="email" value="<?php echo $this->contact_data->email; ?>" size="50" />
            </td>
        </tr>
        <tr>
            <td>
                Phone
            </td>
            <td>
                <input type="text" name="phone" id="phone" value="<?php echo $this->contact_data->phone; ?>" size="50" />
            </td>
        </tr>
    </table>
    
</form>
</div>