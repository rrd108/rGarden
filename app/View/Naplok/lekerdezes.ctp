<?php
print $this->Html->script('kert.lekerdezes.js', false);
if(isset($paginator))
	$this->Paginator->options(array('url' => $this->passedArgs));
?>
<div class="naplok form">
<?php echo $this->Form->create('Naplo', array('action' => 'lekerdezes'));?>
	<fieldset>
 		<legend><?php echo __('Lekérdezés');?></legend>
	<?php
		echo $this->Form->input('munkas_id', array(
												   'empty' => __(' --- válassz --- '),
												  'required' => false));

		echo $this->Form->input('hely_id', array('empty' => __(' --- válassz --- '),
												  'required' => false));

		print '<div class="input">';
			print $this->Form->label('Szolgalat', __('Szolgálat'));
			print $this->autoComplete->create('szolgalat',
											'/naplok/searchSzolgalat');
		print '</div>';
		
		print '<div class="input">';
			print $this->Form->label('Termeny', __('Termény'));
			print $this->autoComplete->create('NaploTermeny',
											'/termenyek/searchTermeny',
											array(
												'autocompleterOptions' => '{afterUpdateElement :  kert.lekerdezes.termenyhandler}'
											)
											);
		print '</div>';
		print $this->Form->input('Naplo.termeny_id', array('type' => 'hidden', 'value' => $termenyId));

	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
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
				print '<th>' . $this->Paginator->sort(__('Munkás'), 'Munkas.munkas') . '</th>';
				print '<th>' . $this->Paginator->sort(__('Hely'), 'Hely.hely') . '</th>';
				print '<th>' . $this->Paginator->sort(__('Dátum'), 'Naplo.datum') . '</th>';
				print '<th>' . $this->Paginator->sort(__('Szolgálat'), 'Naplo.szolgalat') . '</th>';
				print '<th>' . $this->Paginator->sort(__('Idő'), 'Naplo.ora') . '</th>';
				print '<th>' . $this->Paginator->sort(__('Termény'), 'Termeny.termeny') . '</th>';
				print '<th>' . 'Óra költség' . '</th>';
				print '<th>' . $this->Paginator->sort(__('Megjegyzés'), 'Naplo.megjegyzes') . '</th>';
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
						echo $this->Html->link(__('Muti'), array('action' => 'view', $e['Naplo']['id']));
						echo $this->Html->link(__('Szerk'), array('action' => 'edit', $e['Naplo']['id']));
						echo $this->Html->link(__('Del'), array('action' => 'delete', $e['Naplo']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $e['Naplo']['id']));
					print '</td>';
				print '</tr>';
			}
			print '<tr class="b">';
				print '<td>' . __('Összesen') . '</td>';
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
		
		echo $this->Paginator->numbers();
		echo $this->Paginator->prev('« Previous ', null, null, array('class' => 'disabled'));
		echo $this->Paginator->next(' Next »', null, null, array('class' => 'disabled'));
		echo $this->Paginator->counter();
	}
?>
</div>