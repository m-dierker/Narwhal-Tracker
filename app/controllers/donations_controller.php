<?php
	class DonationsController extends AppController {
		var $name = 'Donations';
		
        var $components = array('RequestHandler');
        
		function index() {
			$this->set('donations', $this->Donation->find('all'));
		}
		
		function view($id) {
			$this->Donation->don_id = $id;
			$this->set('donation', $this->Donation->Read());
		}
		
		function add() {
			if(!empty($this->data)) {
				$this->Donation->set('don_date_processed', date("Y-m-d H:i:s"));
				
				//save the donor record
                if(!isset($this->data['Donation']['don_d_id'])) {
                    $this->Donation->Donor->save($this->data['Donor'][0]);
                    $this->Donation->set('don_d_id', $this->Donation->Donor->id);
                }
				
				//save the revenue source record
				$this->Donation->RevenueSource->save($this->data['RevenueSource'][0]);
				$this->Donation->set('don_rs_id', $this->Donation->RevenueSource->id);
				
				//finally, save the donation record
				if($this->Donation->save($this->data)) {
					$this->Session->setFlash('New donation has been logged.');
					$this->redirect(array('action' => 'view', $this->Donation->id));
				}
			}
			//set the riders for the page select
			$this->loadModel('AppSetting');
			$currentYear = $this->AppSetting->find('first', array('conditions' => array('as_key' => 'YEAR')));
			$this->loadModel('RiderSummary');
			$riders = array(-1 => '--Select--') + 
				$this->RiderSummary->find('list', array('fields' => array('r_id', 'r_last_name'),
				'conditions' => array('r_year' => $currentYear['AppSetting']['as_value'])));
			$this->set('riders', $riders);
			
			//set the rider to be selected if specified in the URL
			if(isset($this->params['url']['rider'])) {
				$this->set('rider', $this->params['url']['rider']);
			}
			
            if(isset($this->params['url']['donor'])) {
                $this->loadModel('Donor');
                $this->set('donor', $this->Donor->find('first', array(
                    'conditions' => array('Donor.d_id' => $this->params['url']['donor'])
                )));
            }
            
			//set the contact options for donor entry
			$this->set('contact_options', $this->contact_options());
			
			//set the revenue types for revenue source
			$this->set('revenue_types', $this->revenue_types());
		}
        
        function edit($id) {
            $this->Donation->id = $id;
            if(!empty($this->data)) {
                $this->data = $this->Donation->read();
            } else {
                
            }
			$this->loadModel('AppSetting');
			$currentYear = $this->AppSetting->find('first', array('conditions' => array('as_key' => 'YEAR')));
			$this->loadModel('RiderSummary');
			$riders = array(-1 => '--Select--') + 
				$this->RiderSummary->find('list', array('fields' => array('r_id', 'r_last_name'),
				'conditions' => array('r_year' => $currentYear['AppSetting']['as_value'])));
			$this->set('riders', $riders);
        }
        
        function receipts() {
			$this->set('donations', $this->Donation->find('all', array(
                'order' => "Donation.don_id ASC",
                'conditions' => array('Donation.don_receipt' => 'N')
            )));
        }
        
        function export() {
            //Configure::write('debug',0);
            
            $data = $this->Donation->find('all', array(
                'order' => "Donation.don_id ASC",
                'conditions' => array('Donation.don_receipt' => 'N')
            ));
            
            if(!$data) {
                echo 'nothing to see here!';
            }
            
            $this->set(compact('data'));
            
            $this->header('Content-Type: text/csv');
        }
        
        function mark() {
            $date = date("Y-m-d");
            
            $this->Donation->updateAll(
                array('Donation.don_receipt' => '"' . $date . '"'),
                array('Donation.don_receipt' => 'N')
            );
            $this->redirect(array('action' => 'receipts'));
        }
	
        private function contact_options() {
            $contact_options = array('yes' => 'Send newsletter', 'no' => 'Do not send newsletter');
            return $contact_options;
        }
	
        private function revenue_types() {
            $types = array('CHECK' => 'Check', 'CASH' => 'Cash', 'PAYPAL' => 'PayPal');
            return $types;
        }
	}
?>