<?php 
    $this->Html->scriptBlock("$(document).ready(function() { $('#nav_settings').addClass('active'); })", array('inline' => false));
?>

<h2>Settings Configuration</h2>
<?php echo $this->Form->create(); ?>
	<fieldset>
		<?php echo $this->Form->input('year', array('label' => 'Change the current year', 'options' => $valid_years)); ?>
	</fieldset>
	<div class="submit">
		<button type="submit" class="btn">Save Changes</button>
	</div>
<?php echo $this->Form->end(); ?>