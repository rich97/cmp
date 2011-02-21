<?php
$navigation = array(
	'System' => array(
		array(
			'Users',
			array('controller' => 'users', 'action' => 'index')
		),
	)
);
echo '<div id="navigation">';
$user = Authsome::get();
if ($user) {
	foreach ($navigation as $heading => $nav) {
		foreach ($nav as $nKey => $link) {
			if (isset($link[1]) && !empty($link[1])) {
				if (isset($link[1]['controller']) && $link[1]['controller'] == $this->params['controller']) {
					$nav[$nKey][] = array('class' => 'hover');
				}
			}
		}

		if ($nav) {
			echo '<div class="category">';
				echo "<h4>{$heading}</h4>";
				echo '<ul>';
				foreach($nav as $link) {
					if (!empty($link[1])) {
						list($title, $url) = $link;
						echo "<li>{$this->Html->link($title, $url)}</li>";
					}
				}
				echo '</ul>';
			echo '</div>';
			$empty = false;
		}
	}
} else {
	echo '<div class="category">';
		echo '<h4>Navigation</h4>';
		echo '<ul><li class="fake_nav"><em>Empty</em></li></ul>';
	echo '</div>';
}
echo '</div>';
?>
