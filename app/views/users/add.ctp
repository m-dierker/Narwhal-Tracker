<script type="text/javascript" language="javascript">
	$(document).ready(function() {
        $("#UserPassword")
            .passStrength({
                userid: "#UserUsername"
            })
            .css("float", "left");
        
        $("span.testresult").css("float", "left");
        

        $("#saveUser").click(function() {
            if($(".shortPass, .badPass").length > 0) {
                alert("Please use a stronger password.");
                return false;
            }
            return true;
        })
    });
</script>
<style type="text/css">
    .testresult {
        float: left;
        display: block;
        margin: 3px;
        font-weight: bold;
    }
    
    .shortPass
    {
        color: #C00;
    }
    
    .badPass
    {
        color: #c60;
    }
    
    .goodPass
    {
        color: #cb0;
    }

    .strongPass
    {
        color: #6c0;
    }
</style>
<?php echo $this->Html->script('password_strength_plugin.min.js'); ?>
<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
        echo $this->Form->label('group_id');
		echo $this->Form->select('group_id', array('options' => $groups));
	?>
	</fieldset>
    <div class='submit'>
		<button type='submit' id="saveUser">Save User</button>
        <?php echo $this->Html->link('Cancel', array(
            'controller' => 'users',
            'action' => 'index'
        )) ?>
    </div>
<?php echo $this->Form->end(); ?>
</div>