<?php $this->Html->scriptBlock("$(document).ready(function() { $('#nav_donor').addClass('active'); });", array('inline' => false)); ?>

<ul class='nav nav-pills'>
    <li>
        <?php echo $this->Html->link('See all donors', array(
            'controller' => 'donors',
            'action' => 'index'
        )) ?>
    </li>
</ul>
<h2>Donor Search</h2>
<?php echo $this->Form->create('Donor'); ?>
    <fieldset>
        <?php
            echo $this->Form->input('d_name', array('label' => 'Name'));
			echo $this->Form->input('d_street_address', array('label' => 'Address'));
			echo $this->Form->input('d_city', array('label' => 'City'));
			echo $this->Form->input('d_state_code', array('label' => 'State'));
            echo $this->Form->input('d_type', array(
                'label' => 'Donor Type',
                'options' => array(
                    '0' => 'Either',
                    'PERSONAL' => 'Personal',
                    'BUSINESS' => 'Business'
                )
            ));
            echo $this->Form->input('d_contact', array(
                'label' => 'Wants Newsletter?',
                'options' => array(
                    '-1' => 'Either',
                    '0' => 'No',
                    '1' => 'Yes'
                )
            ));
        ?>
    </fieldset>
	<div class='submit'>
		<input type='submit' value='Search' class="btn" />
        <?php echo $this->Html->link('Cancel', array(
            'controller' => 'donors',
            'action' => 'index'
        )) ?>
	</div>
<?php echo $this->Form->end();?>
<?php if(isset($results)) { ?>
<h3><?php echo count($results) . " donors found" ?></h3>
<table class='table table-striped'>
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Address</th>
			<th>City</th>
			<th>State</th>
			<th>Zip</th>
			<th>Wants Newsletter?</th>
            <th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($results as $donor):?>
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
			<td><?php echo $donor['Donor']['d_contact'] ?></td>
            <td style="white-space: nowrap">
                <?php echo $this->Html->link('View Info', array(
                    'controller' => 'donors',
                    'action' => 'view',
                    $donor['Donor']['d_id']
                )) ?>
                <?php echo $this->Html->link('Edit Info', array(
                    'controller' => 'donors',
                    'action' => 'edit',
                    $donor['Donor']['d_id']
                )) ?>
            </td>
		</tr>
	<?php endforeach; ?>
    <?php if(count($results) == 0) { ?>
        <tr>
            <td colspan='8'>No donors match your search criteria. Try again!</td>
        </tr>
    <?php } ?>
	</tbody>
</table>
<?php } ?>