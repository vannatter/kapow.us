<div class="filter_box">
	<div class="bread"><h3><?php echo __('Items'); ?></h3></div>
</div>
<?php echo $this->Form->create('Item', array('class' => 'form-inline')); ?>
<div class="store_search_bar">
	<div class="pagination-centered">
		<?php echo $this->Form->input('terms', array('class' => 'span6', 'placeholder' => __('Search...'), 'value' => @$this->request->query['terms'])); ?>
		<?php echo $this->Form->button(__('Search'), array('class' => 'btn btn-hgh btn-custom', 'style' => 'width: 125px;')); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>