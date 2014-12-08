<div>
	<h2><?php echo __('Naplók'); ?></h2>
	<ul>
		<li><?php echo $this->Html->link(__('Új naplóbejegyzés'), array('controller' => 'naplok', 'action' => 'add'));?></li>
		<li><?php echo $this->Html->link(__('Naplóbejegyzések'), array('controller' => 'naplok', 'action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Lekérdezések'), array('controller' => 'naplok', 'action' => 'lekerdezes'));?></li>
	</ul>
	
	<h2><?php echo __('Törzsadatok'); ?></h2>
	<ul>
		<li><?php echo $this->Html->link(__('Munkások'), array('controller' => 'munkasok', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Helyek'), array('controller' => 'helyek', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Termények'), array('controller' => 'termenyek', 'action' => 'index')); ?> </li>
	</ul>
</div>
