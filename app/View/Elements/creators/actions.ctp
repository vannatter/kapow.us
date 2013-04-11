<?php if($this->Session->read('Auth.User')) { ?>
	<div class="item_actions">
		<?php echo $this->Common->addFavButton($creator['Creator']['id'], 'creator', $userFav); ?>
			<div class="btn-group">
					<button class="btn btn-custom dropdown-toggle" data-toggle="dropdown"><i class="icon-cog icon-white"></i> Tools <span class="caret white-caret"></span></button>
					<ul class="dropdown-menu fav_menu" role="menu">
							<li><a href="/improve/c/<?php echo $creator['Creator']['id']; ?>">Improve this content</a></li>
							<li><a href="/report/c/<?php echo $creator['Creator']['id']; ?>">Report an issue</a></li>
							<li><a href="/flag/c/<?php echo $creator['Creator']['id']; ?>">Flag as inappropriate</a></li>
							<?php if ($this->Session->read('Auth.User.access_level') > 50) { ?>
								<li class="divider"></li>
								<li><a href="/admin/creators/edit/<?php echo $creator['Creator']['id']; ?>">Edit this creator</a></li>
							<?php } ?>
					</ul>
			</div>
	</div>
<?php } ?>