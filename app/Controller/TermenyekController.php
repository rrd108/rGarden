<?php
App::uses('AppController', 'Controller');

class TermenyekController extends AppController {

	var $name = 'Termenyek';
	var $scaffold;
	
	function searchTermeny(){
		Configure::write('debug', 0);
		//a $this->request->data tömbben érkezik a paraméter
		$this->set('searchTermeny', $this->Termeny->find('all',
								array(
									'conditions' => array("Termeny.termeny LIKE '" . $this->request->data['Naplo']['NaploTermeny'] . "%'"),
									'recursive' => -1
									)
								));
		$this->render('searchTermeny', 'ajax');
	}
}
?>