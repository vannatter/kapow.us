<div class="item_actions">

	<button class="btn btn-primary" type="button"><i class="icon-shopping-cart icon-white"></i> Add to My Pull List</button>

    <div class="btn-group">
        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="icon-heart icon-white"></i> Add Favorite <span class="caret"></span></button>
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
 
</div>