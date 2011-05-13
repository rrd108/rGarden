<?php
class NaplokController extends AppController {

	var $name = 'Naplok';

	function index() {
		$this->Naplo->recursive = 0;
		$this->set('naplok', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Naplo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('naplo', $this->Naplo->read(null, $id));
	}

	function add() {
		//debug($this->data);
		if (!empty($this->data)) {
			
			//ha van új munkásunk akkor azt létre kell hozni
			if($this->data['Naplo']['NaploMunkas'] && !$this->data['Naplo']['munkas_id']){
				$this->data['Munkas']['munkas'] = $this->data['Naplo']['NaploMunkas'];
				$this->Naplo->Munkas->create();
				$this->Naplo->Munkas->save($this->data);
				$this->data['Naplo']['munkas_id'] = $this->Naplo->Munkas->id;
			}
			
			//ha van új hely, akkor azt létre kell hozni
			if($this->data['Naplo']['NaploHely'] && !$this->data['Naplo']['hely_id']){
				$this->data['Hely']['hely'] = $this->data['Naplo']['NaploHely'];
				$this->Naplo->Hely->create();
				$this->Naplo->Hely->save($this->data);
				$this->data['Naplo']['hely_id'] = $this->Naplo->Hely->id;
			}
			
			//ha van új termény akkor azt létre kell hozni
			
			$this->data['Naplo']['ora'] = str_replace(',', '.', $this->data['Naplo']['ora']);
			$this->Naplo->create();
			if ($this->Naplo->save($this->data)) {
				$this->Session->setFlash(__('The Naplo has been saved', true));
				$this->data['Naplo'] = array(
													'munkas_id' => $this->data['Naplo']['munkas_id'],
													'hely_id' => false,
													'szolgalat' => false,
													'datum' => $this->data['Naplo']['datum'],
													'ora' => false,
													'termeny_id' => false,
													'megjegyzes' => false
													);
			} else {
				$this->Session->setFlash(__('The Naplo could not be saved. Please, try again.', true));
			}
		}
		$munkasok = $this->Naplo->Munkas->find('list', array('fields' => array('id', 'munkas', 'oradij')));
		$termenyek = $this->Naplo->Termeny->find('list', array('fields' => 'termeny'));
		$this->set(compact('munkasok', 'termenyek'));
	}

	function edit($id = null) {
		//debug($this->data);
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Naplo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->data['Naplo']['ora'] = str_replace(',', '.', $this->data['Naplo']['ora']);
			if ($this->Naplo->save($this->data)) {
				$this->Session->setFlash(__('The Naplo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Naplo could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Naplo->read(null, $id);
		}
		$munkasok = $this->Naplo->Munkas->find('list', array('fields' => 'munkas'));
		$helyek = $this->Naplo->Hely->find('list', array('fields' => 'hely'));
		$termenyek = $this->Naplo->Termeny->find('list', array('fields' => 'termeny'));
		$this->set(compact('munkasok','helyek','termenyek'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Naplo', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Naplo->del($id)) {
			$this->Session->setFlash(__('Naplo deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Naplo could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function lekerdezes(){
		//debug($this->data);
		if($this->data){
			$sql = 'SELECT *
					FROM naplok, helyek, munkasok, termenyek
					WHERE naplok.munkas_id = munkasok.id
					AND naplok.hely_id = helyek.id
					AND naplok.termeny_id = termenyek.id';
			
			$szuro = '';
			if($this->data['Naplo']['munkas_id']) $szuro .= ' AND naplok.munkas_id = ' . $this->data['Naplo']['munkas_id'];
			if($this->data['Naplo']['hely_id']) $szuro .= ' AND naplok.hely_id = ' . $this->data['Naplo']['hely_id'];
			if($this->data['Naplo']['szolgalat']) $szuro .= ' AND naplok.szolgalat = "' . $this->data['Naplo']['szolgalat'] . '"';
			
			//debug($sql . $szuro);
			
			$eredmeny = $this->Naplo->query($sql . $szuro);
			$this->set('eredmeny', $eredmeny);
		}
		
		$munkasok = $this->Naplo->Munkas->find('list', array('fields' => array('id', 'munkas', 'oradij')));
		$helyek = $this->Naplo->Hely->find('list', array('fields' => 'hely'));
		$termenyek = $this->Naplo->Termeny->find('list', array('fields' => 'termeny'));
		$this->set(compact('munkasok', 'helyek', 'termenyek'));
	}
	
	function searchSzolgalat(){
		//ajaxos keresés a számlákban
		Configure::write('debug', 0);
		//a $this->data tömbben érkezik a paraméter
		$this->set('searchSzolgalat', $this->Naplo->find('all',
								array(
									'conditions' => array("Naplo.szolgalat LIKE '" . $this->data['Naplo']['szolgalat'] . "%'"),
									'fields' => 'szolgalat',
									'group' => 'szolgalat',
									'recursive' => -1
									)
								));
		$this->render('searchSzolgalat', 'ajax');
	}
}
?>