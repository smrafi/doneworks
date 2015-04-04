<?php

/* * *****************************************************************************
 * Developer        :   Mohamed Rafi
 * Developer Email  :   rafi@archmage.lk, rafiitfac@gmail.com
 * Copyright        :   Archmage Software.
 * Licence          :   GNU/GPL
 * Prduct           :   TellMeMD - Medical Question and Answer System
 * Date             :   25 July 2011
 * ***************************************************************************** */

//give no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//defines constant variables that we are going to use entire site - back end
define('COMPONENT_NAME', 'TellmeMD.com');
define('OPTIOIN_NAME', 'com_tellmemd');
define('COMPONENT_LINK', 'index.php?option='.OPTIOIN_NAME);
define('COMPONENT_FRONT_LINK', JURI::root().'index.php/component/tellmemd/');
define('TABLE_PREFIX', '#__com_tmd_');

//define the user types
define('USER_TYPE_PATIENT', 1);
define('USER_TYPE_DOCTOR', 2);

//define report submit type
define('PATIENT_MEDICAL_INFO_LATER', 1);
define('PATIENT_MEDICAL_INFO_NOW', 2);

/*
 * List of constant variables for front end
 */

//define type of the cases
define('CASE_TYPE_QUEANS', 1);
define('CASE_TYPE_LABTEST', 2);

//Answer medium type
define('MEDIUM_TYPE_FORM_SUBMIT', 1);
define('MEDIUM_TYPE_LIVE_CHAT', 2);
define('MEDIUM_TYPE_SKYPE', 3);

//Priority levels
define('PRIORITY_TYPE_LOW', 1);
define('PRIORITY_TYPE_MEDIUM', 2);
define('PRIORITY_TYPE_HIGH', 3);

//medical history options
define('OPTION_NOT_TO_SAY', 1);
define('OPTION_NEVER', 2);
define('OPTION_QUIT', 3);
define('OPTION_YES', 4);
define('OPTION_OCCATIONALLY', 5);
define('OPTION_FREQUENT', 6);
define('OPTION_NONE', 7);
define('OPTION_PREVIOUS', 8);

//some common values most of the time use
define('OPTION_OTHER', 100);

//Define payment types
define('PAYMENT_NOT_PROCESSED', 0);
define('PAYMENT_COOMPLETED', 1);
define('PAYMENT_PENDING', 2);
define('PAYMENT_FAILED', 3);

//Define cases status
define('CASE_STATUS_OPEN', 1);
define('CASE_STATUS_SENT', 2);
define('CASE_STATUS_ACCEPTED', 3);
define('CASE_STATUS_INFO', 4);
define('CASE_STATUS_ANSWERED', 5);
define('CASE_STATUS_REOPEN', 6);
define('CASE_STATUS_SOLVED', 7);
define('CASE_STATUS_REVIEW', 8);
define('CASE_STATUS_CLOSED', 9);
define('CASE_STATUS_FAILED', 10);
define('CASE_STATUS_REFUNDED', 11);

//dead line passed status
define('CASE_DEADLINE_NOT_PASSED', 0);
define('CASE_DEADLINE_PASSED', 1);

//define case view types
define('CASE_VIEW_TYPE_PATIENT', 1);
define('CASE_VIEW_TYPE_DOCTOR', 2);
define('CASE_VIEW_TYPE_POOL', 3);

//dispute types
define('CASE_DISPUTE_REVIEW', 1);
define('CASE_DISPUTE_REJECT', 2);
define('CASE_DISPUTE_REFUND', 3);

//dispute status types
define('CASE_DISPUTE_STATUS_NEW', 1);
define('CASE_DISPUTE_STATUS_OPEN', 2);
define('CASE_DISPUTE_STATUS_CLOSE', 3);

//Patient Refund type
define('CASE_REFUND_HALF', 1);
define('CASE_REFUND_FULL', 2);

//Email Sent status type
define('EMAIL_SENT', 1);
define('EMAIL_NOT_SENT', 2); 

class TellMeMDGeneralHelper
{
    var $countries = array();
    
