<ul class="actions">
	<li>
        <?php echo $this->Html->link('Add a rule', array(
            'controller' => 'rules',
            'action' => 'add'
        )); ?>
    </li>
</ul>
<h2>Rules summary</h2>
<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Date</th>
			<th>Amount</th>
			<th>Color Value</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($rules as $rule): ?>
		<tr>
			<td><?php echo $rule['Rule']['rule_name'] ?></td>
			<td><?php echo $rule['Rule']['rule_date'] ?></td>
			<td>$<?php echo $rule['Rule']['rule_amt'] ?></td>
			<td style="
                background-color: <?php echo $rule['Rule']['rule_color'] ?>;
                color:
                    <?php if($rule['Rule']['rule_color'] == '#ffff00') { echo "#000"; } ?>">
                <?php echo $rule['Rule']['rule_color'] ?>
            </td>
			<!--<td>
                <?php echo $this->Html->link('Edit Details', array(
                    'controller' => 'rules',
                    'action'  => 'edit',
                    $rule['Rule']['rule_id']
                )); ?>
            </td>-->
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>