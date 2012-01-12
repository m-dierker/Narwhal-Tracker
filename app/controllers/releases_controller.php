<?php
	class ReleasesController extends AppController {
		var $name = 'Releases';
		
		function releases() {
			$this->set('releases', $this->Release->find('all', array('order' => array('Release.dev_id DESC'))));
		}
		
		function upcoming() { }
		
		function index() {
			$this->redirect('releases');
		}
	}
?>