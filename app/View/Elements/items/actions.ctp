<?php
/**
 *@var $this View
 */
?>
<?php if($this->Session->read('Auth.User')) { ?>
	<?php $this->Html->script('page/items.js', array('inline' => false)); ?>
	<div class="item_actions">

		<button class="btn btn-custom pull_list_btn" type="button" data-id="<?php echo $item['Item']['id']; ?>"><i class="icon-shopping-cart icon-white"></i> <span><?php echo (isset($item['Pull']['id'])) ? __('Remove Pull') : __('Pull List'); ?></span></button>

			<div class="btn-group">
					<button class="btn btn-custom dropdown-toggle" data-toggle="dropdown"><i class="icon-heart icon-white"></i> Favorite <span class="caret white-caret"></span></button>
					<ul class="dropdown-menu fav_menu" role="menu">

						<?php foreach ($unique_creators as $k=>$v) { ?>
							<li>
								<?php
								echo $this->Html->link(
									sprintf('Creator: %s', $v['name']),
									sprintf('/favorites/add/%s/creator', $k),
									array(
										'style' => ($v['is_fav']) ? 'font-weight: bold;' : '',
										'class' => 'toggle_favorite',
										'data-type' => 'creator',
										'data-id' => $k
									)
								);
								?>
							</li>
						<?php } ?>
						<li>
							<?php
							echo $this->Html->link(
								sprintf('Series: %s', $item['Series']['series_name']),
								sprintf('/favorites/add/%s/series', $item['Item']['series_id']),
								array(
									'style' => (isset($item['Series']['UserFavorite']['id'])) ? 'font-weight: bold;' : '',
									'class' => 'toggle_favorite',
									'data-type' => 'series',
									'data-id' => $item['Item']['series_id']
								)
							);
							?>
						</li>
						<li>
							<?php
							echo $this->Html->link(
								sprintf('Publisher: %s', ucwords(strtolower($item['Publisher']['publisher_name']))),
								sprintf('/favorites/add/%s/publisher', $item['Item']['publisher_id']),
								array(
									'style' => (isset($item['Publisher']['UserFavorite']['id'])) ? 'font-weight: bold;' : '',
									'class' => 'toggle_favorite',
									'data-type' => 'publisher',
									'data-id' => $item['Item']['publisher_id']
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
					<button class="btn btn-custom dropdown-toggle" data-toggle="dropdown"><i class="icon-cog icon-white"></i> Tools <span class="caret white-caret"></span></button>
					<ul class="dropdown-menu fav_menu" role="menu">
							<li><a href="/improve/item/<?php echo $item['Item']['id']; ?>"><?php echo __('Improve this content'); ?></a></li>
							<li><a href="/report/item/<?php echo $item['Item']['id']; ?>"><?php echo __('Report an issue'); ?></a></li>
							<li><a href="/flag/item/<?php echo $item['Item']['id']; ?>"><?php echo __('Flag as inappropriate'); ?></a></li>

							<?php if ($this->Session->read('Auth.User.access_level') > 50) { ?>
								<li class="divider"></li>
								<li><a href="/admin/items/edit/<?php echo $item['Item']['id']; ?>"><?php echo __('Edit Item'); ?></a></li>
							<?php } ?>
					</ul>
			</div>

	</div>
<?php } ?>