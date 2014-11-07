<?php
/**
 *@var $this View
 */
?>
<div class="collapse navbar-collapse navbar-ex1-collapse">
	<ul class="nav navbar-nav side-nav">
		<li>
			<a href="/admin/items"><i class="fa fa-fw fa-table"></i> Items</a>
		</li>
		<li>
			<a href="/admin/categories"><i class="fa fa-fw fa-table"></i> Categories</a>
		</li>
		<li>
			<a href="javascript:;" data-toggle="collapse" data-target="#creators"><i class="fa fa-fw fa-arrows-v"></i> Creators <i class="fa fa-fw fa-caret-down"></i></a>
			<ul id="creators" class="collapse">
				<li>
					<a href="/admin/creators"><i class="fa fa-fw fa-table"></i> <?php echo __('Creators <span class="badge %s">%s</span>', ($creatorQueueTotal>0) ? 'badge-success' : '', $creatorQueueTotal); ?></a>
				</li>
				<li>
					<a href="/admin/creatorTypes"><i class="fa fa-fw fa-table"></i> Creator Types</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="/admin/publishers"><i class="fa fa-fw fa-table"></i> <?php echo __('Publishers <span class="badge %s">%s</span>', ($publisherQueueTotal>0) ? 'badge-success' : '', $publisherQueueTotal); ?></a>
		</li>
		<li>
			<a href="/admin/series"><i class="fa fa-fw fa-table"></i> Series</a>
		</li>
		<li>
			<a href="/admin/sections"><i class="fa fa-fw fa-table"></i> Sections</a>
		</li>
		<li>
			<a href="javascript:;" data-toggle="collapse" data-target="#stores"><i class="fa fa-fw fa-arrows-v"></i> Stores <i class="fa fa-fw fa-caret-down"></i></a>
			<ul id="stores" class="collapse">
				<li>
					<a href="/admin/stores"><i class="fa fa-fw fa-table"></i> Stores</a>
				</li>
				<li>
					<a href="/admin/stores/photoQueue"><i class="fa fa-fw fa-table"></i> <?php echo __('Store Photo Queue <span class="badge %s">%s</span>', ($photoQueueTotal>0) ? 'badge-success' : '', $photoQueueTotal); ?></a>
				</li>
				<li>
					<a href="/admin/stores/new"><i class="fa fa-fw fa-table"></i> <?php echo __('New Stores <span class="badge %s">%s</span>', ($newStoreTotal>0) ? 'badge-success' : '', $newStoreTotal); ?></a>
				</li>
			</ul>
		</li>
		<li>
			<a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
			<ul id="users" class="collapse">
				<li>
					<a href="/admin/users"><i class="fa fa-fw fa-table"></i> Users</a>
				</li>
				<li>
					<a href="/admin/userActivity"><i class="fa fa-fw fa-table"></i> User Activity</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="javascript:;" data-toggle="collapse" data-target="#reports"><i class="fa fa-fw fa-arrows-v"></i> Reports <i class="fa fa-fw fa-caret-down"></i></a>
			<ul id="reports" class="collapse">
				<li>
					<a href="/admin/reports"><i class="fa fa-fw fa-table"></i> <?php echo __('Reports <span class="badge %s">%s</span>', ($openReportTotal > 0) ? 'badge-success' : '', $openReportTotal); ?></a>
				</li>
				<li>
					<a href="/admin/flags"><i class="fa fa-fw fa-table"></i> <?php echo __('Flagged Items <span class="badge %s">%s</span>', ($openFlagTotal > 0) ? 'badge-success' : '', $openFlagTotal); ?></a>
				</li>
				<li>
					<a href="/admin/improvements"><i class="fa fa-fw fa-table"></i> <?php echo __('Improvements <span class="badge %s">%s</span>', ($newImprovementsTotal>0) ? 'badge-success' : '', $newImprovementsTotal); ?></a>
				</li>
			</ul>
		</li>
		<li>
			<a href="/admin/blogs"><i class="fa fa-fw fa-table"></i> Blogs</a>
		</li>
		<li>
			<a href="/admin/appMessages"><i class="fa fa-fw fa-table"></i> App Messages</a>
		</li>
	</ul>
</div>