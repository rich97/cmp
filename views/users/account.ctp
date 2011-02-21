<div class="section">
    <div class="pad">
	<h2><?php __('Edit Your Account'); ?></h2>
	<?php
	    echo $this->Form->create('User');
	    echo $this->Form->hidden('id');
	?>
	<fieldset>
	    <legend><?php __('User'); ?></legend>
            <?php
				echo $this->Form->input('username', array('label' => __('Username', true)));
				echo $this->Form->input('email', array('label' => __('Email', true)));
			?>
	</fieldset>
	<fieldset>
	    <legend><?php __('Change Password'); ?></legend>
            <p><?php _('To change your password, fill in all of the fields bellow.'); ?></p>
            <?php
				$pass = array('type' => 'password');
				echo $this->Form->input('current_password', array_merge($pass, array('label' => __('Current Password', true))));
				echo $this->Form->input('new_password', array_merge($pass, array('label' => __('New Password', true))));
				echo $this->Form->input('confirm_new_password', array_merge($pass, array('label' => __('Confirm New Password', true))));
			?>
	</fieldset>
	<fieldset class="submit clearfix">
	    <div class="go">
			<?php echo $this->Form->submit(__('Update Account', true), array('div' => false)); ?>
	    </div>
	    <div class="cancel">
			<?php echo $this->Html->link(__('Cancel', true), array('action' => 'index')); ?>
	    </div>
	</fieldset>
	<?php echo $this->Form->end(); ?>
    </div>
</div>