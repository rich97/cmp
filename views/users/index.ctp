<div class="section">

    <ul class="toolbar clearfix">
        <li class="first"><?php echo $this->Html->link(__('Add', true), array('action' => 'add'), array('class' => 'iBlock_text fam_add')); ?></li>
        <li><?php echo $this->Html->link(__('Delete Selected', true), array('action' => 'delete'), array('class' => 'iBlock_text fam_delete', 'id' => 'delete_button', 'rel' => __('Are you sure you want to delete the selected records?', true))); ?></li>
    </ul>
	<?php echo $this->element('search'); ?>

    <div class="pad">

	<?php echo $this->Form->create('User', array('action' => 'delete', 'id' => 'delete_form')); ?>

	<h2><?php echo 'Users'; ?></h2>

    <table class="index">
	    <thead>
			<th><?php echo $this->Html->link('Select All', '#', array('id' => 'toggleselect_button')) ?></th>
			<th><?php echo 'Avatar'; ?></th>
			<th><?php echo $this->Paginator->sort('Username', 'User.username'); ?></th>
			<th><?php echo $this->Paginator->sort('Email', 'User.email'); ?></th>
			<th><?php echo $this->Paginator->sort('Created', 'User.created'); ?></th>
			<th>&nbsp;</th>
	    </thead>
	    <tbody>
		<?php foreach ($data as $key => $item): ?>
		    <tr<?php echo ($key % 2) ? ' class="even_row"' : ' class="odd_row"'; ?>>
				<td><?php echo $this->Form->checkbox("User.id.{$item['User']['id']}", array('hiddenField' => false)); ?></td>
				<td><?php echo $this->Gravatar->image($item['User']['email'], array('size' => 30)); ?></td>
				<td><?php echo $this->Html->link($item['User']['username'], array('action' => 'view', $item['User']['id'])); ?></td>
				<td><?php echo $item['User']['email']; ?></td>
				<td>
				<?php
					if ($item['User']['created']) {
						echo $this->Time->timeAgoInWords($item['User']['created']);
					} else {
						echo '<em>&ndash;</em>';
					}
				?>
				</td>
				<td class="actions">
				<?php
                    echo $this->Html->link('', array('action' => 'edit', $item['User']['id']), array('class' => 'iIcon fam_pencil', 'title' => 'Edit'));
                    echo $this->Html->link('', array('action' => 'delete', $item['User']['id']), array('class' => 'iIcon fam_delete', 'title' => 'Delete'), "Are you sure you want to delete {$item['User']['username']}?");
				?>
				</td>
		    </tr>
		<?php endforeach; ?>
	    </tbody>
	</table>

	<?php echo $this->element('pagination') ?>
    <?php echo $this->Form->end(); ?>

    </div>
</div>
