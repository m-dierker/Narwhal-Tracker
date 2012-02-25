<?php $this->Html->scriptBlock("$(document).ready(function() { $('#nav_donor').addClass('active'); });", array('inline' => false)); ?>

<?php echo $this->Form->create('Donor'); ?>
	<fieldset>
		<legend>Add a Donor</legend>
		<?php
			echo $this->Form->input('d_name', array('label' => 'Name'));
			echo $this->Form->input('d_mailing_name', array('label' => 'Mailing Name'));
			echo $this->Form->input('d_email', array('label' => 'Email'));
			echo $this->Form->input('d_street_address', array('label' => 'Street Address'));
			echo $this->Form->input('d_unit_num', array('label' => 'Unit Number'));
			echo $this->Form->input('d_city', array('label' => 'City'));
			echo $this->Form->input('d_state_code', array('label' => 'State'));
			echo $this->Form->input('d_zip', array('label' => 'Zip'));
            echo $this->Form->input('d_type', array(
                'label' => 'Donor Type',
                'options' => array(
                   'PERSONAL' => 'Personal',
                   'BUSINESS' => 'Business',
                )
            ));
			echo $this->Form->input('d_contact', array(
				'label' => 'Send Newsletter?',
				'options' => $contact_options
			));
		?>
	</fieldset>
	<div class='submit'>
		<input type='submit' value='Create Donor' class="btn" />
        <?php echo $this->Html->link('Cancel', array(
            'controller' => 'donors',
            'action' => 'index'
        )) ?>
	</div>
<?php echo $this->Form->end(); ?>