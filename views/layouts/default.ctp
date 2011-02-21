<?php echo $this->Html->docType("html4-strict"); ?>
<html lang="en">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title><?php echo $title_for_layout; ?></title>
    </head>

    <body>

	<div id="wrapper">

	    <?php echo $this->element('header'); ?>

	    <div id="body" class="clearfix">

		<?php echo $this->element('navigation'); ?>

		<div id="content">
		    <?php
				echo $this->Session->flash();
				if(Authsome::get('User.id')) {
					echo $this->element('breadcrumbs');
				}
				echo $content_for_layout;
		    ?>
		</div>

	    </div>

	    <div id="footer_shadow"></div>
	    <div id="push_footer"></div>

	</div>

	<?php echo $this->element('footer'); ?>

	<?php echo $scripts_for_layout; ?>

    </body>
</html>
