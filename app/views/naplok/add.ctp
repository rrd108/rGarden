<?php
print $javascript->link('kert.naplo.js', false);

?>
<div class="naplok form">
<?php echo $form->create('Naplo');?>
	<fieldset>
 		<legend><?php __('Új naplóbejegyzés');?></legend>
		<h2><?php print 'Összes költség: <span id="osszktg">0</span> Ft'; ?></h2>
	<?php
		//echo $form->input('munkas_id', array('empty' => ' --- válassz --- '));
		print '<div class="input required">';
			print $form->label('munkas', 'Munkavégző');
			print $ajax->autoComplete('NaploMunkas',
											'/munkasok/searchMunkas',
											array(
												  'afterUpdateElement' => 'kert.naplo.munkashandler'
												  )
											);
		print '</div>';
		print $form->input('munkas_id', array('type' => 'hidden'));
		
		echo $form->input('datum', array('type' => 'text'));

		//echo $form->input('hely_id', array('empty' => ' --- válassz --- '));
		print '<div class="input required">';
			print $form->label('hely', 'Hely');
			print $ajax->autoComplete('NaploHely',
											'/helyek/searchHely',
											array(
												  'afterUpdateElement' => 'kert.naplo.helyhandler'
												  )
											);
		print '</div>';
		print $form->input('hely_id', array('type' => 'hidden'));

		//echo $form->input('termeny_id');
		print '<div class="input required">';
			print $form->label('termeny', 'Termény');
			print $ajax->autoComplete('NaploTermeny',
											'/termenyek/searchTermeny',
											array(
												  'afterUpdateElement' => 'kert.naplo.termenyhandler'
												  )
											);
		print '</div>';
		print $form->input('termeny_id', array('type' => 'hidden', 'value' => 1));
		
		print '<div class="input required">';
			print $form->label('Szolgalat', 'Szolgálat');
			print $ajax->autoComplete('szolgalat',
											'/naplok/searchSzolgalat');
		print '</div>';
		echo $form->input('ora');
		echo $form->input('megjegyzes');

		/*echo $form->input('szolgtipus_id', array('empty' => ' --- válassz --- '));
		
		echo $form->input('mennyiseg');
		echo $form->input('mennyisegiegyseg_id');
		
		echo $form->input('felhasznalt');
		echo $form->input('koltseg');
		echo $form->input('vevo_id');*/
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
