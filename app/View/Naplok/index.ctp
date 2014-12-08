<div class="naplok index">
<h2><?php echo __('Naplók');?></h2>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
));
?></p>
<div class="paging">
	<?php
		echo $this->Paginator->first('<=');
		echo ' | ' . $this->Paginator->prev('<< '.__('previous'), array(), null, array('class'=>'disabled'));
		echo ' | ' . $this->Paginator->numbers();
		echo ' | ' . $this->Paginator->next(__('next').' >>', array(), null, array('class' => 'disabled'));
		echo ' | ' . $this->Paginator->last('=>');
	?>
</div>

<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $this->Paginator->sort('munkas_id');?></th>
	<th><?php echo $this->Paginator->sort('hely_id');?></th>
	<th><?php echo $this->Paginator->sort('datum');?></th>
	<th><?php echo $this->Paginator->sort('szolgalat');?></th>
	<th><?php echo $this->Paginator->sort('ora');?></th>
	<th><?php echo 'Óradíj';?></th>
	<th><?php echo $this->Paginator->sort('termeny_id');?></th>
	<th><?php echo $this->Paginator->sort('megjegyzes');?></th>
	<th class="actions"><?php echo __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($naplok as $naplo):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php
			echo '<a name="' . $naplo['Naplo']['id'] . '"></a>';
			echo $this->Html->link($naplo['Munkas']['munkas'],
								   array(
										'controller' => 'munkasok',
										'action' => 'view', $naplo['Munkas']['id']));
			?>
		</td>
		<td>
			<?php echo $this->Html->link($naplo['Hely']['hely'], array('controller' => 'helyek', 'action' => 'view', $naplo['Hely']['id'])); ?>
		</td>
		<td>
			<?php echo $naplo['Naplo']['datum']; ?>
		</td>
		<td>
			<?php echo $naplo['Naplo']['szolgalat']; ?>
		</td>
		<td>
			<?php echo $naplo['Naplo']['ora']; ?>
		</td>
		<td>
			<?php echo number_format(($naplo['Naplo']['ora']*$naplo['Munkas']['oradij']), 0, ',', '.'); ?>
		</td>
		<td>
			<?php echo $this->Html->link($naplo['Termeny']['termeny'], array('controller' => 'termenyek', 'action' => 'view', $naplo['Termeny']['id'])); ?>
		</td>
		<td>
			<?php echo $naplo['Naplo']['megjegyzes']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Muti'), array('action' => 'view', $naplo['Naplo']['id'])); ?>
			<?php echo $this->Html->link(__('Szerk'), array('action' => 'edit', $naplo['Naplo']['id'],  $this->Paginator->current())); ?>
			<?php echo $this->Html->link(__('Del'), array('action' => 'delete', $naplo['Naplo']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $naplo['Naplo']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('previous'), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('next').' >>', array(), null, array('class' => 'disabled'));?>
</div>

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
