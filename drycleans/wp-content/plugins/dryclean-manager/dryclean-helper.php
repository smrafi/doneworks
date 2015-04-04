<?php

/*************************************************************************************
 *  Developer       : Mohamed Rafi
 *  Developer Email : rafi@archmage.lk
 *  Copyright       : Archmage Software
 *  Product         : Dry Cleans Word Press
 *  Date            : 11 May 2011
 *  Licence         : GNU / GPL
 **************************************************************************************/


define('MD_SERVICE_DIR_NAME', 'Service Directory');
define('MD_BUSINESS_DIR_NAME', 'Business Directory');
define('MD_SERVICE_DIR_NUM', 1);
define('MD_BUSINESS_DIR_NUM', 2);
class mdHelper
{

    /**
     * This function will create a drop down list.
     * @param string $name
     * @param array $data
     * @param int $data
     * @param string $optional
     * @return string 
     */

    function createList($name, $data, $select_id, $optional='')
    {
        if($name == '')
            return FALSE;

        $list_html = '<select name="'.$name.'" id="'.$name.'" ';

        if($optional)
            $list_html .= $optional;

        $list_html .= ' > ';

        if($data == '')
            return FALSE;

        foreach ($data as $key => $value)
        {
            if($select_id == $key)
                $selected = 'selected="selected"';
            else
                $selected = '';

            $list_html .= '<option value="'.$key.'" '.$selected.' >'.$value.'</option> ';
        }

        $list_html .= '</select>';
        

        return $list_html;

    }

}

?>
