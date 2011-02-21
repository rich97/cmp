<div class="section">
	<div class="pad">
		<h2>Viewing <?php echo $user['User']['username'] ?></h2>
		<h3>Profile</h3>
		<dl class="dl_table clearfix">
			<dt>Picture:</dt>
				<dd><?php echo $this->Gravatar->image($user['User']['email']); ?></dd>
			<dt>Email address</dt>
				<dd><?php echo $this->Html->link($user['User']['email'], 'mailto:'.$user['User']['email']); ?></dd>
		</dl>
		<h3>Other</h3>
		<dl class="dl_table clearfix">
            <dt>Created on:</dt>
				<dd>
				<?php
					if ($user['User']['created'] !== '<em>&ndash;</em>') {
						$user['User']['created'] = $this->Time->timeAgoInWords(
							$user['User']['created']
						);
					}
					echo $user['User']['created'];
				?>
				</dd>
			<dt>Last modified:</dt>
				<dd>
				<?php
					if ($user['User']['modified'] !== '<em>&ndash;</em>') {
						$user['User']['modified'] = $this->Time->timeAgoInWords(
							$user['User']['modified']
						);
					}
					echo $user['User']['modified'];
				?>
				</dd>
		</dl>
	</div>
</div>