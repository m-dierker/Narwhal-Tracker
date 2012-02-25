<?php echo $this->Html->script(array('password_strength_plugin.min.js', 'views/users/password.js'), array('inline' => false)); ?>
<style type="text/css">
    
    .testresult, .matchresult, .currentresult {
        float: left;
        display: block;
        margin: 3px;
        font-weight: bold;
    }
    
    div.input input {
        float: left;
    }
    
    div.input {
        clear: both;
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
<h2>Change your password</h2>
<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
	<?php
        echo $this->Form->input('password', array('value' => '', 'label' => 'Current Password'));
        echo $this->Form->input('new_password', array(
            'type' => 'password', 'label' => 'New Password', 'class' => 'new-pass'
        ));
        echo $this->Form->input('new_password1', array(
            'type' => 'password', 'label' => 'Retype Password', 'class' => 'new-pass'
        ));
        echo $this->Form->hidden('username');
	?>
	</fieldset>
	<div class='submit'>
        <button type='submit' id="savePassword" class="btn">Save Changes</button>
        <?php echo $this->Html->link('Cancel', array(
            'action' => 'index',
            'controller' => 'riders'
        )) ?>
	</div>
<?php echo $this->Form->end();?>
</div>