    function getCountryArray()
    {
        $this->countries = array(
        0 =>    "Select a country",
	"AF" => "Afghanistan",
	"AX" => "Åland Islands",
	"AL" => "Albania",
	"DZ" => "Algeria",
	"AS" => "American Samoa",
	"AD" => "Andorra",
	"AO" => "Angola",
	"AI" => "Anguilla",
	"AQ" => "Antarctica",
	"AG" => "Antigua And Barbuda",
	"AR" => "Argentina",
	"AM" => "Armenia",
	"AW" => "Aruba",
	"AU" => "Australia",
	"AT" => "Austria",
	"AZ" => "Azerbaijan",
	"BS" => "Bahamas",
	"BH" => "Bahrain",
	"BD" => "Bangladesh",
	"BB" => "Barbados",
	"BY" => "Belarus",
	"BE" => "Belgium",
	"BZ" => "Belize",
	"BJ" => "Benin",
	"BM" => "Bermuda",
	"BT" => "Bhutan",
	"BO" => "Bolivia",
	"BA" => "Bosnia And Herzegovina",
	"BW" => "Botswana",
	"BV" => "Bouvet Island",
	"BR" => "Brazil",
	"IO" => "British Indian Ocean Territory",
	"BN" => "Brunei Darussalam",
	"BG" => "Bulgaria",
	"BF" => "Burkina Faso",
	"BI" => "Burundi",
	"KH" => "Cambodia",
	"CM" => "Cameroon",
	"CA" => "Canada",
	"CV" => "Cape Verde",
	"KY" => "Cayman Islands",
	"CF" => "Central African Republic",
	"TD" => "Chad",
	"CL" => "Chile",
	"CN" => "China",
	"CX" => "Christmas Island",
	"CC" => "Cocos (Keeling) Islands",
	"CO" => "Colombia",
	"KM" => "Comoros",
	"CG" => "Congo",
	"CD" => "Congo, The Democratic Republic Of The",
	"CK" => "Cook Islands",
	"CR" => "Costa Rica",
	"CI" => "Cote D'ivoire",
	"HR" => "Croatia",
	"CU" => "Cuba",
	"CY" => "Cyprus",
	"CZ" => "Czech Republic",
	"DK" => "Denmark",
	"DJ" => "Djibouti",
	"DM" => "Dominica",
	"DO" => "Dominican Republic",
	"EC" => "Ecuador",
	"EG" => "Egypt",
	"SV" => "El Salvador",
	"GQ" => "Equatorial Guinea",
	"ER" => "Eritrea",
	"EE" => "Estonia",
	"ET" => "Ethiopia",
	"FK" => "Falkland Islands (Malvinas)",
	"FO" => "Faroe Islands",
	"FJ" => "Fiji",
	"FI" => "Finland",
	"FR" => "France",
	"GF" => "French Guiana",
	"PF" => "French Polynesia",
	"TF" => "French Southern Territories",
	"GA" => "Gabon",
	"GM" => "Gambia",
	"GE" => "Georgia",
	"DE" => "Germany",
	"GH" => "Ghana",
	"GI" => "Gibraltar",
	"GR" => "Greece",
	"GL" => "Greenland",
	"GD" => "Grenada",
	"GP" => "Guadeloupe",
	"GU" => "Guam",
	"GT" => "Guatemala",
	"GG" => "Guernsey",
	"GN" => "Guinea",
	"GW" => "Guinea-Bissau",
	"GY" => "Guyana",
	"HT" => "Haiti",
	"HM" => "Heard Island And Mcdonald Islands",
	"VA" => "Holy See (Vatican City State)",
	"HN" => "Honduras",
	"HK" => "Hong Kong",
	"HU" => "Hungary",
	"IS" => "Iceland",
	"IN" => "India",
	"ID" => "Indonesia",
	"IR" => "Iran, Islamic Republic Of",
	"IQ" => "Iraq",
	"IE" => "Ireland",
	"IM" => "Isle Of Man",
	"IL" => "Israel",
	"IT" => "Italy",
	"JM" => "Jamaica",
	"JP" => "Japan",
	"JE" => "Jersey",
	"JO" => "Jordan",
	"KZ" => "Kazakhstan",
	"KE" => "Kenya",
	"KI" => "Kiribati",
	"KP" => "Korea, Democratic People's Republic Of",
	"KR" => "Korea, Republic Of",
	"KW" => "Kuwait",
	"KG" => "Kyrgyzstan",
	"LA" => "Lao People's Democratic Republic",
	"LV" => "Latvia",
	"LB" => "Lebanon",
	"LS" => "Lesotho",
	"LR" => "Liberia",
	"LY" => "Libyan Arab Jamahiriya",
	"LI" => "Liechtenstein",
	"LT" => "Lithuania",
	"LU" => "Luxembourg",
	"MO" => "Macao",
	"MK" => "Macedonia, The Former Yugoslav Republic Of",
	"MG" => "Madagascar",
	"MW" => "Malawi",
	"MY" => "Malaysia",
	"MV" => "Maldives",
	"ML" => "Mali",
	"MT" => "Malta",
	"MH" => "Marshall Islands",
	"MQ" => "Martinique",
	"MR" => "Mauritania",
	"MU" => "Mauritius",
	"YT" => "Mayotte",
	"MX" => "Mexico",
	"FM" => "Micronesia, Federated States Of",
	"MD" => "Moldova, Republic Of",
	"MC" => "Monaco",
	"MN" => "Mongolia",
	"MS" => "Montserrat",
	"MA" => "Morocco",
	"MZ" => "Mozambique",
	"MM" => "Myanmar",
	"NA" => "Namibia",
	"NR" => "Nauru",
	"NP" => "Nepal",
	"NL" => "Netherlands",
	"AN" => "Netherlands Antilles",
	"NC" => "New Caledonia",
	"NZ" => "New Zealand",
	"NI" => "Nicaragua",
	"NE" => "Niger",
	"NG" => "Nigeria",
	"NU" => "Niue",
	"NF" => "Norfolk Island",
	"MP" => "Northern Mariana Islands",
	"NO" => "Norway",
	"OM" => "Oman",
	"PK" => "Pakistan",
	"PW" => "Palau",
	"PS" => "Palestinian Territory, Occupied",
	"PA" => "Panama",
	"PG" => "Papua New Guinea",
	"PY" => "Paraguay",
	"PE" => "Peru",
	"PH" => "Philippines",
	"PN" => "Pitcairn",
	"PL" => "Poland",
	"PT" => "Portugal",
	"PR" => "Puerto Rico",
	"QA" => "Qatar",
	"RE" => "Reunion",
	"RO" => "Romania",
	"RU" => "Russian Federation",
	"RW" => "Rwanda",
	"SH" => "Saint Helena",
	"KN" => "Saint Kitts And Nevis",
	"LC" => "Saint Lucia",
	"PM" => "Saint Pierre And Miquelon",
	"VC" => "Saint Vincent And The Grenadines",
	"WS" => "Samoa",
	"SM" => "San Marino",
	"ST" => "Sao Tome And Principe",
	"SA" => "Saudi Arabia",
	"SN" => "Senegal",
	"CS" => "Serbia And Montenegro",
	"SC" => "Seychelles",
	"SL" => "Sierra Leone",
	"SG" => "Singapore",
	"SK" => "Slovakia",
	"SI" => "Slovenia",
	"SB" => "Solomon Islands",
	"SO" => "Somalia",
	"ZA" => "South Africa",
	"GS" => "South Georgia And The South Sandwich Islands",
	"ES" => "Spain",
	"LK" => "Sri Lanka",
	"SD" => "Sudan",
	"SR" => "Suriname",
	"SJ" => "Svalbard And Jan Mayen",
	"SZ" => "Swaziland",
	"SE" => "Sweden",
	"CH" => "Switzerland",
	"SY" => "Syrian Arab Republic",
	"TW" => "Taiwan, Province Of China",
	"TJ" => "Tajikistan",
	"TZ" => "Tanzania, United Republic Of",
	"TH" => "Thailand",
	"TL" => "Timor-Leste",
	"TG" => "Togo",
	"TK" => "Tokelau",
	"TO" => "Tonga",
	"TT" => "Trinidad And Tobago",
	"TN" => "Tunisia",
	"TR" => "Turkey",
	"TM" => "Turkmenistan",
	"TC" => "Turks And Caicos Islands",
	"TV" => "Tuvalu",
	"UG" => "Uganda",
	"UA" => "Ukraine",
	"AE" => "United Arab Emirates",
	"GB" => "United Kingdom",
	"US" => "United States",
	"UM" => "United States Minor Outlying Islands",
	"UY" => "Uruguay",
	"UZ" => "Uzbekistan",
	"VU" => "Vanuatu",
	"VE" => "Venezuela",
	"VN" => "Viet Nam",
	"VG" => "Virgin Islands, British",
	"VI" => "Virgin Islands, U.S.",
	"WF" => "Wallis And Futuna",
	"EH" => "Western Sahara",
	"YE" => "Yemen",
	"ZM" => "Zambia",
	"ZW" => "Zimbabwe");
        
        return $this->countries;
    }
    
    /**
     * Get list of drugs as an array.
     * @param String $option
     * @return Array 
     */
    function getDrugsArray($option = '')
    {
        if($option)
            $drugs_array = array($option, 'Heroin', 'Cocaine', 'Barbituates', 'Methamphetamines', 'Opiates', 'Marijuana', OPTION_OTHER => 'Other');
        else
            $drugs_array = array(1 => 'Heroin', 'Cocaine', 'Barbituates', 'Methamphetamines', 'Opiates', 'Marijuana', OPTION_OTHER => 'Other');
        
        return $drugs_array;
    }
    
    function getYearsArray($option = '')
    {
        if($option)
            $year_array = array($option, '0 - 5 Years', '5 - 10 Years', '10 - 20 Years', '>20 Years');
        else
            $year_array = array(1 => '0 - 5 Years', '5 - 10 Years', '10 - 20 Years', '>20 Years');
        
        return $year_array;
    }
    
    function getPackArray($option = '')
    {
        if($option)
            $pack_array = array($option, '0 - 0.5', '0.5 - 1', '1 - 2', '>2');
        else
            $pack_array = array(1 => '0 - 0.5', '0.5 - 1', '1 - 2', '>2');
        
        return $pack_array;
    }
}

?>
