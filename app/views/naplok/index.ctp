<div class="naplok index">
<h2><?php __('Naplók');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<div class="paging">
	<?php
		echo $paginator->first('<=');
		echo ' | ' . $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));
		echo ' | ' . $paginator->numbers();
		echo ' | ' . $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));
		echo ' | ' . $paginator->last('=>');
	?>
</div>

<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('munkas_id');?></th>
	<th><?php echo $paginator->sort('hely_id');?></th>
	<th><?php echo $paginator->sort('datum');?></th>
	<th><?php echo $paginator->sort('szolgalat');?></th>
	<th><?php echo $paginator->sort('ora');?></th>
	<th><?php echo 'Óradíj';?></th>
	<th><?php echo $paginator->sort('termeny_id');?></th>
	<th><?php echo $paginator->sort('megjegyzes');?></th>
	<th class="actions"><?php __('Actions');?></th>
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
			<?php echo $html->link($naplo['Munkas']['munkas'], array('controller' => 'munkasok', 'action' => 'view', $naplo['Munkas']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($naplo['Hely']['hely'], array('controller' => 'helyek', 'action' => 'view', $naplo['Hely']['id'])); ?>
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
			<?php echo $html->link($naplo['Termeny']['termeny'], array('controller' => 'termenyek', 'action' => 'view', $naplo['Termeny']['id'])); ?>
		</td>
		<td>
			<?php echo $naplo['Naplo']['megjegyzes']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Muti', true), array('action' => 'view', $naplo['Naplo']['id'])); ?>
			<?php echo $html->link(__('Szerk', true), array('action' => 'edit', $naplo['Naplo']['id'])); ?>
			<?php echo $html->link(__('Del', true), array('action' => 'delete', $naplo['Naplo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $naplo['Naplo']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Új naplóbejegyzés', true), array('action' => 'add'));?></li>
		<li><?php echo $html->link(__('Naplóbejegyzések', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('Munkások', true), array('controller' => 'munkasok', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('Helyek', true), array('controller' => 'helyek', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('Termények', true), array('controller' => 'termenyek', 'action' => 'index')); ?> </li>
	</ul>
</div>
