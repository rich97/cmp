<div class="section">
    <div class="pad">
		<?php
            echo $this->Form->create(
                'User',
                array('url' => array('controller' => 'logins', 'action' => 'index'))
            );
        ?>
		<fieldset>
			<legend><?php __('Please enter your login details'); ?></legend>
			<?php
				echo $this->Form->input('username', array('label' => __('Username', true)));
				echo $this->Form->input('password', array('label' => __('Password', true)));
			?>
		</fieldset>
		<fieldset class="submit clearfix">
			<div class="go">
				<?php echo $this->Form->submit(__('Login', true), array('div' => false)); ?>
			</div>
		</fieldset>
		<?php echo $this->Form->end(); ?>
    </div>
</div>