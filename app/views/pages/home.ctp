<div>
	<h2>Naplók</h2>
	<ul>
		<li><?php echo $html->link(__('Új naplóbejegyzés', true), array('controller' => 'naplok', 'action' => 'add'));?></li>
		<li><?php echo $html->link(__('Naplóbejegyzések', true), array('controller' => 'naplok', 'action' => 'index'));?></li>
		<li><?php echo $html->link(__('Lekérdezések', true), array('controller' => 'naplok', 'action' => 'lekerdezes'));?></li>
	</ul>
	
	<h2>Törzsadatok</h2>
	<ul>
		<li><?php echo $html->link(__('Munkások', true), array('controller' => 'munkasok', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('Helyek', true), array('controller' => 'helyek', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('Termények', true), array('controller' => 'termenyek', 'action' => 'index')); ?> </li>
	</ul>
</div>
