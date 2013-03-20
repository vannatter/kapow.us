<div class="filter_box">
	<div class="bread"><h3>New This Week (<?php echo $release_date_formatted; ?>)</h3></div>
	<?php foreach ($categories as $category) { ?>
		<a href="/items/this_week/<?php echo $category['Category']['id']; ?>"><div class="filter_tab <?php echo (($content_type == $category['Category']['id']) ? " filter_tab_on ":""); ?>"><?php echo $category['Category']['category_name']; ?></div></a>
	<?php } ?>
</div>