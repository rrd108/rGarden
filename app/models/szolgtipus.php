<?php
class Szolgtipus extends AppModel {

	var $name = 'Szolgtipus';
	var $validate = array(
		'szolgtipus' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Naplo' => array(
			'className' => 'Naplo',
			'foreignKey' => 'szolgtipus_id',
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