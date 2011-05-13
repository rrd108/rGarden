<?php
class MunkasokController extends AppController {

	var $name = 'Munkasok';
	var $scaffold;
	
	function searchMunkas(){
		//ajaxos keresés a számlákban
		Configure::write('debug', 0);
		//a $this->data tömbben érkezik a paraméter
		$this->set('searchMunkas', $this->Munkas->find('all',
								array(
									'conditions' => array("Munkas.munkas LIKE '" . $this->data['Naplo']['NaploMunkas'] . "%'"),
									'recursive' => -1
									)
								));
		$this->render('searchMunkas', 'ajax');
	}

}
?>