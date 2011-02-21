<div id="header" class="clearfix">
    <h1 id="header_left">
	<?php
	    echo $this->Html->link(
			'Aomori CMS',
			array(
				'controller' => 'dashboards',
				'action' => 'index'
			)
	    );
	?>
    </h1>
    <div id="header_right" class="clearfix">
	<?php if(Authsome::get('User.id')) : ?>
		<?php $user = Authsome::get(); ?>
	    <div class="header_gravatar">
			<?php echo $this->Gravatar->image($user['User']['email'], array("default" => "identicon", "size" => 55)); ?>
	    </div>
	    <div class="user_info">
	    <?php
			$profile = $this->Html->link($user['User']['username'], array('controller' => 'users', 'action' => 'view', $user['User']['id']));
			echo '<div class="info">';
				$logged_in = __('Logged in as', true);
				echo "<div>{$logged_in} {$profile}</div>";
				echo "<div>{$this->Html->link(__('Account Settings', true), array('controller' => 'users', 'action' => 'account'))}</div>";
				echo "<div>{$this->Html->link(__('Logout', true), array('controller' => 'logins', 'action' => 'logout'))}</div>";
			echo '</div>';
	    ?>
	    </div>
	<?php endif; ?>
    </div>
</div>