<div class="filter_box">
	<div class="bread"><h3><?php echo __('Publishers'); ?></h3></div>
</div>

<?php echo $this->Form->create('Publisher', array('class' => 'form-inline')); ?>
<div class="store_search_bar">
	<div class="pagination-centered">
		<?php echo $this->Form->input('terms', array('class' => 'span6', 'placeholder' => __('Search...'), 'value' => @$this->request->query['terms'])); ?>
		<?php echo $this->Form->button(__('Search'), array('class' => 'btn store_search_btn', 'style' => 'width: 125px;')); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>