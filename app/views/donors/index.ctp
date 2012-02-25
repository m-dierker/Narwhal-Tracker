<?php $this->Html->scriptBlock("$(document).ready(function() { $('#nav_donor').addClass('active'); });", array('inline' => false)); ?>

<ul class='nav nav-pills'>
    <li>
        <?php echo $this->Html->link('Search the donor list', array(
            'controller' => 'donors',
            'action' => 'search'
        )) ?>
    </li>
</ul>
<h2>Donors</h2>
<!--
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Address</th>
			<th>City</th>
			<th>State</th>
			<th>Zip</th>
			<th>Type</th>
			<th>Wants Newsletter?</th>
            <th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($donors as $donor):?>
		<tr>
			<td>
                <?php echo $this->Html->link($donor['Donor']['d_name'], array(
                    'controller' => 'donors',
                    'action' => 'view',
                    $donor['Donor']['d_id']
                )); ?>
            </td>
			<td><?php echo $donor['Donor']['d_email'] ?></td>
			<td><?php echo $donor['Donor']['d_street_address'] ?> <?php echo $donor['Donor']['d_unit_num'] ?></td>
			<td><?php echo $donor['Donor']['d_city'] ?></td>
			<td><?php echo $donor['Donor']['d_state_code'] ?></td>
			<td><?php echo $donor['Donor']['d_zip'] ?></td>
			<td><?php echo $donor['Donor']['d_type'] ?></td>
			<td><?php echo $donor['Donor']['d_contact'] ?></td>
            <td style="white-space: nowrap">
                <?php echo $this->Html->link('Edit Info', array(
                    'controller' => 'donors',
                    'action' => 'edit',
                    $donor['Donor']['d_id']
                )) ?>
            </td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
-->