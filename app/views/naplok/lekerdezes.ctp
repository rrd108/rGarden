<?php
?>
<div class="naplok form">
<?php echo $form->create('Naplo', array('action' => 'lekerdezes'));?>
	<fieldset>
 		<legend><?php __('Lekérdezés');?></legend>
	<?php
		echo $form->input('munkas_id', array('empty' => ' --- válassz --- '));
		echo $form->input('hely_id', array('empty' => ' --- válassz --- '));
//		echo $form->input('szolgalat');
		echo $form->input('szolgtipus_id', array('empty' => ' --- válassz --- '));
/*		echo $form->input('datum', array('type' => 'text'));
		echo $form->input('ora');
		echo $form->input('mennyiseg');
		echo $form->input('mennyisegiegyseg_id');
		echo $form->input('termeny_id');
		echo $form->input('felhasznalt');
		echo $form->input('koltseg');
		echo $form->input('vevo_id');
		echo $form->input('megjegyzes');*/
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div>
<?php
	if(isset($eredmeny)){
		//debug($eredmeny);
		/*
		[0] => Array(
            [naplok] => Array(
                    [id] => 619
                    [munkas_id] => 10
                    [hely_id] => 21
                    [szolgtipus_id] => 5
                    [datum] => 2010-04-07
                    [szolgalat] => galyazás
                    [ora] => 2.00
                    [termeny_id] => 1
                    [mennyiseg] => 
                    [mennyisegiegyseg_id] => 1
                    [felhasznalt] => 
                    [koltseg] => 
                    [vevo_id] => 1
                    [megjegyzes] => )
            [helyek] => Array(
                    [id] => 21
                    [hely] => kert)
            [munkasok] => Array(
                    [id] => 10
                    [munkas] => Jayanta d.
                    [oradij] => 500)
            [szolgtipusok] => Array(
                    [id] => 5
                    [szolgalattipus] => egyéb)
            [termenyek] => Array(
                    [id] => 1
                    [termeny] =>  -)
            [vevok] => Array(
                    [id] => 1
                    [vevo] =>  -)
            [mennyisegiegysegek] => Array(
                    [id] => 1
                    [mennyisegiegyseg] =>  -)
        )
		*/
		print '<table>';
			print '<tr>';
				print '<th>' . 'Munkás' . '</th>';
				print '<th>' . 'Hely' . '</th>';
				print '<th>' . 'Dátum' . '</th>';
				print '<th>' . 'Szolgálat' . '</th>';
				print '<th>' . 'Idő' . '</th>';
				print '<th>' . 'Termény' . '</th>';
				print '<th>' . 'Mennyiség' . '</th>';
				print '<th>' . 'Felhasznált' . '</th>';
				print '<th>' . 'Költség' . '</th>';
				print '<th>' . 'Óra költség' . '</th>';
				print '<th>' . 'Összes költség' . '</th>';
				print '<th>' . 'Vevő' . '</th>';
				print '<th>' . 'Megjegyzés' . '</th>';
			print '</tr>';
			
			$osszes = array('ora' => 0, 'ktg' => 0, 'oraKtg' => 0, 'osszKtg' => 0);
			foreach($eredmeny as $i => $e){
				$oraKtg = $e['naplok']['ora'] * $e['munkasok']['oradij'];
				$osszKtg = $oraKtg + $e['naplok']['koltseg'];
				$osszes['ora'] += $e['naplok']['ora'];
				$osszes['ktg'] += $e['naplok']['koltseg'];
				$osszes['oraKtg'] += $oraKtg;
				$osszes['osszKtg'] += $osszKtg;
				print '<tr' . (($i%2)?' class="altrow"':'') . '>';
					print '<td>' . $e['munkasok']['munkas'] . '</td>';
					print '<td>' . $e['helyek']['hely'] . '</td>';
					print '<td>' . $e['naplok']['datum'] . '</td>';
					print '<td>' . $e['szolgtipusok']['szolgalattipus'] . '</td>';
					print '<td>' . $e['naplok']['ora'] . '</td>';
					print '<td>' . $e['termenyek']['termeny'] . '</td>';
					print '<td>' . $e['naplok']['mennyiseg'] . ' ' . $e['mennyisegiegysegek']['mennyisegiegyseg'] . '</td>';
					print '<td>' . $e['naplok']['felhasznalt'] . '</td>';
					print '<td>' . $e['naplok']['koltseg'] . '</td>';
					print '<td>' . number_format($oraKtg, 0, '', '.') . '</td>';
					print '<td>' . number_format($osszKtg, 0, '', '.') . '</td>';
					print '<td>' . $e['vevok']['vevo'] . '</td>';
					print '<td>' . $e['naplok']['megjegyzes'] . '</td>';
				print '</tr>';
			}
			print '<tr class="b">';
				print '<td>Összesen</td>';
				print '<td></td>';
				print '<td></td>';
				print '<td></td>';
				print '<td>' . number_format($osszes['ora'], 0, '', '.') . '</td>';
				print '<td></td>';
				print '<td></td>';
				print '<td></td>';
				print '<td>' . number_format($osszes['ktg'], 0, '', '.') . '</td>';
				print '<td>' . number_format($osszes['oraKtg'], 0, '', '.') . '</td>';
				print '<td>' . number_format($osszes['osszKtg'], 0, '', '.') . '</td>';
				print '<td></td>';
				print '<td></td>';
			print '</tr>';
		print '</table>';
	}
?>
</div>