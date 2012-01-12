<h1>Deposit Summary</h1>
<table>
	<thead>
		<tr>
			<th>Deposit Id</th>
			<th>When</th>
			<th>Who</th>
			<th># of Deposit Items</th>
			<th>Deposit Amount</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($deposits as $deposit): ?>
		<tr>
			<td><?php echo $deposit['DepositSummary']['dep_id'] ?></td>
			<td><?php echo $deposit['DepositSummary']['dep_when'] ?></td>
			<td><?php echo $deposit['DepositSummary']['dep_who'] ?></td>
			<td><?php echo $deposit['DepositSummary']['dep_count'] ?></td>
			<td>$<?php echo $deposit['DepositSummary']['dep_amt'] ?></td>
			<td><a href='view/<?php echo $deposit['DepositSummary']['dep_id'] ?>'>View Details</a></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>