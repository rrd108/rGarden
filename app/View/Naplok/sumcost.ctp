<div class="naplok index">
<?php
	if(isset($sumcost)){
		//debug($sumcost);
		/*
		(int) 0 => array(
			'termenyek' => array(
				'termeny' => 'Édeskömény'
			),
			(int) 0 => array(
				'sumcost' => '12131.50'
			)
		),
		*/
		print '<table>';
			print '<tr>';
				print '<th>' . __('Termény') . '</th>';
				print '<th>' . __('Összköltség') . '</th>';
			print '</tr>';
			
			$osszes = 0;
			foreach($sumcost as $i => $e){
				$osszes += $e[0]['sumcost'];
				print '<tr' . (($i%2)?' class="altrow"':'') . '>';
					print '<td>';
						print $this->Html->link($e['termenyek']['termeny'],
												array('action' => 'lekerdezes/' . $e['termenyek']['id']));
					print '</td>';
					print '<td class="r">' . number_format($e[0]['sumcost'], 0, '', '.') . '</td>';
				print '</tr>';
			}
			print '<tr class="b">';
				print '<td>' . __('Összesen') . '</td>';
				print '<td class="r">' . number_format($osszes, 0, '', '.') . '</td>';
			print '</tr>';
		print '</table>';
	}
?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Új naplóbejegyzés'), array('action' => 'add'));?></li>
		<li><?php echo $this->Html->link(__('Naplóbejegyzések'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Munkások'), array('controller' => 'munkasok', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Helyek'), array('controller' => 'helyek', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Termények'), array('controller' => 'termenyek', 'action' => 'index')); ?> </li>
	</ul>
</div>
