<?php
/**
 * @var $this View
 */
?>
<?php echo $this->element('headers/shops/add'); ?>

<?php echo $this->Form->create('Store', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('name', array('class' => 'span6')); ?>
<?php echo $this->Form->input('address', array('class' => 'span6')); ?>
<?php echo $this->Form->input('address_2', array('class' => 'span6')); ?>
<?php echo $this->Form->input('city', array('class' => 'span6')); ?>
<?php echo $this->Form->input('state', array('options' => $this->States->getArray(), 'class' => 'span4')); ?>
<?php echo $this->Form->input('zip', array('class' => 'span3')); ?>
<?php echo $this->Form->input('phone_no', array('class' => 'span4')); ?>
<?php echo $this->Form->input('website', array('class' => 'span6')); ?>
<?php echo $this->Form->input('facebook_url', array('class' => 'span6')); ?>
<?php echo $this->Form->input('twitter_url', array('class' => 'span6')); ?>
<?php echo $this->Form->input('ebay_url', array('class' => 'span6')); ?>
<?php echo $this->Form->submit(__('Submit Store')); ?>
<?php echo $this->Form->end(); ?>