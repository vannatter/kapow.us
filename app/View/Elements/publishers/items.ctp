<?php
/**
 *@var $this View
 */
?>
<div id="publisher-items"></div>
<script>
	var items = $('div#publisher-items');
	items.append('loading...');

	$.get('/publishers/items/<?php echo $publisher['Publisher']['id']; ?>', function(data) {
		items.empty().append(data);
	});
</script>