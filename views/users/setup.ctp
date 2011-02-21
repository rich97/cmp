<div class="section">
    <div class="pad">
	<?php echo $this->Form->create('User'); ?>
	<fieldset>
	    <legend><?php __('Setup'); ?></em></legend>
	    <?php
            echo $this->Form->input('username', array('label' => __('Username', true)));
            echo $this->Form->input('email', array('label' => __('Email', true)));
	    ?>
	</fieldset>
	<fieldset class="submit clearfix">
	    <div class="go">
			<?php echo $this->Form->submit(__('Add User', true), array('div' => false)); ?>
	    </div>
	    <div class="cancel">
			<?php echo $this->Html->link(__('Cancel', true), array('action' => 'index')); ?>
	    </div>
	</fieldset>
	<?php echo $this->Form->end(); ?>
    </div>
</div>
