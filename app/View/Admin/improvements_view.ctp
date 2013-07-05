<?php
/**
 * @var $this View
 */
?>

<?php $this->Html->script('page/improve.admin.js', array('inline' => false)); ?>

<?php foreach($improve['ImprovementField'] as $field) { ?>
	<?php
	switch($improve['Improvement']['type']) {
		case 1:   ## ITEM
			$model = 'Item';
			break;
		case 2:   ## SERIES
			$model = 'Series';
			break;
		case 3:   ## CREATOR
			$model = 'Creator';
			break;
		case 4:   ## PUBLISHER
			$model = 'Publisher';
			break;
		case 5:   ## STORE
			$model = 'Store';
			break;
	}
	?>
	<div class="well">
		<h3><?php echo $field['field_name']; ?></h3>
		<h4><?php echo __('Current'); ?></h4>
		<?php echo $improve[$model][$field['field_name']]; ?>
		<h4><?php echo __('Changed'); ?></h4>
		<?php echo $field['data']; ?>
		<br /><br />
		<?php echo $this->Html->link(__('Accept'), '#', array('data-id' => $improve['Improvement']['id'], 'data-field-id' => $field['id'], 'class' => 'improve-accept btn btn-small btn-success')); ?>
		<?php echo $this->Html->link(__('Decline'), '#', array('data-id' => $improve['Improvement']['id'], 'data-field-id' => $field['id'], 'class' => 'improve-decline btn btn-small btn-danger')); ?>
	</div>
<?php } ?>
<?php echo $this->Html->link(__('Cancel'), '/admin/improvements/cancel/' . $improve['Improvement']['id'], array('class' => 'btn')); ?>