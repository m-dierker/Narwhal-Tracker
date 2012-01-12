<script type="text/javascript" language="javascript">
	$(document).ready(function() {
        $("#nav_donations").addClass("selected");
    });
</script>
<ul class='actions'>
    <li>
        <?php echo $this->Html->link('Add another donation', array(
            'controller' => 'donations',
            'action' => 'add'
        )) ?>
    </li>
</ul>
<h2>Donation Summary - <?php echo '$' . $donation['Donation']['don_amt'] . " from " . $donation['Donor']['d_name'] . '!' ?></h2>
<table>
	<tbody>
		<tr>
			<td>Date</td>
			<td><?php echo $donation['Donation']['don_date'] ?></td>
		</tr>
		<tr>
			<td>Date Processed</td>
			<td><?php echo $donation['Donation']['don_date_processed'] ?></td>
		</tr>
		<tr>
			<td>Date Deposited</td>
			<td><?php echo $donation['RevenueSource']['rs_deposit_date'] ?></td>
		</tr>
		<tr>
			<td>Donor</td>
			<td>
                <?php echo $this->Html->link($donation['Donor']['d_name'], array(
                    'controller' => 'donors',
                    'action' => 'view',
                    $donation['Donor']['d_id']
                )) ?>
			</td>
		</tr>
		<tr>
			<td>Comment from Donor</td>
			<td><?php echo $donation['Donation']['don_comment'] ?></td>
		</tr>
		<tr>
			<td>
                    Amount applied to
                    <?php echo $this->Html->link('rider\'s fundraising', array(
                        'controller' => 'riders',
                        'action' => 'view',
                        $donation['Donation']['don_r_id']
                    )) ?>
            </td>
			<td>$<?php echo $donation['Donation']['don_amt'] ?></td>
		</tr>
        <tr>
            <td>Has a receipt been sent?</td>
			<td style="<?php echo $donation['Donation']['don_receipt'] == 'N' ? "background-color: #f00; color: #fff;" : "" ?>">
				<?php echo $donation['Donation']['don_receipt']; ?>
			</td>
        </tr>
	</tbody>
</table>