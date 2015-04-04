<?php

/*************************************************************************************
 *  Developer       : Mohamed Rafi
 *  Developer Email : rafi@archmage.lk
 *  Copyright       : Archmage Software
 *  Product         : Dry Cleans Word Press
 *  Date            : 06 May 2011
 *  Licence         : GNU / GPL
 **************************************************************************************/

class dryCleansAddListing
{
    function dcmdAddList()
    {

        global $wpdb;

        $table_listing = $wpdb->prefix.'bdlisting';
        $table_cats = $wpdb->prefix.'bdcats';
        $table_county = $wpdb->prefix.'bdcounty';

        $cat_query = "Select * From $table_cats Order By cat_name";
        $county_query = "Select * From $table_county Order By county_name";

        $cat_list = $wpdb->get_results($cat_query);
        $county_list = $wpdb->get_results($county_query);

        //create option list
        foreach($cat_list as $cat)
        {
            $cat_option_list .= '<option value="'.$cat->id.'">'.$cat->cat_name.'</option>';
        }

        foreach($county_list as $county)
        {
            $county_option_list .= '<option value="'.$county->id.'">'.$county->county_name.'</option>';
        }


        ?>



<div class="wrap">
    <h2>
        <?php echo 'Add Directory Listing'; ?>
    </h2>
    <form name="dcmd_listingform" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <div id="form-table">
            <table>
                <tr>
                    <td>
                        <?php _e('Company Name:'); ?>
                    </td>
                    <td>
                        <input type="text" name="company_name" id="company_name" size="40" maxlength="100" value="<?php echo $company_name; ?>" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php _e('Address line 1:'); ?>
                    </td>
                    <td>
                        <input type="text" name="addline1" id="addline1" size="60" maxlength="250" value="<?php echo $addline1; ?>" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php _e('Address line 2:'); ?>
                    </td>
                    <td>
                        <input type="text" name="addline2" id="addline2" size="60" maxlength="250" value="<?php echo $addline2; ?>" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php _e('Town:'); ?>
                    </td>
                    <td>
                        <input type="text" name="company_town" id="company_town" size="40" maxlength="100" value="<?php echo $company_town; ?>" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php _e('County:'); ?>
                    </td>
                    <td>
                        <select name="county_cat">
                            <?php echo $county_option_list; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php _e('Telephone:'); ?>
                    </td>
                    <td>
                        <input type="text" name="company_phone" id="company_town" size="40" maxlength="10" value="<?php echo $company_phone; ?>" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php _e('Description:'); ?>
                    </td>
                    <td>
                        <textarea name="company_description" rows="3" cols="40"><?php echo $company_description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php _e('Category:'); ?>
                    </td>
                    <td>
                        <select name="company_cat">
                            <?php echo $cat_option_list; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php _e('Website:'); ?>
                    </td>
                    <td>
                        <input type="text" name="company_website" id="company_website" size="40" maxlength="100" value="<?php echo $company_website; ?>" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php _e('Email:'); ?>
                    </td>
                    <td>
                        <input type="text" name="company_email" id="company_email" size="40" maxlength="100" value="<?php echo $company_email; ?>" />
                    </td>
                </tr>
            </table>
        </div>
        <div class="submit">
            <input type="submit" name="submit" value="<?php  _e('Add Listing');  ?>" />
        </div>
    </form>
</div>

<?php
    }
}

?>
