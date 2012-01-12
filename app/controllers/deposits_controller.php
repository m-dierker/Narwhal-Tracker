<?php
	class DepositsController extends AppController {
		var $name = 'Deposits';
		
		function index() {  
			$this->loadModel('DepositSummary');
			$this->set('deposits', $this->DepositSummary->find('all'));
		}
		
		function view($id) {
			$this->Deposit->dep_id = $id;
			$this->set('deposit', $this->Deposit->Read());
			$this->loadModel('DonationDeposit');
			$this->set('sources', $this->DonationDeposit->find('all',
				array (
					'conditions' => array('dd_dep_id' => $id),
					'fields' => array('RevenueSource.rs_deposit_amt',
						'RevenueSource.rs_id',
						'RevenueSource.rs_type',
						'RevenueSource.rs_num',
						'DonationDeposit.dd_status'
					)
				)
			));
		}
	}
?>