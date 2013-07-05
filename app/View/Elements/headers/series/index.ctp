<div class="filter_box">
	<div class="bread"><h3><?php echo __('Series'); ?></h3></div>
</div>
<?php echo $this->Form->create('Series', array('class' => 'form-inline')); ?>
<div class="store_search_bar">
	<div class="pagination-centered">
		<?php echo $this->Form->input('terms', array('class' => 'span6', 'placeholder' => __('Search...'), 'value' => @$this->request->query['terms'])); ?>
		<?php echo $this->Form->button(__('Search'), array('class' => 'btn btn-custom store_search_btn', 'style' => 'width: 125px;')); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>