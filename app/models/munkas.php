<?php
class Munkas extends AppModel {

	var $name = 'Munkas';
	var $validate = array(
		'munkas' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Naplo' => array(
			'className' => 'Naplo',
			'foreignKey' => 'hely_id',
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