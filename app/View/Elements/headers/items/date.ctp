<?php
$query = '';
if(isset($this->request->query['pubid'])) {
	$query = sprintf('?pubid=%s', $this->request->query['pubid']);
}
if(isset($this->request->query['terms'])) {
	if(empty($query)) {
		$query = sprintf('?terms=%s', $this->request->query['terms']);
	} else {
		$query .= sprintf('&terms=%s', $this->request->query['terms']);
	}
}
?>

<div class="filter_box">
	<div class="bread"><h3><?php echo __('Released on ') . $release; ?></h3></div>

	<a href="/items/date/<?php echo $dateNext . $query; ?>"><div class="filter_tab"><?php echo date("m/d/Y", strtotime($dateNext)); ?> <i class="icon-arrow-right icon-white"></i></div></a>
	<a href="/items/date/<?php echo $datePrevious . $query; ?>"><div class="filter_tab"><i class="icon-arrow-left icon-white"></i> <?php echo date("m/d/Y", strtotime($datePrevious)); ?></div></a>
</div>