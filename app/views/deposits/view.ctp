<h2>Deposit Details - <?php echo $deposit['Deposit']['dep_when'] ?></h2>
<p>This deposit was prepared by <?php echo $deposit['Deposit']['dep_who'] ?></p>
<table>
	<thead>
		<tr>
			<th>Revenue Item</th>
			<th>Deposit Amount</th>
			<th>Source Type</th>
			<th>Source Id</th>
			<th>Note</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($sources as $source): ?>
		<tr>
			<td><?php echo $source['RevenueSource']['rs_id'] ?></td>
			<td>$<?php echo $source['RevenueSource']['rs_deposit_amt'] ?></td>
			<td><?php echo $source['RevenueSource']['rs_type'] ?></td>
			<td><?php echo $source['RevenueSource']['rs_num'] ?></td>
			<td><?php echo $source['DonationDeposit']['dd_status'] ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>