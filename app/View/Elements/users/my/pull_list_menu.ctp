<div class="btn-group">
	<button class="btn btn-custom dropdown-toggle" data-bs-toggle="dropdown"><i class="icon-cog icon-white"></i> Options <span class="caret white-caret"></span></button>
	<ul class="dropdown-menu fav_menu" role="menu">
		<li><a href="/my/pull_list_process/y/<?php echo $item['Item']['id']; ?>"><i class="icon-ok-circle icon icon_mnu"></i> Add to Library</a></li>
		<li><a href="/my/pull_list_process/n/<?php echo $item['Item']['id']; ?>"><i class="icon-ban-circle icon icon_mnu"></i> Remove from Pull List</a></li>
	</ul>
</div>