<?php
/**
 *@var $this View
 */
?>
<div class="well">
	<ul class="nav nav-list">
		<li><?php echo $this->Html->link(__('Items'), array('controller' => 'admin', 'action' => 'items')); ?></li>
		<li><?php echo $this->Html->link(__('Categories'), array('controller' => 'admin', 'action' => 'categories')); ?></li>
		<li><?php echo $this->Html->link(__('Creators <span class="badge %s">%s</span>', ($creatorQueueTotal>0) ? 'badge-success' : '', $creatorQueueTotal), array('controller' => 'admin', 'action' => 'creators'), array('escape' => false)); ?></li>
		<li><?php echo $this->Html->link(__('Creator Types'), array('controller' => 'admin', 'action' => 'creatorTypes')); ?></li>
		<li><?php echo $this->Html->link(__('Publishers'), array('controller' => 'admin', 'action' => 'publishers')); ?></li>
		<li><?php echo $this->Html->link(__('Reports'), array('controller' => 'admin', 'action' => 'reports')); ?></li>
		<li><?php echo $this->Html->link(__('Flagged Items'), array('controller' => 'admin', 'action' => 'flags')); ?></li>
		<li><?php echo $this->Html->link(__('Series'), array('controller' => 'admin', 'action' => 'series')); ?></li>
		<li><?php echo $this->Html->link(__('Sections'), array('controller' => 'admin', 'action' => 'sections')); ?></li>
		<li><?php echo $this->Html->link(__('Stores'), array('controller' => 'admin', 'action' => 'stores')); ?></li>
		<li><?php echo $this->Html->link(__('Store Photo Queue <span class="badge %s">%s</span>', ($photoQueueTotal>0) ? 'badge-success' : '', $photoQueueTotal), '/admin/stores/photoQueue', array('escape' => false)); ?></li>
		<li><?php echo $this->Html->link(__('New Stores <span class="badge %s">%s</span>', ($newStoreTotal>0) ? 'badge-success' : '', $newStoreTotal), '/admin/stores/new', array('escape' => false)); ?></li>
		<li><?php echo $this->Html->link(__('Users'), array('controller' => 'admin', 'action' => 'users')); ?></li>
		<li><?php echo $this->Html->link(__('User Activity'), array('controller' => 'admin', 'action' => 'userActivity')); ?></li>
		<li><?php echo $this->Html->link(__('Blogs'), array('controller' => 'admin', 'action' => 'blogs')); ?></li>
		<li class="divider"></li>
		<li><?php echo $this->Html->link(__('Index'), '/'); ?></li>
		<li class="divider"></li>
		<li><?= $this->Session->read('Auth.User.email'); ?></li>
	</ul>
</div>