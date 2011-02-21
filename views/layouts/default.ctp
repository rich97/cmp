<?php echo $this->Html->docType("html4-strict"); ?>
<html lang="en">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title><?php echo $title_for_layout; ?></title>
		<?php
			echo $this->Html->css('/cmp/css/core/basic', 'stylesheet', array('media' => 'screen, projector'));
			echo $this->Html->css('/cmp/css/core/design', 'stylesheet', array('media' => 'screen, projector'));
			echo $this->Html->css('/cmp/css/core/layout', 'stylesheet', array('media' => 'screen, projector'));
			echo $this->Html->css('/cmp/css/core/icons', 'stylesheet', array('media' => 'screen, projector'));
			echo $this->Html->css('/cmp/css/core/print', 'stylesheet', array('media' => 'print'));
		?>
		<!--[if lte IE 7]>
			<?php echo $this->Html->css('/cmp/css/core/ie', 'stylesheet', array('media' => 'screen, projector')); ?>
		<![endif]-->
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

	<?php
	    echo $this->Html->script('/cmp/js/core/jquery');
	    echo $this->Html->script('/cmp/js/core/table_sort/tablednd');
	    echo $this->Html->script('/cmp/js/core/table_sort/tablednd_init');
	    echo $this->Html->script('/cmp/js/core/index_tables');
	    echo $this->Html->script('/cmp/js/core/forms');
	    echo $scripts_for_layout;
	?>

    </body>
</html>
