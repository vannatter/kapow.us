<?php if($this->Session->read('Auth.User')) { ?>
<div class="item_actions">

	<div class="btn-group">
		<button class="btn btn-custom dropdown-toggle" data-toggle="dropdown"><i class="icon-cog icon-white"></i> <?php echo __('Tools'); ?> <span class="caret white-caret"></span></button>
		<ul class="dropdown-menu fav_menu" role="menu">

			<li><?php echo $this->Html->link(__('Report an Issue'), sprintf('/report/store/%s', $shop['Store']['id'])); ?></li>
			<li><?php echo $this->Html->link(__('Flag as Inappropriate'), sprintf('/flag/store/%s', $shop['Store']['id'])); ?></li>

			<li class="divider"></li>

			<li><?php echo $this->Html->link(__('Add Image'), sprintf('/shops/addImage/%s', $shop['Store']['id'])); ?></li>

			<?php if ($this->Session->read('Auth.User.access_level') > 50) { ?>
				<li class="divider"></li>
				<li><?php echo $this->Html->link(__('Edit Store'), sprintf('/admin/stores/edit/%s', $shop['Store']['id']), array('target' => '_blank')); ?></li>
			<?php } ?>

		</ul>
	</div>

</div>
<?php } ?>