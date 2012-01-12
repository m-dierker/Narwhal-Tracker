<script type="text/javascript" language="javascript">
	$(document).ready(function() {
        $("#nav_rider").addClass("selected");
        
		if($("div.no-donations").length > 0) {
			$("#fundraisingSummary").hide();
		} else {
			var total = 0.0;
			var donations = $("td.amt");
			var count = donations.size();
			for(var i = 0; i < count; i++) {
				total += parseFloat(donations.eq(i).text().replace("$", ""));
			}
			$("#fundraisingTotal").text(total);
		}
    });
</script>
<ul class='actions'>
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
</ul>
<div id="fundraisingSummary" style="position: absolute; right: 8px; top: 8px; text-align: right;">
	<div style="float: left; margin: 0 3px;">
		<p style="margin: 5px 0;">Total fundraising:</p>
		<h2 style="margin-top: 0;">$<span id="fundraisingTotal"></span></h2>
	</div>
</div>
<h2>
    Rider summary - 
    <?php echo $rider['Rider']['r_first_name'] . " " . $rider['Rider']['r_last_name'] . " (" . $rider['Rider']['r_year'] . ")" ; ?>
</h2>
<?php if(count($rider['DonationDonor']) > 0) { ?>
	<table>
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
				</td>
				<td style="width: 40%;"><?php echo $donor['don_comment'] ?></td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
<?php } else { ?>
	<div class='no_donations'>There are no donations for this rider.</div>
<?php } ?>