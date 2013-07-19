<?php echo $this->Form->create('AppMessage', array('class' => 'form-horizontal')); ?>
<?php echo $this->Form->input('title', array('class' => 'span6')); ?>
<?php echo $this->Form->input('body', array('class' => 'span6', 'rows' => 10)); ?>
<?php echo $this->Form->submit(__('Save Message')); ?>
<?php echo $this->Form->end(); ?>