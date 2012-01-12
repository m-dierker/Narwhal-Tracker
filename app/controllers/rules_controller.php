<?php
	class RulesController extends AppController {
		var $name = 'Rules';
		
		function index() {
			$this->set('rules', $this->Rule->find('all'));
		}
		
		function add() {
			if(!empty($this->data)) {
				if($this->Rule->save($this->data)) {
					$this->Session->setFlash('New rule has been created');
					$this->redirect(array('action' => 'index'));
				}
			}
		}
	}
?>