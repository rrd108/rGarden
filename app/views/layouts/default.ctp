<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="hu-HU">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('Kertészeti nyilvántartó'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->meta('icon');

		echo $html->css('cake.generic');
		print $html->css('kert');
		
		print $javascript->link('prototype');
		print $javascript->link('scriptaculous'); 
		print $javascript->link('inputmask');
		print $javascript->link('kert');
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>
				<?php
					echo $html->link(__('Kertészeti nyilvántartó', true), '/');
					echo ' | ' . $html->link(__('Új naplóbejegyzés', true), array('controller' => 'naplok', 'action' => 'add'));
					echo ' | ' . $html->link(__('Naplóbejegyzések', true), array('controller' => 'naplok', 'action' => 'index'));
					echo ' | ' . $html->link(__('Lekérdezések', true), array('controller' => 'naplok', 'action' => 'lekerdezes'));
				?>
			</h1>
		</div>
		<div id="content">

			<?php echo $session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>