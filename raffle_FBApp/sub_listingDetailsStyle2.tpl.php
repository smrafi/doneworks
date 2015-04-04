<div id="listing">
<h2><?php 
$link_name = $this->fields->getFieldById(1);
$this->plugin( 'ahreflisting', $this->link, $link_name->getOutput(1), '', array("delete"=>true, "link"=>false) ) 
?></h2>

<?php
if ( !empty($this->mambotAfterDisplayTitle) ) { 
	echo trim( implode( "\n", $this->mambotAfterDisplayTitle ) );
}

if ( !empty($this->mambotBeforeDisplayContent) && $this->mambotBeforeDisplayContent[0] <> '' ) { 
	echo trim( implode( "\n", $this->mambotBeforeDisplayContent ) ); 
}
echo '<div class="column first">';

$images = $this->images;
if ($this->config->getTemParam('skipFirstImage','0') == 1) {
	array_shift($images);
}
if (!empty($this->images)) include $this->loadTemplate( 'sub_images.tpl.php' );

echo '<div class="listing-desc">';

if(!is_null($this->fields->getFieldById(2))) { 
	$link_desc = $this->fields->getFieldById(2);
	echo $link_desc->getOutput(1);
}
echo '</div>';
if ( !empty($this->mambotAfterDisplayContent) ) { echo trim( implode( "\n", $this->mambotAfterDisplayContent ) ); }

echo '<div class="rating-fav">';
	if($this->config->get('show_rating')) {
		echo '<div class="rating">';
		$this->plugin( 'ratableRating', $this->link, $this->link->link_rating, $this->link->link_votes); 
		echo '<div id="total-votes">';
		if( $this->link->link_votes <= 1 ) {
			echo $this->link->link_votes . " " . strtolower(JText::_( 'Vote' ));
		} elseif ($this->link->link_votes > 1 ) {
			echo $this->link->link_votes . " " . strtolower(JText::_( 'Votes' ));
		}
		echo '</div>';
		echo '</div>';
	}

	if($this->config->get('show_favourite')) {
	?>
	<div class="favourite">
	<span class="fav-caption"><?php echo JText::_( 'Favoured' ) ?>:</span>
	<div id="fav-count"><?php echo number_format($this->total_favourites,0,'.',',') ?></div><?php 
		if($this->my->id > 0){ 
			if($this->is_user_favourite) {
				?><div id="fav-msg"><a href="javascript:fav(<?php echo $this->link->link_id ?>,-1);"><?php echo JText::_( 'Remove favourite' ) ?></a></div><?php 
			} else {
				?><div id="fav-msg"><a href="javascript:fav(<?php echo $this->link->link_id ?>,1);"><?php echo JText::_( 'Add as favourite' ) ?></a></div><?php 
				}
		} ?>
	</div><?php
	}
echo '</div>';

?>
<div class="codgoogle">
<div class="cod-asense">
<script type="text/javascript"><!--
google_ad_client = "pub-6788171893838569";
/* 468x60, creado 17/05/10 */
google_ad_slot = "2364222694";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
</div>
<?php
echo '</div>';


echo '<div class="column second">';
echo '<h3>';
echo JText::_('Extension Joomla');
echo '</h3>';
// Address
$address = '';
if( $this->config->getTemParam('displayAddressInOneRow','1') ) {
	$this->fields->resetPointer();
	$address_parts = array();
	$address_displayed = false;
	while( $this->fields->hasNext() ) {
		$field = $this->fields->getField();
		$output = $field->getOutput(1);
		if(in_array($field->getId(),array(4,5,6,7,8)) && !empty($output)) {
			$address_parts[] = $output;
		}
		$this->fields->next();
	}
	if( count($address_parts) > 0 ) { $address = implode(', ',$address_parts); }
}

// Other custom fields
echo '<div class="fields">';
$number_of_columns = $this->config->getTemParam('numOfColumnsInDetailsView','1');
$field_count = 0;
$need_div_closure = false;
$this->fields->resetPointer();
while( $this->fields->hasNext() ) {
	$field = $this->fields->getField();
	$value = $field->getValue();
	if( 
		( 
			(!$field->hasInputField() && !$field->isCore() && empty($value)) || (!empty($value) || $value == '0')
			&& 
			// This condition ensure that fields listed in array() are skipped
			!in_array($field->getName(),array('link_name','link_desc'))
			&&
			(
				(
					$this->config->getTemParam('displayAddressInOneRow','1') == 1
					&& 
					!in_array($field->getId(),array(5,6,7,8)) 
				)
				||
				$this->config->getTemParam('displayAddressInOneRow','1') == 0
			)
		) 
		||
		// Fields in array() are always displayed regardless of its value.
		in_array($field->getName(),array('link_featured'))
	) {
		if( $field_count % $number_of_columns == 0 ) {
			echo '<div class="row0">';
			$need_div_closure = true;
		}
		
		echo '<div class="fieldRow'.(($field_count % $number_of_columns == ($number_of_columns -1))?' lastFieldRow':'').'" style="width:'.floor(98/intval($number_of_columns)).'%">';
		
		if($this->config->getTemParam('displayAddressInOneRow','1') && in_array($field->getId(),array(4,5,6,7,8)) && $address_field = $this->fields->getFieldById(4)) {
			if( $address_displayed == false ) {
				echo '<div class="caption">';
				if($address_field->hasCaption()) {
					echo $address_field->getCaption();
				}
				echo '</div>';
				echo '<div class="output">';
				echo $address_field->getDisplayPrefixText(); 
				echo $address;
				echo $address_field->getDisplaySuffixText(); 
				echo '</div>';
				$address_displayed = true;
			}
		} else {
			echo '<div class="caption">';
			// echo $field->getId();
			if($field->hasCaption()) {
				echo $field->getCaption();
			}
			echo '</div>';
			echo '<div class="output">';			
			$user	=& JFactory::getUser();		
			$uri 	= & JFactory::getURI();
			$return = base64_encode($uri->_uri);
			switch($field->getFieldType()) {
				case 'mfile':
                                        if($this->fields->fields[9]['value'] == 'GPL')
                                                echo JText::_('DIRECT_DOWNLOAD_TXT');
                                        else
                                            echo JText::_('PAYMENT_DOWNLOAD_TXT');
					break;

				default:
					echo $field->getDisplayPrefixText(); 
					echo $field->getOutput(1);
					echo $field->getDisplaySuffixText(); 
			}
			echo '</div>';
		}
		echo '</div>';
			
		if( ($field_count % $number_of_columns) == ($number_of_columns-1) ) {
			echo '</div>';
			$need_div_closure = false;					
		}
		$field_count++;
	}
	$this->fields->next();
}

