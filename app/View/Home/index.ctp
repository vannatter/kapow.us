
<?php $this->Html->script('page/search', array('inline' => false)); ?>
<?php echo $this->Element('headers/home/index'); ?>

<?php echo $this->Form->create('search', array('url' => '/search', 'class' => 'form-inline')); ?>
<div class="store_search_bar">
	<div class="pagination-centered">
		<?php echo $this->Form->input('type', array('class' => 'span3', 'value' => @$type)); ?>
		<?php echo $this->Form->input('terms', array('class' => 'span6', 'value' => @$terms)); ?>
		<?php echo $this->Form->submit(__('Search'), array('class' => 'btn btn-custom btn-hgh')); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<div class="row">

	<div class="span9 home_main">	
	
		<pre>
		<?php print_r($random_item); ?>
		</pre>

	</div>
	
	<div class="span3 home_sidebar">
		blog and stuff
	</div>
</div>


