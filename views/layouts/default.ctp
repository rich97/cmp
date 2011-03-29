<?php echo $this->Html->docType("html4-strict"); ?>
<html lang="en">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title><?php echo $title_for_layout; ?></title>
    </head>

    <body>

	    <?php
		echo $this->element('header');
		echo $this->Session->flash();

		if(Authsome::get('User.id')) {
			echo $this->element('breadcrumbs');
		}
		
		echo $content_for_layout;
		echo $scripts_for_layout;
		?>

    </body>
</html>
