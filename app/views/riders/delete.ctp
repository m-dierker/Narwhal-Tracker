<?php 
    echo $this->Html->scriptBlock("$(document).ready(function() { $('#nav_rider').addClass('active'); })", array('inline' => false));
    echo $this->Form->create('Rider', array('action' => 'delete'));
?>
    <fieldset>
        <legend>
            Delete Rider: <?php echo $this->data['Rider']['r_first_name'] . " " . $this->data['Rider']['r_last_name'] ?>
        </legend>
        <p>This action cannot be undone and will also delete the rider's user record </p>
        <?php echo $this->Form->hidden("r_id") ?>
        <div class="submit">
            <button type='submit' class="btn">Delete Rider</button>
		<?php echo $this->Html->link('Cancel', array('controller' => 'riders', 'action' => 'index')); ?>
        </div>
    </fieldset>
<?php echo $this->Form->end(); ?>