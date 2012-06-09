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
			
			$munkas = $this->data['Naplo']['NaploMunkas'];
			$ujTorzs = '';
			
			//ha van új munkásunk akkor azt létre kell hozni
			if($this->data['Naplo']['NaploMunkas'] && !$this->data['Naplo']['munkas_id']){
				$munkas = $this->data['Munkas']['munkas'] = $this->data['Naplo']['NaploMunkas'];
				$this->Naplo->Munkas->create();
				$this->Naplo->Munkas->save($this->data);
				$this->data['Naplo']['munkas_id'] = $this->Naplo->Munkas->id;
				$ujTorzs .= 'Új munkásként hozzáadva: ' . $munkas . '<br>';
			}
			
			//ha van új hely, akkor azt létre kell hozni
			if($this->data['Naplo']['NaploHely'] && !$this->data['Naplo']['hely_id']){
				$this->data['Hely']['hely'] = $this->data['Naplo']['NaploHely'];
				$this->Naplo->Hely->create();
				$this->Naplo->Hely->save($this->data);
				$this->data['Naplo']['hely_id'] = $this->Naplo->Hely->id;
				$ujTorzs .= 'Új helyként hozzáadva: ' . $this->data['Hely']['hely'] . '<br>';
			}
			
			//ha van új termény akkor azt létre kell hozni
			if($this->data['Naplo']['NaploTermeny'] && $this->data['Naplo']['termeny_id'] == 1){
				$this->data['Termeny']['termeny'] = $this->data['Naplo']['NaploTermeny'];
				$this->Naplo->Termeny->create();
				$this->Naplo->Termeny->save($this->data);
				$this->data['Naplo']['termeny_id'] = $this->Naplo->Termeny->id;
				$ujTorzs .= 'Új terményként hozzáadva: ' . $this->data['Termeny']['termeny'] . '<br>';
			}
			
			$this->data['Naplo']['ora'] = str_replace(',', '.', $this->data['Naplo']['ora']);
			$this->Naplo->create();
			if ($this->Naplo->save($this->data)) {
				$this->Session->setFlash($ujTorzs . 'A napló mentve');
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
				$this->Session->setFlash($ujTorzs . 'A naplót nem sikerült menteni');
			}
		}
		
		$termenyek = $this->Naplo->Termeny->find('list', array('fields' => 'termeny'));
		$this->set(compact('munkas', 'termenyek'));
	}

	function edit($id = null) {
		//debug($this->data);die();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Naplo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->data['Naplo']['ora'] = str_replace(',', '.', $this->data['Naplo']['ora']);
			if(!$this->data['Naplo']['NaploTermeny'] && $this->data['Naplo']['termeny_id']){
				//nincs termény név, de van id, véletlenül megadtunk egy terméket de valójában nics
				$this->data['Naplo']['termeny_id'] = 1;		//default
			}
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
			if($this->data['Naplo']['termeny_id']) $szuro .= ' AND naplok.termeny_id = "' . $this->data['Naplo']['termeny_id'] . '"';
			
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
		//ajaxos keresés a szolgálatokban
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