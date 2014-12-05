<?php
App::uses('AppController', 'Controller');
class NaplokController extends AppController {

	var $paginate = array(
        'limit' => 500,
        'order' => array(
            'Naplo.datum' => 'asc'
        )
    );

	function index() {
		$this->Naplo->recursive = 0;
		$this->set('naplok', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Naplo'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->set('naplo', $this->Naplo->read(null, $id));
	}

	function add() {
		//debug($this->request->data);
		if (!empty($this->request->data)) {
			
			$munkas = $this->request->data['Naplo']['NaploMunkas'];
			$ujTorzs = '';
			
			//ha van új munkásunk akkor azt létre kell hozni
			if($this->request->data['Naplo']['NaploMunkas'] && !$this->request->data['Naplo']['munkas_id']){
				$munkas = $this->request->data['Munkas']['munkas'] = $this->request->data['Naplo']['NaploMunkas'];
				$this->Naplo->Munkas->create();
				$this->Naplo->Munkas->save($this->request->data);
				$this->request->data['Naplo']['munkas_id'] = $this->Naplo->Munkas->id;
				$ujTorzs .= __('Új munkásként hozzáadva: ') . $munkas . '<br>';
			}
			
			//ha van új hely, akkor azt létre kell hozni
			if($this->request->data['Naplo']['NaploHely'] && !$this->request->data['Naplo']['hely_id']){
				$this->request->data['Hely']['hely'] = $this->request->data['Naplo']['NaploHely'];
				$this->Naplo->Hely->create();
				$this->Naplo->Hely->save($this->request->data);
				$this->request->data['Naplo']['hely_id'] = $this->Naplo->Hely->id;
				$ujTorzs .= __('Új helyként hozzáadva: ') . $this->request->data['Hely']['hely'] . '<br>';
			}
			
			//ha van új termény akkor azt létre kell hozni
			if($this->request->data['Naplo']['NaploTermeny'] && $this->request->data['Naplo']['termeny_id'] == 1){
				$this->request->data['Termeny']['termeny'] = $this->request->data['Naplo']['NaploTermeny'];
				$this->Naplo->Termeny->create();
				$this->Naplo->Termeny->save($this->request->data);
				$this->request->data['Naplo']['termeny_id'] = $this->Naplo->Termeny->id;
				$ujTorzs .= __('Új terményként hozzáadva: ') . $this->request->data['Termeny']['termeny'] . '<br>';
			}
			
			$this->request->data['Naplo']['ora'] = str_replace(',', '.', $this->request->data['Naplo']['ora']);
			$this->Naplo->create();
			if ($this->Naplo->save($this->request->data)) {
				$this->Session->setFlash($ujTorzs . 'A napló mentve');
				$this->request->data['Naplo'] = array(
													'munkas_id' => $this->request->data['Naplo']['munkas_id'],
													'hely_id' => false,
													'szolgalat' => false,
													'datum' => $this->request->data['Naplo']['datum'],
													'ora' => false,
													'termeny_id' => false,
													'megjegyzes' => false
													);
			} else {
				$this->Session->setFlash($ujTorzs . __('A naplót nem sikerült menteni'));
			}
		}
		
		$termenyek = $this->Naplo->Termeny->find('list', array('fields' => 'termeny'));
		$this->set(compact('munkas', 'termenyek'));
	}

	function edit($id = null, $p = null) {
		//debug($this->request->data);die();
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Naplo'));
			return $this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			$this->request->data['Naplo']['ora'] = str_replace(',', '.', $this->request->data['Naplo']['ora']);
			if(!$this->request->data['Naplo']['NaploTermeny'] && $this->request->data['Naplo']['termeny_id']){
				//nincs termény név, de van id, véletlenül megadtunk egy terméket de valójában nics
				$this->request->data['Naplo']['termeny_id'] = 1;		//default
			}
			if ($this->Naplo->save($this->request->data)) {
				$this->Session->setFlash(__('The Naplo has been saved'));
				return $this->redirect(array('action' => 'index/page:' . $this->request->data['Naplo']['p']));
			} else {
				$this->Session->setFlash(__('The Naplo could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Naplo->read(null, $id);
		}
		$munkasok = $this->Naplo->Munkas->find('list', array('fields' => 'munkas'));
		$helyek = $this->Naplo->Hely->find('list', array('fields' => 'hely'));
		$termenyek = $this->Naplo->Termeny->find('list', array('fields' => 'termeny'));
		$this->set(compact('munkasok','helyek','termenyek', 'p'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Naplo'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->Naplo->del($id)) {
			$this->Session->setFlash(__('Naplo deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Naplo could not be deleted. Please, try again.'));
		return $this->redirect(array('action' => 'index'));
	}
	
	function lekerdezes(){
		$szuro = array();
		if($this->request->data['Naplo']['munkas_id'])
			$szuro['Naplo.munkas_id'] = $this->request->data['Naplo']['munkas_id'];
		if($this->request->data['Naplo']['hely_id'])
			$szuro['Naplo.hely_id'] =  $this->request->data['Naplo']['hely_id'];
		if($this->request->data['Naplo']['szolgalat'])
			$szuro['Naplo.szolgalat'] = $this->request->data['Naplo']['szolgalat'];
		if($this->request->data['Naplo']['termeny_id'])
			$szuro['Naplo.termeny_id'] = $this->request->data['Naplo']['termeny_id'];
		
		if($szuro){
			$this->Session->write('paginatorSzuro', $szuro);
		}
		else{
			$szuro = $this->Session->read('paginatorSzuro');
		}

		if($this->passedArgs || $this->request->data){
			$eredmeny = $this->paginate('Naplo', $szuro);
			$this->set('eredmeny', $eredmeny);
		}
		
		$munkasok = $this->Naplo->Munkas->find('list', array('fields' => array('id', 'munkas', 'oradij')));
		$helyek = $this->Naplo->Hely->find('list', array('fields' => 'hely'));
		$termenyek = $this->Naplo->Termeny->find('list', array('fields' => 'termeny'));
		$termenyId = $this->request->data['Naplo']['termeny_id'];
		$this->set(compact('munkasok', 'helyek', 'termenyek', 'termenyId'));
	}
	
	function searchSzolgalat(){
		//ajaxos keresés a szolgálatokban
		Configure::write('debug', 0);
		//a $this->request->data tömbben érkezik a paraméter
		$this->set('searchSzolgalat', $this->Naplo->find('all',
								array(
									'conditions' => array("Naplo.szolgalat LIKE '" . $this->request->data['Naplo']['szolgalat'] . "%'"),
									'fields' => 'szolgalat',
									'group' => 'szolgalat',
									'recursive' => -1
									)
								));
		$this->render('searchSzolgalat', 'ajax');
	}
}
?>