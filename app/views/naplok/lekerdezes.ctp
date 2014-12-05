<?php
print $javascript->link('kert.lekerdezes.js', false);
if(isset($paginator))
	$paginator->options(array('url' => $this->passedArgs));
?>
<div class="naplok form">
<?php echo $form->create('Naplo', array('action' => 'lekerdezes'));?>
	<fieldset>
 		<legend><?php __('Lekérdezés');?></legend>
	<?php
		echo $form->input('munkas_id', array('empty' => __(' --- válassz --- ', true)));

		echo $form->input('hely_id', array('empty' => __(' --- válassz --- ', true)));

		print '<div class="input required">';
			print $form->label('Szolgalat', __('Szolgálat', true));
			print $ajax->autoComplete('szolgalat',
											'/naplok/searchSzolgalat');
		print '</div>';
		
		print '<div class="input required">';
			print $form->label('Termeny', __('Termény', true));
			print $ajax->autoComplete('NaploTermeny',
											'/termenyek/searchTermeny',
											array(
												'afterUpdateElement' => 'kert.lekerdezes.termenyhandler'
											)
											);
		print '</div>';
		print $form->input('Naplo.termeny_id', array('type' => 'hidden', 'value' => $termenyId));

	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div>
<?php
	if(isset($eredmeny)){
		//debug($eredmeny);
		/*
		[0] => Array
        (
            [Naplo] => Array
                (
                    [id] => 289
                    [munkas_id] => 2
                    [hely_id] => 2
                    [datum] => 2012-01-27
                    [szolgalat] => válogatás
                    [ora] => 0.50
                    [termeny_id] => 27
                    [koltseg] => 
                    [megjegyzes] => 
                )
            [Munkas] => Array
                (
                    [id] => 2
                    [munkas] => Sasi Sekhara d
                    [oradij] => 550
                )
            [Hely] => Array
                (
                    [id] => 2
                    [hely] => Pince
                )
            [Termeny] => Array
                (
                    [id] => 27
                    [termeny] => Sütőtök
                )
        )
		*/
		print '<table>';
			print '<tr>';
				print '<th>' . $paginator->sort(__('Munkás', true), 'Munkas.munkas') . '</th>';
				print '<th>' . $paginator->sort(__('Hely', true), 'Hely.hely') . '</th>';
				print '<th>' . $paginator->sort(__('Dátum', true), 'Naplo.datum') . '</th>';
				print '<th>' . $paginator->sort(__('Szolgálat', true), 'Naplo.szolgalat') . '</th>';
				print '<th>' . $paginator->sort(__('Idő', true), 'Naplo.ora') . '</th>';
				print '<th>' . $paginator->sort(__('Termény', true), 'Termeny.termeny') . '</th>';
				print '<th>' . 'Óra költség' . '</th>';
				print '<th>' . $paginator->sort(__('Megjegyzés', true), 'Naplo.megjegyzes') . '</th>';
				print '<th>' . 'Eszközök' . '</th>';
			print '</tr>';
			
			$osszes = array('ora' => 0, 'ktg' => 0, 'oraKtg' => 0, 'osszKtg' => 0);
			foreach($eredmeny as $i => $e){
				$oraKtg = $e['Naplo']['ora'] * $e['Munkas']['oradij'];
				$osszKtg = $oraKtg + $e['Naplo']['koltseg'];
				$osszes['ora'] += $e['Naplo']['ora'];
				$osszes['ktg'] += $e['Naplo']['koltseg'];
				$osszes['oraKtg'] += $oraKtg;
				$osszes['osszKtg'] += $osszKtg;
				print '<tr' . (($i%2)?' class="altrow"':'') . '>';
					print '<td>' . $e['Munkas']['munkas'] . '</td>';
					print '<td>' . $e['Hely']['hely'] . '</td>';
					print '<td>' . $e['Naplo']['datum'] . '</td>';
					print '<td>' . $e['Naplo']['szolgalat'] . '</td>';
					print '<td>' . $e['Naplo']['ora'] . '</td>';
					print '<td>' . $e['Termeny']['termeny'] . '</td>';
					print '<td>' . number_format($oraKtg, 0, '', '.') . '</td>';
					print '<td>' . $e['Naplo']['megjegyzes'] . '</td>';
					print '<td class="actions">';
						echo $html->link(__('Muti', true), array('action' => 'view', $e['Naplo']['id']));
						echo $html->link(__('Szerk', true), array('action' => 'edit', $e['Naplo']['id']));
						echo $html->link(__('Del', true), array('action' => 'delete', $e['Naplo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $e['Naplo']['id']));
					print '</td>';
				print '</tr>';
			}
			print '<tr class="b">';
				print '<td>' . __('Összesen', true) . '</td>';
				print '<td></td>';
				print '<td></td>';
				print '<td></td>';
				print '<td>' . number_format($osszes['ora'], 0, '', '.') . '</td>';
				print '<td></td>';
				print '<td>' . number_format($osszes['oraKtg'], 0, '', '.') . '</td>';
				print '<td></td>';
				print '<td></td>';
			print '</tr>';
		print '</table>';
		
		echo $paginator->numbers();
		echo $paginator->prev('« Previous ', null, null, array('class' => 'disabled'));
		echo $paginator->next(' Next »', null, null, array('class' => 'disabled'));
		echo $paginator->counter();
	}
?>
</div>