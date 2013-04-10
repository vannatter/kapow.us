<div class="item_actions">

	<button class="btn btn-custom pull_list_btn" type="button"><i class="icon-shopping-cart icon-white"></i> Pull List</button>

    <div class="btn-group">
        <button class="btn btn-custom dropdown-toggle" data-toggle="dropdown"><i class="icon-heart icon-white"></i> Favorite <span class="caret white-caret"></span></button>
        <ul class="dropdown-menu fav_menu" role="menu">
        
        	<?php foreach ($unique_creators as $k=>$v) { ?>
	            <li><a href="javascript:;" class="toggle_favorite" data-type="creator" data-id="<?php echo $k; ?>">Creator: <?php echo $v; ?></a></li>
        	<?php } ?>
        
            <li><a href="javascript:;" class="toggle_favorite" data-type="series" data-id="<?php echo $item['Item']['series_id']; ?>">Series: <?php echo $item['Series']['series_name']; ?></a></li>
            <li><a href="javascript:;" class="toggle_favorite" data-type="publisher" data-id="<?php echo $item['Item']['publisher_id']; ?>">Publisher: <?php echo ucwords(strtolower($item['Publisher']['publisher_name'])); ?></a></li>
            <li class="divider"></li>
            <li><a href="javascript:;">Add All to Favorites</a></li>
        </ul>             
    </div>

    <div class="btn-group">
        <button class="btn btn-custom dropdown-toggle" data-toggle="dropdown"><i class="icon-cog icon-white"></i> Tools <span class="caret white-caret"></span></button>
        <ul class="dropdown-menu fav_menu" role="menu">
        
            <li><a href="/improve/i/<?php echo $item['Item']['id']; ?>">Improve this content</a></li>
            <li><a href="/report/i/<?php echo $item['Item']['id']; ?>">Report an issue</a></li>
            <li><a href="/flag/i/<?php echo $item['Item']['id']; ?>">Flag as inappropriate</a></li>

            <?php if ($this->Session->read('Auth.User.access_level') > 50) { ?>
	            <li class="divider"></li>
	            <li><a href="/admin/items/edit/<?php echo $item['Item']['id']; ?>">Edit this item</a></li>
            <?php } ?>
            
        </ul>             
    </div>
 
</div>