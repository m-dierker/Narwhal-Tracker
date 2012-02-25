<?php echo $this->Html->css("tablesorter-theme/style.css"); ?>
<?php echo $this->Html->script(
        array('jquery.tablesorter.min.js', 'views/riders/view.js'),
        array('inline' => false)
    );
?>
<style type="text/css">
    .amt {
        text-align: right;
    }
</style>
<div class="row">
    <ul class='nav nav-pills span6'>
        <li>
            <?php echo $this->Html->link('Edit rider information', array('controller' => 'riders', 'action' => 'edit', $rider['Rider']['r_id'])) ?>
        </li>
        <li>
            <?php echo $this->Html->link('Log a donation for ' . $rider['Rider']['r_first_name'], array(
                'controller' => 'donations',
                'action' => 'add',
                null,
                '?' => array('rider' => $rider['Rider']['r_id'])
            )) ?>
        </li>
        <li>
            <?php echo $this->Html->link("Delete this rider", array('action' => 'delete', $rider['Rider']['r_id'])) ?>
        </li>
    </ul>
    <div id="fundraisingSummary" class="span2 offset4">
        <p style="margin: 5px 0;">Total fundraising:</p>
        <h2 style="margin-top: 0;">$<span id="fundraisingTotal"></span></h2>
    </div>
</div>
<h2>
    Rider summary - 
    <?php echo $rider['Rider']['r_first_name'] . " " . $rider['Rider']['r_last_name'] . " (" . $rider['Rider']['r_year'] . ")" ; ?>
</h2>
<?php if(count($rider['DonationDonor']) > 0) { ?>
	<table id="riderSummary" class="tablesorter table table-striped">
		<thead>
			<tr>
				<th>Donor</th>
				<th>Date</th>
				<th>Amount</th>
				<th>Message</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($rider['DonationDonor'] as $donor): ?>
			<tr>
				<td>
                    <?php echo $this->Html->link($donor['d_name'], array(
                        'controller' => 'donors',
                        'action' => 'view',
                        $donor['d_id'],
                        '?' => array('origin' => $rider['Rider']['r_id'])
                    )) ?>
				</td>
				<td><?php echo $donor['don_date'] ?></td>
				<td class="amt">
                    <?php echo $this->Html->link("$" . $donor['don_amt'], array(
                        'controller' => 'donations',
                        'action' => 'view',
                        $donor['don_id']
                    )) ?>
                    <?echo "<input type='hidden' value='" . $donor['don_amt'] * 100 ."' class='amt-cents'/>"; ?>
				</td>
				<td><?php echo $donor['don_comment'] ?></td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
<?php } else { ?>
	<div class='no_donations'>There are no donations for this rider.</div>
<?php } ?>