<?php
/**
 * @version		$Id: default_login.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.5
 */

defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');

//$login_obj = new stdClass();
//$db =& JFactory::getDBO();
//$query = "select * from #__modules where id = 25";
//$db->setQuery($query);
//
//$login_obj = $db->loadObject();
//$modules = JModuleHelper::getModules('footer_menu');

//print_r($modules);


?>
<!--<div class="brown_wrapper clearfix">-->
<div class="login<?php echo $this->pageclass_sfx?>">
<div class="blue_line clearfix">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>

	<?php if ($this->params->get('logindescription_show') == 1 || $this->params->get('login_image') != '') : ?>
	<div class="login-description">
	<?php endif ; ?>

		<?php if($this->params->get('logindescription_show') == 1) : ?>
			<?php echo $this->params->get('login_description'); ?>
		<?php endif; ?>

		<?php if (($this->params->get('login_image')!='')) :?>
			<img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image" alt="<?php echo JTEXT::_('COM_USER_LOGIN_IMAGE_ALT')?>"/>
		<?php endif; ?>

	<?php if ($this->params->get('logindescription_show') == 1 || $this->params->get('login_image') != '') : ?>
	</div>
	<?php endif ; ?>

	<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post">

		<fieldset>
        <table class="login">
        <tr>
			<?php foreach ($this->form->getFieldset('credentials') as $field): ?>
				<?php if (!$field->hidden): ?>
					
                    <td><?php echo $field->label; ?><br />
					<?php echo $field->input; ?></td>
                    
				<?php endif; ?>
			<?php endforeach; ?>
            </tr>
            </table>
            <div class="submit_button">
			<button type="submit" class="button"><?php echo JText::_('JLOGIN'); ?></button>
            </div>
            <div class="forget_pw">
            Click <a href="index.php/component/users/?view=reset">Here</a> if you've forgotton your Password and wish to send it to your registered email address.
            </div>
			<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('login_redirect_url',$this->form->getValue('return'))); ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</fieldset>
	</form>
    <?php //echo JModuleHelper::renderModule($modules[0]); ?>
   </div>
</div>
<!--</div>-->
   
