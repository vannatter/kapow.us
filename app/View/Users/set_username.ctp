<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Element('headers/users/set_username'); ?>

<div class="pad">

	Before you continue, please choose a username<?php if($this->Session->read('Auth.User.facebook_id')) { echo ' and password'; } ?>. This will be your unique handle here on Kapow! that others will identify you by - make sure it's memorable!
	<br/><br/>
	Your username must be alphanumeric and must be at least 3 characters long.
	<br/><br/>

	<?php echo $this->Form->create('User', array('class' => 'well span11', 'id' => 'setusername_frm')); ?>
	<div class="row">
		<div class="span1">
			Username:
		</div>
		<div class="span4">
			<?php echo $this->Form->input('username', array('label'=>false, 'maxlength'=>50, 'class'=>'span4')); ?>
		</div>
	</div>
	<?php if($this->Session->read('Auth.User.facebook_id')) { ?>
		<div class="row">
			<div class="span1">
				Password:
			</div>
			<div class="span4">
				<?php echo $this->Form->input('clear_password', array('label' => false, 'class' => 'span4')); ?>
			</div>
		</div>
		<div class="row">
			<div class="span1">
				Confirm:
			</div>
			<div class="span4">
				<?php echo $this->Form->input('confirm_password', array('label' => false, 'class' => 'span4')); ?>
			</div>
		</div>
	<?php } ?>
	<div class="row">
		<div class="span1">
			&nbsp;
		</div>
		<div class="span3">
			<?php echo $this->Form->submit(__('Save Username'), array('class'=>'btn btn-custom')); ?>
		</div>
	</div>
	<?php echo $this->Form->end(); ?>

</div>