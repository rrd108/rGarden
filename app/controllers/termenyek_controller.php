<?php
class TermenyekController extends AppController {

	var $name = 'Termenyek';
	var $scaffold;
	
	function searchTermeny(){
		Configure::write('debug', 0);
		//a $this->data tömbben érkezik a paraméter
		$this->set('searchTermeny', $this->Termeny->find('all',
								array(
									'conditions' => array("Termeny.termeny LIKE '" . $this->data['Naplo']['NaploTermeny'] . "%'"),
									'recursive' => -1
									)
								));
		$this->render('searchTermeny', 'ajax');
	}
}
?>