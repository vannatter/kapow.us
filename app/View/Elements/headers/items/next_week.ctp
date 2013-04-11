<div class="filter_box">
	<div class="bread"><h3>New Next Week (<?php echo $release_date_formatted; ?>)</h3></div>
	<?php foreach ($categories as $category) { ?>
		<a href="/items/this_week/<?php echo $category['Category']['id']; ?>"><div class="filter_tab <?php echo (($content_type == $category['Category']['id']) ? " filter_tab_on ":""); ?>"><?php echo $category['Category']['category_name']; ?></div></a>
	<?php } ?>
</div>
<?php echo $this->Form->create('Item', array('class' => 'form-inline')); ?>
<div class="store_search_bar">
	<div class="pagination-centered">
		<?php echo $this->Form->input('publisher_id', array('class' => 'span6', 'value' => @$this->request->query['pubid'])); ?>
		<?php echo $this->Form->button(__('Filter'), array('class' => 'btn store_search_btn', 'style' => 'width: 125px;')); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>