<?php
	class Rider extends AppModel {
		var $name = 'Rider';
		var $useTable = 'riders';
		var $primaryKey = 'r_id';
		var $hasMany = array (
			'DonationDonor' => array (
				'className' => 'DonationDonor',
				'foreignKey' => 'don_r_id',
				'order' => 'DonationDonor.don_date ASC'
			)
		);
        
		var $validate = array(
			'r_email' => array(
				'rule' => 'email',
				'message' => 'Please specify a valid email'
			),
			'r_first_name' => array(
				'rule' => 'notEmpty',
				'message' => 'Please specify rider\'s first name'
			),
			'r_last_name' => array(
				'rule' => 'notEmpty',
				'message' => 'Please specify rider\'s last name'
			),
		);
	}
?>