<h1><?php echo $this->Html->link('Aomori CMS', array('controller' => 'dashboards', 'action' => 'index')); ?></h1>
<?php
if(Authsome::get('User.id')) {
	echo $this->Gravatar->image(Authsome::get('User.email'), array("default" => "identicon", "size" => 55));
	echo __(
		sprintf(
			'Logged in as %s',
			$this->Html->link(Authsome::get('User.email'), array('controller' => 'users', 'action' => 'view', Authsome::get('User.id')))
		),
		true
	);
	echo $this->Html->link(__('Account', true), array('controller' => 'users', 'action' => 'account'));
	echo $this->Html->link(__('Logout', true), array('controller' => 'logins', 'action' => 'logout'));
}
?>
