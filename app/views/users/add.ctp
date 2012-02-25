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
<?php echo $this->Html->script(array('password_strength_plugin.min.js', 'views/users/add.js'), array('inline' => false)); ?>
<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
        echo "<div style='clear:both;'>";
        echo $this->Form->label('group_id');
		echo $this->Form->select('group_id', array('options' => $groups));
        echo "</div>";
	?>
	</fieldset>
    <div class='submit'>
		<button type='submit' id="saveUser" class='btn'>Save User</button>
        <?php echo $this->Html->link('Cancel', array(
            'controller' => 'users',
            'action' => 'index'
        )) ?>
    </div>
<?php echo $this->Form->end(); ?>
</div>