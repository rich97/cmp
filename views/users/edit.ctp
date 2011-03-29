<?php echo $this->Form->create('User'); ?>
<fieldset>
    <legend>
		<?php
			$translations = array(
				'Setup' => __('Setup', true),
				'Add' => __('Add', true),
				'Edit' => __('Edit', true)
			);
			echo $translations[Inflector::humanize($this->action)];
		?>
	</legend>
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
