<table width="100%" height="100%" valign="middle" align="middle">
	<tr align="middle" valign="middle">
		<td align="middle" valign="middle">
			<img src="/img/logo.png" />
		</td>
	</tr>
	<tr>
		<td>
			<?php
			if($this->Session->read('Auth.User')) {
				if($this->Session->read('Auth.User.facebook_id')) {
					echo $this->Facebook->logout(array('redirect' => array('controller' => 'users', 'action' => 'logout'), 'label' => __('logout')));
				} else {
					echo $this->Html->link(__('logout'), '/users/logout');
				}

				echo " - " . $this->Session->read('Auth.User.email');
			} else {
				echo $this->Html->link(__('login / register'), '/users/login');
				echo " | ";
				echo $this->Facebook->login(array('custom' => true, 'img' => 'connectwithfacebook.gif', 'show-faces' => false, 'perms' => 'email'));
			}
			?>
		</td>
	</tr>
</table>