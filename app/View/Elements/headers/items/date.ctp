<?php
$query = '';
if (isset($this->request->query['pubid'])) {
	$query = sprintf('?pubid=%s', $this->request->query['pubid']);
}
if (isset($this->request->query['terms'])) {
	if (empty($query)) {
		$query = sprintf('?terms=%s', $this->request->query['terms']);
	} else {
		$query .= sprintf('&terms=%s', $this->request->query['terms']);
	}
}
?>

<div class="filter_box">
	<div class="bread"><h3><a href="/items/date/<?php echo $datePrevious . $query; ?>"><i class="icon-arrow-left icon-white"></i></a> <?php echo __('Released on ') . $release; ?> <a href="/items/date/<?php echo $dateNext . $query; ?>"><i class="icon-arrow-right icon-white"></i></a></h3></div>

	<?php foreach ($categories as $category) { ?>
		<a href="/items/date/<?php echo $dateCurrent; ?>/<?php echo $category['Category']['id']; ?>"><div class="filter_tab <?php echo (($content_type == $category['Category']['id']) ? " filter_tab_on ":""); ?>"><?php echo $category['Category']['category_name']; ?></div></a>
	<?php } ?>
</div>