<?php
class HelyekController extends AppController {

	var $name = 'Helyek';
	var $scaffold;
	
	function searchHely(){
		//ajaxos keresés a számlákban
		Configure::write('debug', 0);
		//a $this->data tömbben érkezik a paraméter
		$this->set('searchHely', $this->Hely->find('all',
								array(
									'conditions' => array("Hely.hely LIKE '" . $this->data['Naplo']['NaploHely'] . "%'"),
									'recursive' => -1
									)
								));
		$this->render('searchHely', 'ajax');
	}

}
?>