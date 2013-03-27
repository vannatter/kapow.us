<?php
/**
 *@var $this View
 */
?>
<div class="span12 nav-list-frame">
	<ul class="nav nav-list">
		<li><?php echo $this->Html->link(__('Items'), array('controller' => 'admin', 'action' => 'items')); ?></li>
		<li><?php echo $this->Html->link(__('Categories'), array('controller' => 'admin', 'action' => 'categories')); ?></li>
		<li><?php echo $this->Html->link(__('Creators'), array('controller' => 'admin', 'action' => 'creators')); ?></li>
		<li><?php echo $this->Html->link(__('Creator Types'), array('controller' => 'admin', 'action' => 'creatorTypes')); ?></li>
		<li><?php echo $this->Html->link(__('Publishers'), array('controller' => 'admin', 'action' => 'publishers')); ?></li>
		<li><?php echo $this->Html->link(__('Series'), array('controller' => 'admin', 'action' => 'series')); ?></li>
		<li><?php echo $this->Html->link(__('Stores'), array('controller' => 'admin', 'action' => 'stores')); ?></li>
		<li><?php echo $this->Html->link(__('Users'), array('controller' => 'admin', 'action' => 'users')); ?></li>
		<li class="divider"></li>
		<li><?= $this->Session->read('Auth.User.email'); ?></li>
	</ul>
</div>