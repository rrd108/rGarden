<?php
class Termeny extends AppModel {

	var $name = 'Termeny';
	var $validate = array(
		'termeny' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Naplo' => array(
			'className' => 'Naplo',
			'foreignKey' => 'termeny_id',
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