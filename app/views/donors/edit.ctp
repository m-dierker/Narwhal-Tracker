<?php $this->Html->scriptBlock("$(document).ready(function() { $('#nav_donor').addClass('active'); });", array('inline' => false)); ?>

<?php echo $this->Form->create('Donor', array('action' => 'edit')); ?>
	<fieldset>
		<legend>Edit Donor Information</legend>
		<?php
			echo $this->Form->input('d_name', array('label' => 'Name'))
            . $this->Form->input('d_mailing_name', array('label' => 'Mailing Name'))
            . $this->Form->input('d_email', array('label' => 'Email'))
            . $this->Form->input('d_street_address', array('label' => 'Street Address'))
            . $this->Form->input('d_unit_num', array('label' => 'Unit Number'))
            . $this->Form->input('d_city', array('label' => 'City'))
            . $this->Form->input('d_state_code', array('label' => 'State'))
            . $this->Form->input('d_zip', array('label' => 'Zip'))
            . $this->Form->input('d_type', array(
                'label' => 'Donor Type',
                'options' => array(
                   'PERSONAL' => 'Personal',
                   'BUSINESS' => 'Business',
                )
            ))
            . $this->Form->input('d_contact', array(
				'label' => 'Send Newsletter?',
				'options' => $contact_options
			));
		?>
	</fieldset>
	<div class='submit'>
		<input type='submit' value='Save Changes' class="btn"/>
        <?php echo $this->Html->link('Cancel', array(
            'controller' => 'donors',
            'action' => 'view',
            $this->data['Donor']['d_id']
        )) ?>
	</div>
<?php echo $this->Form->end(); ?>