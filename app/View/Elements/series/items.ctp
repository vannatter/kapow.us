<?php
/**
 *@var $this View
 */
?>
<div id="series-items"></div>
<script>
	var items = $('div#series-items');
	items.append('loading...');

	$.get('/series/items/<?php echo $series['Series']['id']; ?>', function(data) {
		items.empty().append(data);
	});
</script>