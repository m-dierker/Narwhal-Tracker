<?php
	class RiderSummariesController extends AppController {
		var $name = 'RiderSummaries';
		
		function index() {
            
            $year;
            
            if(isset($this->params['url']['year'])) {
                $year = $this->params['url']['year'];
            }
            
            $valid_years = $this->valid_years();
            
            $this->set('valid_years', $valid_years);
            
            $year_value;
            
            if(isset($year) && isset($valid_years[$year])) {
                $year_value = $year;
            } else {
                $this->loadModel('AppSetting');
                $currentYear = $this->AppSetting->find('first', array('conditions' => array('as_key' => 'YEAR')));
                $year_value = $currentYear['AppSetting']['as_value'];
            }
            
            
            $this->loadModel('Rules');
            $rules = $this->Rules->find('first', array('conditions' => array(
                'rule_year' => $year_value,
                'rule_name' => 'Target'
            )));
            
            if(count($rules) > 0) {
                $this->set('target', $rules);
            }
            
			$this->set('currentYear', $year_value);
			$this->set('riders', $this->RiderSummary->find('all', array('conditions' => array('r_year' => $year_value))));
		}
        
        function team($year = null) {
            
			$this->loadModel('AppSetting');
			$currentYear = $this->AppSetting->find('first', array('conditions' => array('as_key' => 'YEAR')));
			
			$this->set('currentYear', $currentYear['AppSetting']['as_value']);
            
            $this->loadModel('Rules');
            $rules = $this->Rules->find('first', array('conditions' => array(
                'rule_year' => $currentYear['AppSetting']['as_value'],
                'rule_name' => 'Target'
            )));
            
            if(count($rules) > 0) {
                $this->set('target', $rules);
            }
            
            $riders = $this->RiderSummary->find('count', array('conditions' => array(
                'r_year' => $currentYear['AppSetting']['as_value'],
                'r_last_name <>' => 'GENERAL'
            )));
            $this->set('rider_count', $riders);
            
            $total = $this->RiderSummary->find('all', array(
                'fields' => array(
                    'SUM(RiderSummary.don_total) as total'
                ),
                'conditions' => array(
                    'r_year' => $currentYear['AppSetting']['as_value'],
                    'RiderSummary.r_last_name <>' => 'GENERAL'
                )
            ));
            $this->set('team_total', $total);
            
            $unassigned = $this->RiderSummary->find('all', array(
                'conditions' => array(
                    'r_year' => $currentYear['AppSetting']['as_value'],
                    'r_last_name' => 'GENERAL'
                ),
                'fields' => array('don_total')
            ));
            $this->set('unassigned', $unassigned);
            
            $this->loadModel('User');
            $user = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
            
            $group = $user['Group']['name'];
            
            if($group == 'information') {
                $riders = $this->RiderSummary->find('all', array(
                'conditions' => array(
                    'r_year' => $currentYear['AppSetting']['as_value'])
                ));
                
                $this->set('rider_list', $riders);
            }
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