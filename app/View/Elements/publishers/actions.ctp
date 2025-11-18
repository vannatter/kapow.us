<style>
#weight { width: 75%; margin-left: auto; margin-right: auto; }
</style>
<?php if ($this->Session->read('Auth.User')) { ?>
	<div class="item_actions">
		<?php echo $this->Common->addFavButton($publisher['Publisher']['id'], 'publisher', $userFav); ?>
			<div class="btn-group">
					<button class="btn btn-custom dropdown-toggle" data-toggle="dropdown"><i class="icon-cog icon-white"></i> <?php echo __('Tools'); ?> <span class="caret white-caret"></span></button>
					<ul class="dropdown-menu fav_menu" role="menu">
						<li><a href="/improve/publisher/<?php echo $publisher['Publisher']['id']; ?>"><?php echo __('Improve this content'); ?></a></li>
						<li><a href="/report/publisher/<?php echo $publisher['Publisher']['id']; ?>"><?php echo __('Report an issue'); ?></a></li>
						<li><a href="/flag/publisher/<?php echo $publisher['Publisher']['id']; ?>"><?php echo __('Flag as inappropriate'); ?></a></li>
						<?php if ($this->Session->read('Auth.User.access_level') > 50) { ?>
							<li class="dropdown-divider"></li>
							<li><a href="/admin/publishers/edit/<?php echo $publisher['Publisher']['id']; ?>"><?php echo __('Edit Publisher'); ?></a></li>
							<li class="dropdown-divider"></li>
								<li><div style="display: block; padding: 3px 10px; clear: both; color: #333; font-weight: bold; margin-top: 5px;" data-publisher-weight="<?php echo $publisher['Publisher']['weight']; ?>" data-publisher-id="<?php echo $publisher['Publisher']['id']; ?>">Weight</div><div id="weight"></div></li>
						<?php } ?>
					</ul>
			</div>
	</div>
<?php } ?>