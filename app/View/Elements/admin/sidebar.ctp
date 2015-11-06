<div class="col-sm-3 col-md-2 sidebar">
	<ul class="nav nav-sidebar">
		<li><a href="/admin">Dashboard</a></li>	
		<li><a href="/admin/items">Items</a></li>
		<li><a href="/admin/categories">Categories</a></li>
		<li><a href="/admin/blogs">Blogs</a></li>
		<li><a href="/admin/appMessages">App Messages</a></li>
	</ul>
	
	<ul class="nav nav-sidebar">	
		<li><a href="/admin/creators">Creators <span class="badge"> <?php echo $creatorQueueTotal; ?> </span></a></li>
		<li><a href="/admin/creatorTypes">Creator Types</a></li>
	</ul>
	
	<ul class="nav nav-sidebar">
		<li><a href="/admin/publishers">Publishers <span class="badge"> <?php echo $publisherQueueTotal; ?></span></a></li>
		<li><a href="/admin/series">Series</a></li>
		<li><a href="/admin/sections">Sections</a></li>
	</ul>
	
	<ul class="nav nav-sidebar">
		<li><a href="/admin/stores">Stores</a></li>
		<li><a href="/admin/stores/photoQueue">Photo Queue <span class="badge"> <?php echo $photoQueueTotal; ?> </span></a></li>
		<li><a href="/admin/stores/new">New Stores <span class="badge"> <?php echo $newStoreTotal; ?></span></a></li>
	</ul>
	
	<ul class="nav nav-sidebar">
		<li><a href="/admin/users">Users</a></li>
		<li><a href="/admin/userActivity">User Activity</a></li>
	</ul>
	
	<ul class="nav nav-sidebar">
		<li><a href="/admin/reports">Reports <span class="badge"> <?php echo $openReportTotal; ?></span></a></li>
		<li><a href="/admin/flags">Flagged Items <span class="badge"> <?php echo $openFlagTotal; ?> </span></a></li>
		<li><a href="/admin/improvements">Improvements <span class="badge"> <?php echo $newImprovementsTotal; ?></span></a></li>
	</ul>
</div>