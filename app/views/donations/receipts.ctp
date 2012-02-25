<?php $this->Html->scriptBlock("$(document).ready(function() { $('#nav_donations').addClass('active'); });", array('inline' => false)); ?>

<ul class="nav nav-pills">
    <li>
        <?php echo $this->Html->link('Export to csv', array(
                'controller' => 'donations',
                'action' => 'export',
                'ext' => 'csv'
            ),
            array('target' => '_blank')
        ); ?>
    </li>
    <li>
        <?php echo $this->Html->link('Mark all as receipted', array(
                'controller' => 'donations',
                'action' => 'mark'
        )); ?>
    </li>
</ul>
<h2>Receipt Management</h2>
<h3>The following donations need to be receipted:</h3>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Id</th>
			<th>Date Processed</th>
			<th>Name</th>
			<th>Amount</th>
			<th>Type</th>
			<th>Record Number</th>
			<th>Deposited?</th>
            <th>Contact how?</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($donations as $donation): ?>
		<tr>
			<td><?php echo $donation['Donation']['don_id']; ?></td>
			<td><?php echo $donation['Donation']['don_date_processed']; ?></td>
			<td><?php echo $donation['Donor']['d_name']; ?></td>
			<td>$<?php echo $donation['Donation']['don_amt']; ?></td>
			<td><?php echo $donation['RevenueSource']['rs_type']; ?></td>
			<td><?php echo $donation['RevenueSource']['rs_num']; ?></td>
			<td><?php echo $donation['RevenueSource']['rs_deposit_date']; ?></td>
            <td>
                <?php 
                    if($donation['Donor']['d_email']) {
                        echo 'Email';
                    } else if($donation['Donor']['d_street_address']) {
                        echo 'Snail Mail';
                    } else {
                        echo 'No contact info provided!';
                    }
                ?>
            </td>
		</tr>
	<?php endforeach; ?>
	</tbody>
<?php if(count($donations) == 0) { ?>
    <tfoot>
        <tr>
            <td colspan="7">All donations have been receipted!</td>
        </tr>
    </tfoot>
<?php } ?>
</table>