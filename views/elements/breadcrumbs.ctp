<?php
if (!empty($breadcrumbs)) {
    foreach ($breadcrumbs as $title => $url) {
		if (is_string($title)) {
			$this->Html->addCrumb($this->Html->link($title, $url));
		} else {
			$this->Html->addCrumb($this->Html->tag('span', $url, array('class' => 'fake')));
		}
    }
}

if ($crumbs = $this->Html->getCrumbs('</li><li>')) {
    echo '<div class="section"><ul class="crumbs clearfix">';
    echo '<li>' . $this->Html->link(
		'<span class="icon fam_house">&nbsp;</span>',
		array(
			'controller' => 'dashboards',
			'action' => 'index'
		),
		array(
			'class' => 'no_bg',
			'title' => 'Home',
			'escape' => false
		)
    ) . '</li>';
    echo '<li>' . $crumbs . '</li>';
    echo '</ul></div>';
}
?>