//Dev Rafi - 13/02/2011
//Following modification done for the moset payment
//this division will have image for the payment button
//this part is not included in actual mosets tree component
echo '<div class="row0">';

//get the core data available
$core_data = $this->fields->coresValue;
//get other needed data
$details = $this->fields->fields[9];

//define required values from needed
$price = $core_data['price'];
$link_id = $details['linkId'];
$licence_type = $details['value'];

//added for version 3.0
$link_label = $core_data[link_name];
$link_email = $core_data[email];

//add our CSS from mosets payment component at here
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_mosetpay/css/pagform.css');

    echo '<div class="fieldRow lastFieldRow"'.'" style="width:'.floor(98/intval($number_of_columns)).'%">';
        if($price != 0 or $licence_type != 'GPL')
        {
            echo '<div class="caption">';
                echo 'Payment Option';
            echo '</div>';
            echo '<div class="output">';
                echo '<a href="index.php?option=com_mosetpay&task=pppay&link_id='.$link_id.'">';
                    echo '<img src="'.JURI::root().'components/com_mosetpay/img/paypal_newuse.gif"/>';
                echo '</a>';
            echo '</div>';
            echo '</div>';
            if($this->account_info != '')
            {
            echo '<div class="fieldRow lastFieldRow"'.'" style="width:'.floor(98/intval($number_of_columns)).'%">';
            //following added for version 3.0. This is part is not available in version 2.0
            ?>
    <div class="pagform">
        <form method="post" name="pgnform" action="index.php">
            <div class="pagheading">
                <?php echo 'Descargar pack Solojoomla '.$link_label ?>
            </div>
            <div class="messagetxt">
                1. Para obtener su Código de Acceso, envia(r) <b><?php echo $this->account_info->numofsms; ?></b> mensaje(s) <b><?php echo $this->account_info->sms_code; ?></b> al <b><?php echo $this->account_info->phone_number; ?></b>.
            </div>
            <div class="messagetxt">
                2. Introducir el código en el siguiente cuadro.
            </div>
            <div class="texbox">
                <div class="textareabox">
                    <input name="access_code" type="text" class="textinput" />
                </div>
                <div class="download_button">
                    <input type="image" src="<?php echo JURI::root().'components/com_mosetpay/img/pag_download.png' ?>" name="sepomo_download" />
                </div>
            </div>
            <div class="messagetxt" style=" padding-top: 5px;">
                3. Haga clic en botón para <b>descargar el archivo</b>.
            </div>
            <input type="hidden" name="option" value="com_mosetpay" />
            <input type="hidden" name="task" value="pagdownload" />
            <input type="hidden" name="payment_token" value="<?php echo $this->payment_token; ?>" />
            <input type="hidden" name="link_id" value="<?php echo $link_id; ?>" />
        </form>
        <div class="notes" style=" padding-top: 5px;">
            Si usted tiene cualquier problema en la descarga del archivo, pongase en contacto con el <a href="mailto:<?php echo 'admin@joomlapacks.com'; ?>">administrador de la web</a>. <span style="color:red">Actualice la página antes de insertar otro código, pulsando F5 puede actualizar la página</span>.
        </div>
    </div>
    <?php
            echo '</div>';
            }
        }
        else
        {
            echo '<div class="caption">';
                echo 'Download Option';
            echo '</div>';
            echo '<div class="output">';
                echo '<a href="index.php?option=com_mosetpay&task=direct_download&link_id='.$link_id.'">';
                    echo '<img src="'.JURI::root().'components/com_mosetpay/img/download_button.png" width="64px" height="64px" />';
                echo '</a>';
            echo '</div>';
            echo '</div>';
        }
    
echo '</div>';

//modifcations end here
//Dev Rafi - rafiitfac@gmail.com


if( $need_div_closure ) {
	echo '</div>';
	$need_div_closure = false;
}

echo '</div>';

echo '</div>';

if( $this->show_actions_rating_fav ) {
	?>
	<div class="actions-rating-fav">
	<?php if( $this->show_actions ) { ?>
	<div class="actions">
	<?php 
		$this->plugin( 'ahrefreview', $this->link, array("rel"=>"nofollow") ); 
		$this->plugin( 'ahrefrecommend', $this->link, array("rel"=>"nofollow") );	
		$this->plugin( 'ahrefprint', $this->link );
		$this->plugin( 'ahrefcontact', $this->link, array("rel"=>"nofollow") );
		$this->plugin( 'ahrefvisit', $this->link );
		$this->plugin( 'ahrefreport', $this->link, array("rel"=>"nofollow") );
		$this->plugin( 'ahrefclaim', $this->link, array("rel"=>"nofollow") );
		$this->plugin( 'ahrefownerlisting', $this->link );
		$this->plugin( 'ahrefmap', $this->link );
	?></div><?php
	}
	?></div><?php 
}
?>
</div>