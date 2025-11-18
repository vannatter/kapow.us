<?php
/**
 * @var $this View
 */
?>

<div class="filter_box">
	<div class="bread"><h3><a href="/items/<?php echo $this->Common->seoize($item['Item']['id'], $item['Item']['item_name']); ?>"><?php echo $item['Item']['item_name']; ?></a> &gt; Flag Item Image</h3></div>
</div>

<div class="pad">

	Is something wrong with the Item image? Please flag it with a description and potentially better image(s) so our administrator can look into it as soon as possible.
	<br/><br/>

	<?php echo $this->Form->create('Flag', array('class' => 'well span11')); ?>
	<div class="row">
		<div class="span11">
			<?php echo $this->Form->input('description', array('class' => 'input-xlarge span11', 'rows' => 12, 'label' => 'Describe the Image issue')); ?>
		</div>
		<?php echo $this->Form->submit(__('Submit Report'), array('class' => 'btn btn-custom float-end')); ?>
	</div>
	<?php echo $this->Form->end(); ?>

</div>
