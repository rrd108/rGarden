<?php
print $javascript->link('kert.naplo.js', false);
?>
<div class="naplok form">
<?php echo $this->Form->create('Naplo');?>
	<fieldset>
 		<legend><?php print __('Naplóbejegyzés szerkesztése'); ?></legend>
		<h2><?php print __('Összes költség') . ': <span id="osszktg">' . number_format(($this->request->data['Naplo']['ora']*$this->request->data['Munkas']['oradij'])+$this->request->data['Naplo']['koltseg'], 0, ',', '.') . '</span> ' . __('Ft'); ?></h2>
	<?php
		print $this->Form->input('p', array('type' => 'hidden', 'value' => $p));
		echo $this->Form->input('id');
		print '<div class="input required">';
			print $this->Form->label('munkas', __('Munkavégző'));
			print $this->autoComplete->create('NaploMunkas',
											'/munkasok/searchMunkas',
											array(
												  'afterUpdateElement' => 'kert.naplo.munkashandler',
												  'value' => $this->request->data['Munkas']['munkas']
												  )
											);
		print '</div>';
		print $this->Form->input('munkas_id', array('type' => 'hidden'));
		
		echo $this->Form->input('datum', array('type' => 'text'));
		
		print '<div class="input required">';
			print $this->Form->label('hely', __('Hely'));
			print $this->autoComplete->create('NaploHely',
											'/helyek/searchHely',
											array(
												  'afterUpdateElement' => 'kert.naplo.helyhandler',
												  'value' => $this->request->data['Hely']['hely']
												  )
											);
		print '</div>';
		print $this->Form->input('hely_id', array('type' => 'hidden'));
		
		print '<div class="input required">';
			print $this->Form->label('termeny', __('Termény'));
			print $this->autoComplete->create('NaploTermeny',
											'/termenyek/searchTermeny',
											array(
												  'afterUpdateElement' => 'kert.naplo.termenyhandler',
												  'value' => $this->request->data['Termeny']['termeny']
												  )
											);
		print '</div>';
		print $this->Form->input('termeny_id', array('type' => 'hidden'));
		
		print '<div class="input required">';
			print $this->Form->label('Szolgalat', __('Szolgálat'));
			print $this->autoComplete->create('szolgalat',
											'/naplok/searchSzolgalat');
		print '</div>';
		
		echo $this->Form->input('ora', array('label' => 'Óra'));
		echo $this->Form->input('megjegyzes');
	?>
	</fieldset>
	<input id="oradij" type="hidden">
<?php echo $this->Form->end('Submit');?>
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
