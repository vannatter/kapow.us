<?php
/**
 *@var $this View
 */
?>
<?php echo $this->Form->create('Store', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('name', array('class' => 'span6')); ?>
<?php echo $this->Form->input('address', array('class' => 'span6')); ?>
<?php echo $this->Form->input('address_2', array('class' => 'span6')); ?>
<?php echo $this->Form->input('city', array('class' => 'span6')); ?>
<?php echo $this->Form->input('state', array('class' => 'span3', 'options' => $this->States->getArray())); ?>
<?php echo $this->Form->input('zip', array('class' => 'span3')); ?>
<?php echo $this->Form->input('phone_no', array('class' => 'span4')); ?>
<?php echo $this->Form->input('website', array('class' => 'span6')); ?>
<?php echo $this->Form->input('google_reference', array('class' => 'span6', 'rows' => 5)); ?>
<?php echo $this->Form->submit(__('Save Store')); ?>
<?php echo $this->Form->end(); ?>