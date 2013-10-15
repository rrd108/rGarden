<?php
print $javascript->link('kert.naplo.js', false);
?>
<div class="naplok form">
<?php echo $form->create('Naplo');?>
	<fieldset>
 		<legend><?php print __('Naplóbejegyzés szerkesztése', true); ?></legend>
		<h2><?php print __('Összes költség', true) . ': <span id="osszktg">' . number_format(($this->data['Naplo']['ora']*$this->data['Munkas']['oradij'])+$this->data['Naplo']['koltseg'], 0, ',', '.') . '</span> ' . __('Ft', true); ?></h2>
	<?php
		print $form->input('p', array('type' => 'hidden', 'value' => $p));
		echo $form->input('id');
		print '<div class="input required">';
			print $form->label('munkas', __('Munkavégző', true));
			print $ajax->autoComplete('NaploMunkas',
											'/munkasok/searchMunkas',
											array(
												  'afterUpdateElement' => 'kert.naplo.munkashandler',
												  'value' => $this->data['Munkas']['munkas']
												  )
											);
		print '</div>';
		print $form->input('munkas_id', array('type' => 'hidden'));
		
		echo $form->input('datum', array('type' => 'text'));
		
		print '<div class="input required">';
			print $form->label('hely', __('Hely', true));
			print $ajax->autoComplete('NaploHely',
											'/helyek/searchHely',
											array(
												  'afterUpdateElement' => 'kert.naplo.helyhandler',
												  'value' => $this->data['Hely']['hely']
												  )
											);
		print '</div>';
		print $form->input('hely_id', array('type' => 'hidden'));
		
		print '<div class="input required">';
			print $form->label('termeny', __('Termény', true));
			print $ajax->autoComplete('NaploTermeny',
											'/termenyek/searchTermeny',
											array(
												  'afterUpdateElement' => 'kert.naplo.termenyhandler',
												  'value' => $this->data['Termeny']['termeny']
												  )
											);
		print '</div>';
		print $form->input('termeny_id', array('type' => 'hidden'));
		
		print '<div class="input required">';
			print $form->label('Szolgalat', __('Szolgálat', true));
			print $ajax->autoComplete('szolgalat',
											'/naplok/searchSzolgalat');
		print '</div>';
		
		echo $form->input('ora', array('label' => 'Óra'));
		echo $form->input('megjegyzes');
	?>
	</fieldset>
	<input id="oradij" type="hidden">
<?php echo $form->end('Submit');?>
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
