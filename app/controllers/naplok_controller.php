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
		//debug($this->data);die();
		if (!empty($this->data)) {
			$this->data['Naplo']['ora'] = str_replace(',', '.', $this->data['Naplo']['ora']);
			$this->Naplo->create();
			if ($this->Naplo->save($this->data)) {
				$this->Session->setFlash(__('The Naplo has been saved', true));
				$this->data['Naplo'] = array(
													'munkas_id' => $this->data['Naplo']['munkas_id'],
													'hely_id' => false,
													'szolgalat' => false,
													'szolgtipus_id' => false,
													'datum' => $this->data['Naplo']['datum'],
													'ora' => false,
													'mennyiseg' => false,
													'mennyisegiegyseg_id' => false,
													'termeny_id' => false,
													'felhasznalt' => false,
													'koltseg' => false,
													'vevo_id' => false,
													'megjegyzes' => false
													);
			} else {
				$this->Session->setFlash(__('The Naplo could not be saved. Please, try again.', true));
			}
		}
		$munkasok = $this->Naplo->Munkas->find('list', array('fields' => array('id', 'munkas', 'oradij')));
		$helyek = $this->Naplo->Hely->find('list', array('fields' => 'hely'));
		$mennyisegiegysegek = $this->Naplo->Mennyisegiegyseg->find('list', array('fields' => 'mennyisegiegyseg'));
		$szolgtipusok = $this->Naplo->Szolgtipus->find('list', array('fields' => 'szolgalattipus'));
		$termenyek = $this->Naplo->Termeny->find('list', array('fields' => 'termeny'));
		$vevok = $this->Naplo->Vevo->find('list', array('fields' => 'vevo'));
		$this->set(compact('munkasok', 'helyek', 'szolgtipusok', 'termenyek', 'vevok', 'mennyisegiegysegek'));
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
		$mennyisegiegysegek = $this->Naplo->Mennyisegiegyseg->find('list', array('fields' => 'mennyisegiegyseg'));
		$szolgtipusok = $this->Naplo->Szolgtipus->find('list', array('fields' => 'szolgalattipus'));
		$termenyek = $this->Naplo->Termeny->find('list', array('fields' => 'termeny'));
		$vevok = $this->Naplo->Vevo->find('list', array('fields' => 'vevo'));
		$this->set(compact('munkasok','helyek','szolgtipusok','termenyek','vevok', 'mennyisegiegysegek'));
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
		//adott munkáshoz tartozó rekordok megjelenítése
		if($this->data){
			$sql = 'SELECT *
					FROM naplok, helyek, munkasok, szolgtipusok, termenyek, vevok, mennyisegiegysegek
					WHERE naplok.munkas_id = munkasok.id
					AND naplok.hely_id = helyek.id
					AND naplok.szolgtipus_id = szolgtipusok.id
					AND naplok.termeny_id = termenyek.id
					AND naplok.mennyisegiegyseg_id = mennyisegiegysegek.id
					AND naplok.vevo_id = vevok.id';
			
			$szuro = '';
			if($this->data['Naplo']['munkas_id']) $szuro .= ' AND naplok.munkas_id = ' . $this->data['Naplo']['munkas_id'];
			if($this->data['Naplo']['hely_id']) $szuro .= ' AND naplok.hely_id = ' . $this->data['Naplo']['hely_id'];
			if($this->data['Naplo']['szolgtipus_id']) $szuro .= ' AND naplok.szolgtipus_id = ' . $this->data['Naplo']['szolgtipus_id'];
			
			$eredmeny = $this->Naplo->query($sql . $szuro);
			$this->set('eredmeny', $eredmeny);
		}
		
		$munkasok = $this->Naplo->Munkas->find('list', array('fields' => array('id', 'munkas', 'oradij')));
		$helyek = $this->Naplo->Hely->find('list', array('fields' => 'hely'));
		$mennyisegiegysegek = $this->Naplo->Mennyisegiegyseg->find('list', array('fields' => 'mennyisegiegyseg'));
		$szolgtipusok = $this->Naplo->Szolgtipus->find('list', array('fields' => 'szolgalattipus'));
		$termenyek = $this->Naplo->Termeny->find('list', array('fields' => 'termeny'));
		$vevok = $this->Naplo->Vevo->find('list', array('fields' => 'vevo'));
		$this->set(compact('munkasok', 'helyek', 'szolgtipusok', 'termenyek', 'vevok', 'mennyisegiegysegek'));
	}	

}
?>