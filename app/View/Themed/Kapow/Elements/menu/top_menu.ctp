<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="/"><img src="/theme/Kapow/img/logo.png" width="200" height="103" alt="Kapow" /></a>
			<div class="nav-collapse">
				<ul class="nav">
					<li><?php echo $this->Html->link(__('New This Week'), array('controller' => 'items', 'action' => 'this_week')); ?></li>
					<li><?php echo $this->Html->link(__('New Next Week'), array('controller' => 'items', 'action' => 'next_week')); ?></li>
					<li><?php echo $this->Html->link(__('Shops'), array('controller' => 'shops', 'action' => '/')); ?></li>
					<li><?php echo $this->Html->link(__('Search'), array('controller' => 'search')); ?></li>

					<?php 
						if ($this->Session->read('Auth.User')) {
							echo sprintf('<li>%s</li>', $this->Html->link(__('My Account'), array('controller' => 'my')));
							if ($this->Session->read('Auth.User.logged_in_with') == "kapow") {
								echo sprintf('<li>%s</li>', $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')));
							} else {
								echo sprintf('<li>%s</li>', $this->Facebook->logout(array('redirect' => array('controller' => 'users', 'action' => 'logout'), 'id' => false, 'label' => __('Logout'))));
							}
						} else {
							echo sprintf('<li>%s</li>', $this->Html->link(__('Login / Register'), array('controller' => 'users', 'action' => 'login')));
						}
					?>

				</ul>
			</div>
		</div>
	</div>
</div>