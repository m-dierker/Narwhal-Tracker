<script type="text/javascript" language="javascript">
	$(document).ready(function() {
        $("#nav_rider").addClass("selected");
    });
</script>
<?php echo $this->Form->create('Rider', array('action' => 'delete')); ?>
    <fieldset>
        <legend>
            Delete Rider: <?php echo $this->data['Rider']['r_first_name'] . " " . $this->data['Rider']['r_last_name'] ?>
        </legend>
        <p>This action cannot be undone and will also delete the rider's user record </p>
        <?php echo $this->Form->hidden("r_id") ?>
        <div class="submit">
            <button type='submit'>Delete Rider</button>
            <?php echo $this->Html->link('Cancel', array('action' => 'view', $this->data['Rider']['r_id'])); ?>
        </div>
    </fieldset>
<?php echo $this->Form->end(); ?>