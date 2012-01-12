<h2>Settings Configuration</h2>
<?php echo $this->Form->create(); ?>
	<fieldset>
		<?php echo $this->Form->input('year', array('label' => 'Change the current year', 'options' => $valid_years)); ?>
	</fieldset>
	<div class="submit">
		<button type="submit">Save Changes</button>
	</div>
<?php echo $this->Form->end(); ?>