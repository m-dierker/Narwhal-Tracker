<?php $this->Html->scriptBlock("$(document).ready(function() { $('#nav_donor').addClass('active'); });", array('inline' => false)); ?>

<?php if(isset($this->params['url']['origin'])) {?>
    <?php echo $this->Html->link('Go back to rider page', array(
        'controller' => 'riders',
        'action' => 'view',
        $this->params['url']['origin']
    )) ?>
<?php } ?>
<?php if(!isset($is_rider)) { ?>
    <ul class="nav nav-pills">
        <li>
            <?php echo $this->Html->link('Edit donor information', array(
                'controller' => 'donors',
                'action' => 'edit',
                $donor['Donor']['d_id']
            )) ?>
        </li>
        <li>
            <?php echo $this->Html->link('Log a donation from ' . $donor['Donor']['d_name'], array(
                'controller' => 'donations',
                'action' => 'add',
                null,
                '?' => array('donor' => $donor['Donor']['d_id'])
            )) ?>
        </li>
    </ul>
<?php } ?>
<h2>Donor Summary - <?php echo $donor['Donor']['d_name'] ?></h2>
<table>
	<tr>
		<td>Mailing Name</td>
		<td><?php echo $donor['Donor']['d_mailing_name'] ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><?php echo $donor['Donor']['d_email'] ?></td>
	</tr>
	<tr>
		<td>Address</td>
		<td>
			<?php echo $donor['Donor']['d_street_address'] ?>
			<br />
			<?php echo $donor['Donor']['d_city'] ?>,
			<?php echo $donor['Donor']['d_state_code'] ?>&nbsp;
			<?php echo $donor['Donor']['d_zip'] ?>
		</td>
	</tr>
    <tr>
        <td>Donor Type</td>
        <td>
            <?php echo $donor['Donor']['d_type'] ?>
        </td>
    </tr>
<?php if(!isset($is_rider)) { ?>
	<tr>
		<td>Send Newsletter?</td>
		<td><?php echo $donor['Donor']['d_contact'] ?></td>
	</tr>
<?php } ?>
</table>
<?php if(!isset($is_rider)) { ?>
<h2>Donations summary</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date Made</th>
                <th>Processed</th>
                <th>Deposited</th>
                <th>Comment</th>
                <th>Rider</th>
                <th>Amount</th>
                <th>Receipt sent?</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($donations as $donation): ?>
            <tr>
                <td><?php echo $donation['Donation']['don_date'] ?></td>
                <td><?php echo $donation['Donation']['don_date_processed'] ?></td>
                <td><?php echo $donation['RevenueSource']['rs_deposit_date'] ?></td>
                <td><?php echo $donation['Donation']['don_comment'] ?></td>
                <td>
                    <?php echo $this->Html->link('View', array(
                        'controller' => 'riders',
                        'action' => 'view',
                        $donation['Donation']['don_r_id']
                    )) ?>
                </td>
                <td>$<?php echo $donation['Donation']['don_amt'] ?></td>
                <td style="<?php echo $donation['Donation']['don_receipt'] == 'N' ? "background-color: #f00; color: #fff;" : "" ?>">
                    <?php echo $donation['Donation']['don_receipt']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>