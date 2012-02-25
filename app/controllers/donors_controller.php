<?php
	class DonorsController extends AppController {
		var $name = 'Donors';
		
		function index() {
			//$this->set('donors', $this->Donor->find('all'));
		}
		
		function view($id) {
			$this->Donor->d_id = $id;
			$this->set('donor', $this->Donor->read());
            
            if(empty($this->Donor)) {
                $this->redirect(array('action' => 'index'));
            }
            
            $this->loadModel('Donation');
            $this->set('donations', $this->Donation->find('all', array(
                'conditions' => array('Donation.don_d_id' => $id)
            )));
            
            
            $this->loadModel('User');
            $user = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
            if($user['Group']['name'] == 'riders') {
                
                //if the donor does not belong to the rider, then don't allow him or her to view that donor record
                
                $this->layout = 'rider';
                $this->set('is_rider', true);
            }
		}
		
		function add() {
			if(!empty($this->data)) {
				if($this->Donor->save($this->data)) {
					$this->Session->setFlash('New donor has been created');
					$this->redirect(array('action' => 'view', $this->Donor->id));
				}
			}
			$this->set('contact_options', $this->contact_options());
		}
		
		function edit($id = null) {
			$this->Donor->id = $id;
			if(empty($this->data)) {
				$this->data = $this->Donor->read();
			} else {
				if($this->Donor->save($this->data)) {
					$this->Session->setFlash('Changes were saved');
					$this->redirect(array('action' => 'view', $id));
				}
			}
			$this->set('contact_options', $this->contact_options());
		}
        
        function search() {
            if(!empty($this->data)) {
                
                $conditions = array();
                
                if(isset($this->data['Donor']['d_name'])) {
                    $conditions["Donor.d_name like"] = '%' . $this->data['Donor']['d_name'] .'%';
                }
                if(isset($this->data['Donor']['d_street_address'])) {
                    $conditions["Donor.d_street_address like"] = '%' . $this->data['Donor']['d_street_address'] .'%';
                }
                if(isset($this->data['Donor']['d_city'])) {
                    $conditions["Donor.d_city like"] = '%' . $this->data['Donor']['d_city'] .'%';
                }
                if(isset($this->data['Donor']['d_state_code'])) {
                    $conditions["Donor.d_state_code like"] = '%' . $this->data['Donor']['d_state_code'] .'%';
                }
                if(isset($this->data['Donor']['d_contact']) && $this->data['Donor']['d_contact'] > -1) {
                    if($this->data['Donor']['d_contact'] == '1') {
                        $conditions["Donor.d_contact"] = 'yes';
                    } else if($this->data['Donor']['d_contact'] == '0') {
                        $conditions["Donor.d_contact"] = '';
                    }
                }
                if(isset($this->data['Donor']['d_type'])) {
                    if($this->data['Donor']['d_type'] == 'BUSINESS') {
                        $conditions['Donor.d_type'] = 'BUSINESS';
                    } else {
                        $conditions['Donor.d_type'] = 'PERSONAL';
                    }
                }
                
                $results = $this->Donor->find('all', array('conditions' => $conditions));
                
                $this->set('results', $results);
            }
        }
	
        private function contact_options() {
            $contact_options = array('yes' => 'Send newsletter', 'no' => 'Do not send newsletter');
            return $contact_options;
        }
	}
?>