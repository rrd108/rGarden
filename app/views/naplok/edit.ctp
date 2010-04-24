<?php
print $javascript->link('kert.naplo.js', false);
?>
<div class="naplok form">
<?php echo $form->create('Naplo');?>
	<fieldset>
 		<legend><?php print 'Naplóbejegyzés szerkesztése'; ?></legend>
		<h2><?php print 'Összes költség: <span id="osszktg">' . number_format(($this->data['Naplo']['ora']*$this->data['Munkas']['oradij'])+$this->data['Naplo']['koltseg'], 0, ',', '.') . '</span> Ft'; ?></h2>
	<?php
		echo $form->input('id');
		echo $form->input('munkas_id');
		echo $form->input('hely_id');
		echo $form->input('szolgalat');
		echo $form->input('szolgtipus_id');
		echo $form->input('datum', array('type' => 'text'));
		echo $form->input('ora', array(
												'label' => 'Óra'
												 )
								);
		echo $form->input('mennyiseg');
		echo $form->input('mennyisegiegyseg_id');
		echo $form->input('termeny_id');
		echo $form->input('felhasznalt');
		echo $form->input('koltseg', array(
												'label' => 'Költség'
												)
								);
		echo $form->input('vevo_id');
		echo $form->input('megjegyzes');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Új naplóbejegyzés', true), array('action' => 'add'));?></li>
		<li><?php echo $html->link(__('Naplóbejegyzések', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('Munkások', true), array('controller' => 'munkasok', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('Helyek', true), array('controller' => 'helyek', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('Szolgálattipusok', true), array('controller' => 'szolgtipusok', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('Termények', true), array('controller' => 'termenyek', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('Vevők', true), array('controller' => 'vevok', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('Mennyiségi egységek', true), array('controller' => 'mennyisegiegysegek', 'action' => 'index')); ?> </li>
	</ul>
</div>
