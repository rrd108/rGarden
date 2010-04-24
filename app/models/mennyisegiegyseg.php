<?php
class Mennyisegiegyseg extends AppModel {

	var $name = 'Mennyisegiegyseg';
	var $validate = array(
		'mennyisegiegyseg' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Naplo' => array(
			'className' => 'Naplo',
			'foreignKey' => 'mennyisegiegyseg_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>