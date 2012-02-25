<?php 
    echo $this->Html->scriptBlock("$(document).ready(function() { $('#nav_rider').addClass('active'); })", array('inline' => false));
    echo $this->Html->script('views/riders/add.js', array('inline' => false));
    echo $this->Form->create('Rider');
?>
	<fieldset>
		<legend>Add a Rider</legend>
		<?php 
			echo $this->Form->input('r_email', array( 'label' => 'Email'));
			echo $this->Form->input('r_first_name', array( 'label' => 'First Name'));
			echo $this->Form->input('r_last_name', array( 'label' => 'Last Name'));
			echo $this->Form->input('r_year', array( 
				'label' => 'Ride Year',
				'options' => $valid_years
			));
            echo "<fieldset id='user_mgmt'>";
            echo "<legend>Create a User</legend>";
            echo $this->Form->input('r_user_id', array(
                'label' => 'Username',
                'options' => $user_list
            ));
            echo "<div class='new_user'>";
            echo $this->Form->input('r_user_username', array('label' => 'Username'));
            echo $this->Form->input('r_user_password', array('label' => 'Password'));
            echo "</div>";
            echo "</fieldset>";
		?>
	</fieldset>
	<div class='submit'>
		<button type='submit' class='btn'>Create Rider</button>
		<?php echo $this->Html->link('Cancel', array('controller' => 'riders', 'action' => 'index')); ?>
	</div>
<?php echo $this->Form->end(); ?>