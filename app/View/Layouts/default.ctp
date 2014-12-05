<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="hu-HU">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo __('Kertészeti nyilvántartó'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		print $this->Html->css('kert');
		
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
					echo $this->Html->link(__('Kertészeti nyilvántartó'), '/');
					echo ' | ' . $this->Html->link(__('Új naplóbejegyzés'), array('controller' => 'naplok', 'action' => 'add'));
					echo ' | ' . $this->Html->link(__('Naplóbejegyzések'), array('controller' => 'naplok', 'action' => 'index'));
					echo ' | ' . $this->Html->link(__('Lekérdezések'), array('controller' => 'naplok', 'action' => 'lekerdezes'));
				?>
			</h1>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>