<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Element('headers/users/login'); ?>

<div class="row">
	<div class="span5">
		<?php echo $this->Form->create('User', array('class' => 'form-vertical')); ?>
		<div class="login_block">
			<?php echo $this->Form->input('email', array('class' => 'login_ipt')); ?>
			<?php echo $this->Form->input('password', array('class' => 'login_ipt')); ?>

			<div class="float-left login_btn">
				<?php echo $this->Form->submit(__('Login'), array('class' => 'btn btn-custom')); ?>
			</div>
			<div class="float-left fb_login_connect">
				<?php echo $this->Facebook->login(array('custom' => true, 'img' => 'connectwithfacebook.gif', 'id' => false, 'show-faces' => false, 'perms' => 'email')); ?>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
		<div class="row">
		</div>
	</div>
	<div class="span7 login_intro">
		Kapow! is creating a new platform for finding, tracking and interacting with your favorite comics, publishers, artists and local comic shops.
		We're creating tools that make finding new stuff you want much easier (and keeping track of what you already love so you never miss something new).
		<br/><br/>
		Log into your account on the left using your Kapow! account or connect with Facebook. If you need a new account, click the big button below to sign up for free today.
		<br/><br/><br/>
		
		<?php echo $this->Html->link(__('Create Your Free Kapow! Account'), array('controller' => 'users', 'action' => 'register'), array('class' => 'create_account btn btn-large btn-custom')); ?>
	</div>
</div>