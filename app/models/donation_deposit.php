<?php
	class DonationDeposit extends AppModel {
		var $name = 'DonationDeposit';
		var $useTable = 'donation_deposits';
		var $primaryKey = 'dd_rs_id';
		var $hasOne = array (
			'RevenueSource' => array(
				'className' => 'RevenueSources',
				'foreignKey' => 'rs_id'
			)
		);
	}
?>