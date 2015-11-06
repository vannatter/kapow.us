<?php echo $this->element('admin/page_header', array('title' => __('Dashboard'))); ?>

<div class="col-md-3">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<?php echo sprintf('Total Items %s', $itemTotal); ?>
		</div>
		<a href="/admin/items">
			<div class="panel-footer">
				<span class="pull-left">View Details</span>
				<div class="clearfix"></div>
			</div>
		</a>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<?php echo sprintf('Total Series %s', $seriesTotal); ?>
		</div>
		<a href="/admin/series">
			<div class="panel-footer">
				<span class="pull-left">View Details</span>
				<div class="clearfix"></div>
			</div>
		</a>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<?php echo sprintf('Total Creators %s', $creatorTotal); ?>
		</div>
		<a href="/admin/creators">
			<div class="panel-footer">
				<span class="pull-left">View Details</span>
				<div class="clearfix"></div>
			</div>
		</a>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<?php echo sprintf('Total Publishers %s', $publisherTotal); ?>
		</div>
		<a href="/admin/publishers">
			<div class="panel-footer">
				<span class="pull-left">View Details</span>
				<div class="clearfix"></div>
			</div>
		</a>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<?php echo sprintf('Total Shops %s', $shopTotal); ?>
		</div>
		<a href="/admin/stores">
			<div class="panel-footer">
				<span class="pull-left">View Details</span>
				<div class="clearfix"></div>
			</div>
		</a>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<?php echo sprintf('Total Users %s', $userTotal); ?>
		</div>
		<a href="/admin/users">
			<div class="panel-footer">
				<span class="pull-left">View Details</span>
				<div class="clearfix"></div>
			</div>
		</a>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-danger">
		<div class="panel-heading">
			<?php echo sprintf('Hot Items %s', $hotItems); ?>
		</div>
	</div>
</div>

<div class="col-md-3">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<?php echo sprintf('Weighted Publishers %s', $weightedPublishers); ?>
	</div>
</div>