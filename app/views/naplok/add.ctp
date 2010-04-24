<?php
print $javascript->link('kert.naplo.js', false);

?>
<div class="naplok form">
<?php echo $form->create('Naplo');?>
	<fieldset>
 		<legend><?php __('Új naplóbejegyzés');?></legend>
		<h2><?php print 'Összes költség: <span id="osszktg">0</span> Ft'; ?></h2>
	<?php
		echo $form->input('munkas_id', array('empty' => ' --- válassz --- '));
		echo $form->input('hely_id', array('empty' => ' --- válassz --- '));
		echo $form->input('szolgalat');
		echo $form->input('szolgtipus_id', array('empty' => ' --- válassz --- '));
		echo $form->input('datum', array('type' => 'text'));
		echo $form->input('ora');
		echo $form->input('mennyiseg');
		echo $form->input('mennyisegiegyseg_id');
		echo $form->input('termeny_id');
		echo $form->input('felhasznalt');
		echo $form->input('koltseg');
		echo $form->input('vevo_id');
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
		<li><?php echo $html->link(__('Szolgálattipusok', true), array('controller' => 'szolgtipusok', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('Termények', true), array('controller' => 'termenyek', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('Vevők', true), array('controller' => 'vevok', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('Mennyiségi egységek', true), array('controller' => 'mennyisegiegysegek', 'action' => 'index')); ?> </li>
	</ul>
</div>
