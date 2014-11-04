<?php
/**
 *@var $this View
 */
?>
<?php if ($this->Session->read('Auth.User')) { ?>
	<?php $this->Html->script('page/items.js', array('inline' => false)); ?>
	<div class="item_actions">
	
			<div class="btn-group">
				<button class="btn btn-custom dropdown-toggle" data-toggle="dropdown"><i class="icon-shopping-cart icon-white"></i> <?php echo __('Pull/Own'); ?> <span class="caret white-caret"></span></button>
				<ul class="dropdown-menu fav_menu" role="menu">
					<li class="<?php echo (isset($item['Pull']['id'])) ? " fav_on" : ""; ?>"><a class="pull_list_btn" data-id="<?php echo $item['Item']['id']; ?>" href="javascript:;"><?php echo (isset($item['Pull']['id'])) ? __('Remove from Pull List') : __('Add to Pull List'); ?></a></li>
					<li class="<?php echo (isset($item['UserItem']['id'])) ? " fav_on" : ""; ?>"><a class="library_btn" data-id="<?php echo $item['Item']['id']; ?>" href="javascript:;"><?php echo (isset($item['UserItem']['id'])) ? __('Remove from Library') : __('Add to Library'); ?></a></li>
				</ul>
			</div>
			
			<div class="btn-group">
					<button class="btn btn-custom dropdown-toggle" data-toggle="dropdown"><i class="icon-heart icon-white"></i> <?php echo __('Favorite'); ?> <span class="caret white-caret"></span></button>
					<ul class="dropdown-menu fav_menu" role="menu">

						<?php foreach ($unique_creators as $k=>$v) { ?>
							<li class="<?php echo ($v['is_fav']) ? 'fav_on' : ''; ?>">
								<?php
								echo $this->Html->link(
									sprintf('Creator: %s', $v['name']),
									sprintf('/favorites/add/%s/creator', $k),
									array(
										'class' => 'toggle_favorite',
										'data-type' => 'creator',
										'data-id' => $k,
										'data-val' => $v['name']
									)
								);
								?>
							</li>
						<?php } ?>
						<li class="<?php echo (isset($item['Series']['UserFavorite']['id'])) ? 'fav_on' : '';?>">
							<?php
							echo $this->Html->link(
								sprintf('Series: %s', $item['Series']['series_name']),
								sprintf('/favorites/add/%s/series', $item['Item']['series_id']),
								array(
									'class' => 'toggle_favorite',
									'data-type' => 'series',
									'data-id' => $item['Item']['series_id'],
									'data-val' => $item['Series']['series_name']
								)
							);
							?>
						</li>
						<li class="<?php echo (isset($item['Publisher']['UserFavorite']['id'])) ? 'fav_on' : ''; ?>">
							<?php
							echo $this->Html->link(
								sprintf('Publisher: %s', ucwords(strtolower($item['Publisher']['publisher_name']))),
								sprintf('/favorites/add/%s/publisher', $item['Item']['publisher_id']),
								array(
									'class' => 'toggle_favorite',
									'data-type' => 'publisher',
									'data-id' => $item['Item']['publisher_id'],
									'data-val' => ucwords(strtolower($item['Publisher']['publisher_name']))
								)
							);
							?>
						</li>
						<li class="divider"></li>
						<li>
							<?php
							echo $this->Html->link(
								__('Add All to Favorites'),
								sprintf('/favorites/add/%s/all', $item['Item']['id']),
								array(
									'class' => 'toggle_favorite',
									'data-type' => 'all',
									'data-id' => $item['Item']['id']
								)
							);
							?>
						</li>
					</ul>
			</div>

			<div class="btn-group">
					<button class="btn btn-custom dropdown-toggle" data-toggle="dropdown"><i class="icon-cog icon-white"></i> <?php echo __('Tools'); ?> <span class="caret white-caret"></span></button>
					<ul class="dropdown-menu fav_menu" role="menu">
							<li><a href="/improve/item/<?php echo $item['Item']['id']; ?>"><?php echo __('Improve this content'); ?></a></li>
							<li><a href="/report/item/<?php echo $item['Item']['id']; ?>"><?php echo __('Report an issue'); ?></a></li>
							<li><a href="/flag/item/<?php echo $item['Item']['id']; ?>"><?php echo __('Flag as inappropriate'); ?></a></li>

							<?php if ($this->Session->read('Auth.User.access_level') > 50) { ?>
								<li class="divider"></li>
								<li><a href="/admin/items/edit/<?php echo $item['Item']['id']; ?>"><?php echo __('Edit Item'); ?></a></li>
								<li class="divider"></li>
								<li><div style="display: block; padding: 3px 10px; clear: both; color: #333; font-weight: bold; margin-top: 5px;">Hotness</div><div id="hotness" data-item-id="<?php echo $item['Item']['id']; ?>" data-hotness="<?php echo $item['Item']['hot']; ?>"></div></li>
							<?php } ?>
					</ul>
			</div>

	</div>
<?php } ?>