<?php
/**
 *@var $this View
 */
?>
<div id="series-items"></div>
<script>
	var items = $('div#series-items');
	items.append('<img src="/img/ajax-loader2.gif" />');

	$.get('/series/items/<?php echo $series['Series']['id']; ?>', function(data) {
		items.empty().append(data);
	});
</script>