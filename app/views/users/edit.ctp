<script type="text/javascript" language="javascript">
	$(document).ready(function() {
        
    });
</script>
<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->label('group_id');
		echo $this->Form->select('group_id', array('options' => $groups));
	?>
	</fieldset>
	<div class='submit'>
		<input type='submit' value='Save Changes' />
        <?php echo $this->Html->link('Cancel', array(
            'action' => 'index'
        )) ?>
	</div>
<?php echo $this->Form->end();?>
</div>