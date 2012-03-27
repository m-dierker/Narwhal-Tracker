<?php
	class DonationsController extends AppController {
		var $name = 'Donations';
		
        var $components = array('RequestHandler');
        
        function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow("listen_ipn");
        }
        
		function index() {
			//$this->set('donations', $this->Donation->find('all'));
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
        
        public function listen_ipn() {
           
            /*

            Testing array

            $ipn = array(
                            'transaction_subject' => 'Illini 4000 - Helene Werld',
                            'payment_date' => '13:25:10 Feb 04, 2012 PST',
                            'txn_type' => 'web_accept',
                            'last_name' => 'LastName',
                            'residence_country' => 'US',
                            'item_name' => 'Illini 4000 - Helene Werld',
                            'payment_gross' => 102.00,
                            'mc_currency' => 'USD',
                            'business' => 'mercha_1328384327_biz@gmail.com',
                            'payment_type' => 'instant',
                            'protection_eligibility' => 'Ineligible',
                            'verify_sign' => 'AWJGvN1qvAzcgmLnx6oSICoTRKWhAVhGjdQO7WZGhr7Pi2XYRwBkgr4b',
                            'payer_status' => 'verified',
                            'test_ipn' => 1,
                            'tax' => 0.00,
                            'payer_email' => 'buyer_1328389652_per@gmail.com',
                            'txn_id' => '3T371218WX4920823',
                            'quantity'=> 0,
                            'receiver_email' => 'mercha_1328384327_biz@gmail.com',
                            'first_name' => 'Buyer',
                            'payer_id' => '2XMEGVRFWGH6G',
                            'receiver_id' => 'W6ZE5JWLWLGLU',
                            'item_number' => 'Helene Werld',
                            'payment_status' => 'Completed',
                            'payment_fee' => 3.26,
                            'mc_fee' => 3.26,
                            'mc_gross' => 102.00,
                            'custom' => 1,
                            'charset' => 'windows-1252',
                            'notify_version' => 3.4,
                            'ipn_track_id' => 'ea98e76ba63b5',
                            'memo' => 'Helene Werld!'
                        ); 
            **/



            $req = 'cmd=_notify-validate';

            foreach ($_POST as $key => $value)
            {
                $value = urlencode(stripslashes($value));
                $req .= "&$key=$value";
            }

            $header = "";

            // post back to PayPal system to validate
            $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
            $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
            $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";




            //IMPORTANT: Read the comment below before production





            //IMPORTANT NOTE: remove the word sandbox in production
            $fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);

            //Assign posted variables to local variables
            $item_name = $_POST['item_name'];
            $item_number = $_POST['item_number'];
            $payment_status = $_POST['payment_status'];
            $payment_amount = $_POST['mc_gross'];
            $payment_currency = $_POST['mc_currency'];
            $txn_id = $_POST['txn_id'];
            $receiver_email = $_POST['receiver_email'];
            $payer_email = $_POST['payer_email'];

            if (!$fp)
            {
                //HTTP Error
                $this->log("HTTP Error on IPN Save while trying to contact PayPal.");
            }
            else
            {
                fputs ($fp, $header . $req);

                while (!feof($fp))
                {
                    $res = fgets ($fp, 1024);

                    if (strcmp ($res, "VERIFIED") == 0)
                    {
                        //PayPal's checklist
                        // check the payment_status is Completed -- Done!
                        // check that txn_id has not been previously processed -- Maybe done?
                        // check that receiver_email is your Primary PayPal email --Needs to be done on the if statement below
                        // check that payment_amount/payment_currency are correct -- This shouldn't apply to us
                        // process payment -- Done!

                        //Need to add all of the checks above
                        if($payment_status == "Completed")
                        {
                            $ipn = array_merge($_POST, array("rider_id" => $_GET['r_id']));
                            if($this->save_ipn($ipn))
                            {
                                $this->log("IPN Transaction ID $txn_id completed successfully", 'debug');
                            }


                        }
                        else
                        {
                            $this->log("Possible IPN Failure - Payment Status $payment_status");
                        }
                    }
                    else if (strcmp ($res, "INVALID") == 0)
                    {
                        $this->log("IPN Failure -- Invalid Transaction Detected - Transaction ID $txn_id");
                    }
                }
                fclose ($fp);
            }
            
            exit;
        }
        
        private function save_ipn($ipn) {
            
            //create a donor record
            $this->Donation->Donor->set('d_name', $ipn["first_name"] . " " . $ipn["last_name"]);
            $this->Donation->Donor->set('d_mailing_name', $ipn["first_name"]);
            $this->Donation->Donor->set('d_email', $ipn["payer_email"]);
            $this->Donation->Donor->set('d_type', "PERSONAL");
            if($this->Donation->Donor->save()) {
                $this->Donation->set('don_d_id', $this->Donation->Donor->id);
            } else {
                $this->log_ipn_failure($ipn, "Donor save failed");
                return false;
            }
                    
            //create the revenue source record
            $this->Donation->RevenueSource->set('rs_amt', $ipn["payment_gross"]);
            $this->Donation->RevenueSource->set('rs_deposit_amt', $ipn["payment_gross"] - $ipn["payment_fee"]);
            $this->Donation->RevenueSource->set('rs_type', "PAYPAL");
            $this->Donation->RevenueSource->set('rs_num', $ipn["txn_id"]);
            if($this->Donation->RevenueSource->save()) {
                $this->Donation->set('don_rs_id', $this->Donation->RevenueSource->id);
            } else {
                $this->log_ipn_failure($ipn, "Revenue source save failed");
                $this->Donation->Donor->delete();
                return false;
            }
            
            //save the donation
            $this->Donation->set('don_date_processed', date("Y-m-d H:i:s"));
            $this->Donation->set('don_date', date_parse($ipn["payment_date"]));
            //only validates iff in x.xx format
            $this->Donation->set('don_amt', number_format($ipn["payment_gross"], 2, '.', ''));
            $this->Donation->set('don_r_id', $ipn["rider_id"]);
            
            if(!$this->Donation->save()) {
                $this->log_ipn_failure($ipn, "Donation save failed");
                //rollback saving the donor and the revenue source
                $this->Donation->Donor->delete();
                $this->Donation->RevenueSource->delete();
                return false;
            }
            
            return true;
        }
        
        private function log_ipn_failure($ipn, $reason = "") {
            $this->log("Failure to save donation via IPN (" . $reason . "): " . print_r($ipn, true));
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