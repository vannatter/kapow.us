<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Element('headers/users/set_username'); ?>

<div class="pad">

	Before you continue, please choose a username. This will be your unique handle here on Kapow! that others will identify you by - make sure it's memorable!
	<br/><br/>
	Your username must be alphanumeric and must be at least 3 characters long.
	<br/><br/>
	
	<form id="setusername_frm" class="well span11" method="post" action="/users/setUsername">
	  <div class="row">
	
		<div class="span1">
			Username:
		</div>
		<div class="span4">
			<?php echo $this->Form->input('username', array('label'=>false, 'maxlength'=>50, 'class'=>'span4')); ?>
		</div>
		<div class="span3">
			<?php echo $this->Form->submit(__('Save Username'), array('class'=>'btn btn-custom')); ?>
		</div>
		
	  </div>
	</form>

</div>