<?php echo $this->Form->create('Rule'); ?>
	<fieldset>
		<legend>Add a Rule</legend>
		<?php 
			echo $this->Form->input('rule_name', array( 'label' => 'Name'));
			echo $this->Form->input('rule_date', array('label' => 'Date'));
			echo $this->Form->input('rule_amt', array( 'label' => 'Amount'));
			echo $this->Form->input('rule_color', array( 'label' => 'Color Value'));
		?>
	</fieldset>
	<div class='submit'>
		<button type='submit'>Create Rule</button>
		<?php echo $this->Html->link('Cancel', array(
            'controller' => 'rules',
            'action' => 'index'
        )); ?>
	</div>
<?php echo $this->Form->end(); ?>