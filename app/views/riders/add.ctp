<script type="text/javascript" language="javascript">
	$(document).ready(function() {
        $("#nav_rider").addClass("selected");
        
        var userManager = new UserManagement();
    });
    
    function UserManagement() {
        var fieldset = $("#user_mgmt");
        
        var userSelect = $("#RiderRUserId");
        
        function initialize() {
            $("label[for='RiderRUserId']").addClass('existing_user');
            
            fieldset.find('.existing_user').hide();
            fieldset.find('.new_user').show();
            
            var options = userSelect.find('option').first().text("Create a new user")
            
            userSelect.change(function() { toggleRiderUserMethod(); });
        }
        
        function toggleRiderUserMethod() {
            if(userSelect.val() >= 0) {
                fieldset.find('.existing_user').show();
                fieldset.find('.new_user').hide();
            } else {
                fieldset.find('.existing_user').hide();
                fieldset.find('.new_user').show();
            }
        }
        
        function suggestUserName() {
            var first = $("#RiderRFirstName").val();
            var last = $("#RiderRLastName").val();
        }
        
        initialize();
    }
</script>
<?php echo $this->Form->create('Rider'); ?>
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
		<button type='submit'>Create Rider</button>
		<?php echo $this->Html->link('Cancel', array('controller' => 'riders', 'action' => 'index')); ?>
	</div>
<?php echo $this->Form->end(); ?>