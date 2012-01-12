<?php
	class Deposit extends AppModel {
		var $name = 'Deposit';
		var $useTable = 'deposits';
		var $primaryKey = 'dep_id';
		
		var $hasMany = array (
			'DonationDeposit' => array (
				'className' => 'DonationDeposit',
				'foreignKey' => 'dd_dep_id',
			)
		);
	}
?>