<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="/"><img src="/img/logo.png" /></a>
			<div class="nav-collapse">
				<ul class="nav">
					<li><a href="/items/this_week">New This Week</a></li>
					<li><a href="/items/next_week">New Next Week</a></li>
					<li><a href="/shops">Shops</a></li>
					<li><a href="/search">Search</a></li>

					<?php 
					if ($this->Session->read('Auth.User')) {
						echo '<li><a href="/my">My Account</a></li>';
						if ($this->Session->read('Auth.User.facebook_id')) {
							echo '<li>' . $this->Facebook->logout(array('redirect' => array('controller' => 'users', 'action' => 'logout'), 'label' => __('Logout'))) . '</li>';
						} else {
							echo '<li>' . $this->Html->link(__('Logout'), '/users/logout') . '</li>';
						}
					} else {
						echo '<li>' . $this->Html->link(__('Login / Register'), '/users/login') . '</li>';
					}
					?>

				</ul>
			</div>
		</div>
	</div>
</div>