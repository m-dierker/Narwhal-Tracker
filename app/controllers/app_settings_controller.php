<?php
	class AppSettingsController extends AppController {
		var $name = 'AppSettings';
		
		function index() {
			$settings = $this->AppSetting->find('first', array('conditions' => array('as_key' => 'YEAR')));
			
			if(!empty($this->data)) {
				$this->AppSetting->id = $settings['AppSetting']['as_id'];
				$this->AppSetting->read();
				$this->AppSetting->set('as_value', $this->data['AppSetting']['year']);
				$this->AppSetting->save();
				$this->Session->setFlash('Changes were saved');
				$this->redirect(array('controller' => 'riders', 'action' => 'index'));
			}
			$this->set('settings', $settings);
			$this->set('valid_years', $this->valid_years());
		}
	
        private function valid_years() {
            $output = array();
            $current_year = date("Y");
            $years = range($current_year + 1,2007);
            foreach ($years as $year) {
                $output[$year] = $year;
            }
            return $output;
        }
	}
?>