<?php echo $this->Element('headers/users/register'); ?>

<div class="row">
	<div class="span5">
		<?php echo $this->Form->create('User', array('class' => 'form-vertical')); ?>
		<div class="login_block">
			<?php echo $this->Form->input('username', array('class' => 'login_ipt')); ?>
			<?php echo $this->Form->input('email', array('class' => 'login_ipt')); ?>
			<?php echo $this->Form->input('clear_password', array('class' => 'login_ipt')); ?>
			<?php echo $this->Form->input('confirm_password', array('class' => 'login_ipt')); ?>

			<div class="float-left login_btn">
				<?php echo $this->Form->submit(__('Register'), array('class' => 'btn btn-custom')); ?>
			</div>
			<div class="float-left fb_login_connect">
				<?php echo $this->Facebook->login(array('custom' => true, 'img' => 'connectwithfacebook.gif', 'id' => false, 'show-faces' => false, 'perms' => 'email')); ?>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
	<div class="span7 login_intro">
		Kapow! is creating a new platform for finding, tracking and interacting with your favorite comics, publishers, artists and local comic shops.
		We're creating tools that make finding stuff you want much easier (and keeping track of what you already love) so you'll never miss something new.
		<br/><br/>
		Use the form to create a Kapow! account or you can also connect with Facebook and instantly create your account (and customize your profile later).
	</div>
</div>