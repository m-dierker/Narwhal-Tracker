<script type="text/javascript" language="javascript">
	$(document).ready(function() {
        $("#nav_donations").addClass("selected");
    });
</script>
<?php echo $this->Html->script('views/donations.js'); ?>
<?php echo $this->Form->create('Donation', array('action' => 'add')); ?>
	<fieldset>
		<legend>Log a Donation</legend>
		<?php 
			echo $this->Form->label('Donation.don_date', 'Date recieved');
			echo "<p class='date-select'>"
			 . $this->Form->dateTime('Donation.don_date', 'MDY', null, null)
			 . "</p>";
			echo $this->Form->input('Donation.don_r_id', array(
				'label' => 'Rider',
				'options' => $riders,
				'selected' => isset($rider) ? $rider : 0
			));
			echo $this->Form->input('Donation.don_amt', array('label' => 'Amount applied to fundraising'));
		?>
		<fieldset>
			<legend>Donor Information</legend>
			<?php
                if(isset($donor)) {
                    echo $this->Form->hidden("Donation.don_d_id", array('value' => $donor['Donor']['d_id']));
                    echo "<div>" . 
                            $this->Html->link($donor['Donor']['d_name'],
                                array(
                                    'controller' => 'donors',
                                    'action' => 'view',
                                    $donor['Donor']['d_id']
                                ),
                                array('target' => '_blank')    
                            ) . 
                        "</div>";
                    
                } else {
                    echo $this->Form->input('Donor.0.d_name', array('label' => 'Name'));
                    echo $this->Form->input('Donor.0.d_mailing_name', array('label' => 'Mailing Name'));
                    echo $this->Form->input('Donor.0.d_email', array('label' => 'Email'));
                    echo $this->Form->input('Donor.0.d_street_address', array('label' => 'Street Address'));
                    echo $this->Form->input('Donor.0.d_unit_num', array('label' => 'Unit Number'));
                    echo $this->Form->input('Donor.0.d_city', array('label' => 'City'));
                    echo $this->Form->input('Donor.0.d_state_code', array('label' => 'State'));
                    echo $this->Form->input('Donor.0.d_zip', array('label' => 'Zip'));
                    echo $this->Form->input('Donor.0.d_type', array(
                        'label' => 'Donor Type',
                        'options' => array(
                           'PERSONAL' => 'Personal',
                           'BUSINESS' => 'Business',
                        )
                    ));
                    echo $this->Form->input('Donor.0.d_contact', array(
                        'label' => 'Send Newsletter?',
                        'options' => $contact_options
                    ));
                }
                echo $this->Form->input('Donation.don_comment', array('label' => 'Comment from Donor', 'type' => 'textarea'));
			?>
		</fieldset>
		<fieldset>
			<legend>Revenue Source Information</legend>
			<?php
				echo $this->Form->input('RevenueSource.0.rs_type', array(
					'label' => 'Source Type?',
					'options' => $revenue_types
				));
				echo $this->Form->input('RevenueSource.0.rs_amt', array('label' => 'Source Amount'));
				echo $this->Form->input('RevenueSource.0.rs_deposit_amt', array('label' => 'Deposit Amount'));
				echo $this->Form->input('RevenueSource.0.rs_num', array('label' => 'Check or PayPal Number'));
			?>
			<fieldset id="checkAddress">
				<legend>Please enter any of the following if the address on the check differs from the donor address:</legend>
				<?php
					echo $this->Form->input('RevenueSource.0.rs_check_name', array('label' => 'Name'));
					echo $this->Form->input('RevenueSource.0.rs_check_street_address', array('label' => 'Street Address'));
					echo $this->Form->input('RevenueSource.0.rs_check_unit_num', array('label' => 'Unit Number'));
					echo $this->Form->input('RevenueSource.0.rs_check_city', array('label' => 'City'));
					echo $this->Form->input('RevenueSource.0.rs_check_state_code', array('label' => 'State'));
					echo $this->Form->input('RevenueSource.0.rs_check_zip', array('label' => 'Zip'));
				?>
			</fieldset>
		</fieldset>
	</fieldset>
	<div class='submit'>
		<button type='submit'>Log Donation</button>
        <?php echo $this->Html->link('Cancel', array(
            'controller' => 'donations',
            'action' => 'index'
        )) ?>
	</div>
<?php echo $this->Form->end(); ?>