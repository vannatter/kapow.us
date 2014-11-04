<?php
/**
 * @var $this View
 */
?>
<?php if ($this->Session->read('Auth.User')) { ?>
	<div class="item_actions">
		<?php echo $this->Common->addFavButton($user['User']['id'], 'user', $userFav); ?> 
	</div>
<?php } ?>