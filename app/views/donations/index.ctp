<script type="text/javascript" language="javascript">
	$(document).ready(function() {
        $("#nav_donations").addClass("selected");
    });
</script>
<ul class='actions'>
    <li>
        <?php echo $this->Html->link('Add a donation', array(
            'controller' => 'donations',
            'action' => 'add'
        )) ?>
    </li>
    <li>
        <?php echo $this->Html->link('Generate receipts', array(
            'controller' => 'donations',
            'action' => 'receipts'
        )) ?>
    </li>
</ul>
<h2>Donations</h2>
<table>
	<thead>
		<tr>
			<th>Id</th>
			<th>Date Processed</th>
			<th>Name</th>
			<th>Amount</th>
			<th>Type</th>
			<th>Record Number</th>
			<th>Deposited?</th>
			<th>Receipt Sent?</th>
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
			<td style="<?php echo $donation['Donation']['don_receipt'] == 'N' ? "background-color: #f00; color: #fff;" : "" ?>">
				<?php echo $donation['Donation']['don_receipt']; ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>