<?php if($this->Session->read('Auth.User')) { ?>
	<div class="item_actions">
		<?php echo $this->Common->addFavButton($series['Series']['id'], 'series', $userFav); ?>
		<div class="btn-group">
			<button class="btn btn-custom dropdown-toggle" data-toggle="dropdown"><i class="icon-cog icon-white"></i> <?php echo __('Tools'); ?> <span class="caret white-caret"></span></button>
			<ul class="dropdown-menu fav_menu" role="menu">
				<li><a href="/improve/series/<?php echo $series['Series']['id']; ?>"><?php echo __('Improve this content'); ?></a></li>
				<li><a href="/report/series/<?php echo $series['Series']['id']; ?>"><?php echo __('Report an issue'); ?></a></li>
				<li><a href="/flag/series/<?php echo $series['Series']['id']; ?>"><?php echo __('Flag as inappropriate'); ?></a></li>
				<?php if ($this->Session->read('Auth.User.access_level') > 50) { ?>
					<li class="divider"></li>
					<li><a href="/admin/series/edit/<?php echo $series['Series']['id']; ?>"><?php echo __('Edit Series'); ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
<?php } ?>