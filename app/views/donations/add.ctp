<?php $this->Html->scriptBlock("$(document).ready(function() { $('#nav_donations').addClass('active'); });", array('inline' => false)); ?>

<?php echo $this->Html->script('views/donations/donations.js', array('inline' => false)); ?>

<h2>Log a Donation</h2>
<?php echo $this->Form->create('Donation', array('action' => 'add')); ?>
	<fieldset>
		<legend>Basic Information</legend>
        <div style='margin-bottom: 9px;'>
        <?php  
            echo $this->Form->label('Donation.don_date', 'Date recieved');
            echo "<div class='date-select'>"
                    . $this->Form->dateTime('Donation.don_date', 'MDY', null, null)
                . "</div>";
        ?>
            <div class="dropdown" id="datepickerMenu">
                <a class="dropdown-toggle btn" id="datepickerToggle" href="#datepickerMenu">
                    <i class='icon-calendar'></i>
                    Pick Date
                </a>
                <div class='dropdown-menu' id="datepicker"></div>
            </div>
        </div>
        <div class='row'>
        <?php
            echo $this->Form->input('Donation.don_r_id', 
                array(
                    'label' => 'Rider',
                    'options' => $riders,
                    'selected' => isset($rider) ? $rider : 0,
                    'div' => 'span3'
                )
            );
            echo $this->Form->input('Donation.don_amt', array('label' => 'Amount applied to fundraising', 'div' => 'span3'));
        ?>
        </div>
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
                    echo "<div class='row'>";
                        echo $this->Form->input('Donor.0.d_name', array('label' => 'Name', 'div' => 'span3'));
                        echo $this->Form->input('Donor.0.d_mailing_name', array('label' => 'Mailing Name', 'div' => 'span3'));
                    echo "</div>";
                    echo $this->Form->input('Donor.0.d_email', array('label' => 'Email'));
                    echo "<div class='row'>";
                        echo $this->Form->input('Donor.0.d_street_address', array('label' => 'Street Address', 'div' => 'span3'));
                        echo $this->Form->input('Donor.0.d_unit_num', array('label' => 'Unit Number', 'div' => 'span3'));
                    echo "</div>";
                    echo "<div class='row'>";
                        echo $this->Form->input('Donor.0.d_city', array('label' => 'City', 'div' => 'span3'));
                        echo $this->Form->input('Donor.0.d_state_code', array('label' => 'State', 'div' => 'span3'));
                        echo $this->Form->input('Donor.0.d_zip', array('label' => 'Zip', 'div' => 'span1'));
                    echo "</div>";
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
                echo "<div class='row'>";
                    echo $this->Form->input('RevenueSource.0.rs_amt', array('label' => 'Source Amount', 'div' => 'span3'));
                    echo $this->Form->input('RevenueSource.0.rs_deposit_amt', array('label' => 'Deposit Amount', 'div' => 'span3'));
                    echo $this->Form->input('RevenueSource.0.rs_num', array('label' => 'Check or PayPal Number', 'div' => 'span3'));
                echo "</div>";
			?>
			<fieldset id="checkAddress">
				<legend>Please enter any of the following if the address on the check differs from the donor address:</legend>
				<?php
					echo $this->Form->input('RevenueSource.0.rs_check_name', array('label' => 'Name'));
                    echo "<div class='row'>";
                        echo $this->Form->input('RevenueSource.0.rs_check_street_address', array('label' => 'Street Address', 'div' => 'span3'));
                        echo $this->Form->input('RevenueSource.0.rs_check_unit_num', array('label' => 'Unit Number', 'div' => 'span3'));
                    echo "</div>";
                    echo "<div class='row'>";
                        echo $this->Form->input('RevenueSource.0.rs_check_city', array('label' => 'City', 'div' => 'span3'));
                        echo $this->Form->input('RevenueSource.0.rs_check_state_code', array('label' => 'State', 'div' => 'span3'));
                        echo $this->Form->input('RevenueSource.0.rs_check_zip', array('label' => 'Zip', 'div' => 'span3'));
                    echo "</div>";
				?>
			</fieldset>
		</fieldset>
	</fieldset>
	<div class='submit'>
		<button type='submit' class="btn">Log Donation</button>
        <?php echo $this->Html->link('Cancel', array(
            'controller' => 'donations',
            'action' => 'index'
        )) ?>
	</div>
<?php echo $this->Form->end(); ?>