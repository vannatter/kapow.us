<div class="item_actions">
	<button class="btn btn-custom toggle_favorite" data-type="publisher" data-id="<?php echo $publisher['Publisher']['id']; ?>" type="button"><i class="icon-heart icon-white"></i> Add Favorite</button>
    <div class="btn-group">
        <button class="btn btn-custom dropdown-toggle" data-toggle="dropdown"><i class="icon-cog icon-white"></i> Tools <span class="caret white-caret"></span></button>
        <ul class="dropdown-menu fav_menu" role="menu">
            <li><a href="/improve/p/<?php echo $publisher['Publisher']['id']; ?>">Improve this content</a></li>
            <li><a href="/report/p/<?php echo $publisher['Publisher']['id']; ?>">Report an issue</a></li>
            <li><a href="/flag/p/<?php echo $publisher['Publisher']['id']; ?>">Flag as inappropriate</a></li>
            <?php if ($this->Session->read('Auth.User.access_level') > 50) { ?>
	            <li class="divider"></li>
	            <li><a href="/admin/publishers/edit/<?php echo $publisher['Publisher']['id']; ?>">Edit this publisher</a></li>
            <?php } ?>
        </ul>             
    </div>
</div>