<?php
/**
 *@var $this View
 */
?>
<div id="creator-items"></div>
<script>
	var items = $('div#creator-items');
	items.append('<img src="/img/ajax-loader.gif" />');

	$.get('/creators/items/<?php echo $creator['Creator']['id']; ?>', function(data) {
		items.empty().append(data);
	});
</script>