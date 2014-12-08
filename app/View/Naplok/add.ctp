<?php
print $this->Html->script('kert.naplo.js', false);
?>
<div class="naplok form">
<?php echo $this->Form->create('Naplo');?>
	<fieldset>
 		<legend><?php echo __('Új naplóbejegyzés');?></legend>
		<h2><?php print __('Összes költség') . ': <span id="osszktg">0</span> ' . __('Ft'); ?></h2>
	<?php
		//echo $this->Form->input('munkas_id', array('empty' => ' --- válassz --- '));
		print '<div class="input required">';
			print $this->Form->label('munkas', __('Munkavégző'));
			print $this->autoComplete->create('NaploMunkas',
											'/munkasok/searchMunkas',
											array(
												  'autocompleterOptions' => '{afterUpdateElement : kert.naplo.munkashandler}',
												  'value' => isset($munkas) ? $munkas : ''
												  )
											);
		print '</div>';
		print $this->Form->input('munkas_id', array(
													'type' => 'hidden',
													'value' => isset($this->request->data['Naplo']['munkas_id']) ? $this->request->data['Naplo']['munkas_id'] : null));
		
		echo $this->Form->input('datum', array('type' => 'text'));

		//echo $this->Form->input('hely_id', array('empty' => ' --- válassz --- '));
		print '<div class="input required">';
			print $this->Form->label('hely', __('Hely'));
			print $this->autoComplete->create('NaploHely',
											'/helyek/searchHely',
											array(
												  'autocompleterOptions' => '{afterUpdateElement : kert.naplo.helyhandler}'
												  )
											);
		print '</div>';
		print $this->Form->input('hely_id', array('type' => 'hidden'));

		//echo $this->Form->input('termeny_id');
		print '<div class="input required">';
			print $this->Form->label('termeny', __('Termény'));
			print $this->autoComplete->create('NaploTermeny',
											'/termenyek/searchTermeny',
											array(
												  'autocompleterOptions' => '{afterUpdateElement : kert.naplo.termenyhandler}'
												  )
											);
		print '</div>';
		print $this->Form->input('termeny_id', array('type' => 'hidden', 'value' => 1));
		
		print '<div class="input required">';
			print $this->Form->label('Szolgalat', __('Szolgálat'));
			print $this->autoComplete->create('szolgalat',
											'/naplok/searchSzolgalat');
		print '</div>';
		echo $this->Form->input('ora');
		echo $this->Form->input('megjegyzes');

		/*echo $this->Form->input('szolgtipus_id', array('empty' => ' --- válassz --- '));
		
		echo $this->Form->input('mennyiseg');
		echo $this->Form->input('mennyisegiegyseg_id');
		
		echo $this->Form->input('felhasznalt');
		echo $this->Form->input('koltseg');
		echo $this->Form->input('vevo_id');*/
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
