<?php
class Naplo extends AppModel {

	var $name = 'Naplo';
	var $validate = array(
		'munkas_id' => array('numeric'),
		'hely_id' => array('numeric'),
		'termeny_id' => array('numeric'),
		'szolgalat' => array('notempty'),
		'ora' => array('numeric'),
		'datum' => array('notempty')
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
		'Termeny' => array(
			'className' => 'Termeny',
			'foreignKey' => 'termeny_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function sumcost(){
		return $this->query('SELECT termenyek.id, termenyek.termeny, SUM(naplok.ora * munkasok.oradij) AS sumcost
							FROM naplok, helyek, termenyek, munkasok
							WHERE naplok.hely_id = helyek.id
							AND naplok.termeny_id = termenyek.id
							AND naplok.munkas_id = munkasok.id
							GROUP BY termenyek.id
							ORDER BY termenyek.termeny');
	}
}
?>