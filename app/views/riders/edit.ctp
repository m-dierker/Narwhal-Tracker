<?php 
    echo $this->Html->scriptBlock("$(document).ready(function() { $('#nav_rider').addClass('active'); })", array('inline' => false));
    echo $this->Form->create('Rider', array('action' => 'edit'));
?>
	<fieldset>
		<legend>Edit Rider Information</legend>
		<?php 
			echo $this->Form->input('r_email', array( 'label' => 'Email'));
			echo $this->Form->input('r_first_name', array( 'label' => 'First Name'));
			echo $this->Form->input('r_last_name', array( 'label' => 'Last Name'));
			echo $this->Form->input('r_year', array( 
				'label' => 'Ride Year',
				'options' => $valid_years
			));
            echo $this->Form->input('r_user_id', array(
                'label' => 'User Name',
                'options' => $user_list
            ));
		?>
	</fieldset>
	<div class='submit'>
		<button type='submit' class="btn">Save Changes</button>
		<?php echo $this->Html->link('Cancel', array('controller' => 'riders', 'action' => 'index')); ?>
	</div>
<?php echo $this->Form->end(); ?>