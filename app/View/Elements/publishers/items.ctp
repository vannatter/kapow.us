<?php
/**
 *@var $this View
 */
?>
<?php $this->Html->script('page/publishers.js', array('inline' => false)); ?>
<div id="publisher-items"></div>
<script>
	var items = $('div#publisher-items');
	items.append('<img src="/img/ajax-loader.gif" />');

	$.get('/publishers/items/<?php echo $publisher['Publisher']['id']; ?>', function(data) {
		items.empty().append(data);
	});
</script>