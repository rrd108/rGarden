<?php
class Naplo extends AppModel {

	var $name = 'Naplo';
	var $validate = array(
		'munkas_id' => array('numeric'),
		'hely_id' => array('numeric'),
		'szolgtipus_id' => array('numeric'),
		'szolgalat' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Munkas' => array(
			'className' => 'Munkas',
			'foreignKey' => 'munkas_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Hely' => array(
			'className' => 'Hely',
			'foreignKey' => 'hely_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Szolgtipus' => array(
			'className' => 'Szolgtipus',
			'foreignKey' => 'szolgtipus_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Termeny' => array(
			'className' => 'Termeny',
			'foreignKey' => 'termeny_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Mennyisegiegyseg' => array(
			'className' => 'Mennyisegiegyseg',
			'foreignKey' => 'mennyisegiegyseg_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Vevo' => array(
			'className' => 'Vevo',
			'foreignKey' => 'vevo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>