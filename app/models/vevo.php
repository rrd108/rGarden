<?php
class Vevo extends AppModel {

	var $name = 'Vevo';
	var $validate = array(
		'vevo' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Naplo' => array(
			'className' => 'Naplo',
			'foreignKey' => 'vevo_id',
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