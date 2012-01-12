<?php
	class Donation extends AppModel {
		var $name = 'Donation';
		var $primaryKey = 'don_id';
		var $validate = array(
			'don_date' => array(
				'rule' => 'notEmpty',
				'message' => 'Please specify date donation was recieved'
			),
			'don_amt' => array(
				'amt_numeric' => array(
					'rule' => array('decimal', 2),
					'message' => 'Please specify a valid dollar amount'
				)
			)
		);
		var $belongsTo = array(
			'Donor' => array(
				'foreignKey' => 'don_d_id',
				'className' => 'Donor'
			),
			'RevenueSource' => array(
				'foreignKey' => 'don_rs_id',
				'className' => 'RevenueSource'
			)
		);
	}
?>