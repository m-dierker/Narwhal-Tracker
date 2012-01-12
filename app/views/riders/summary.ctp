<script type="text/javascript" language="javascript">
	$(document).ready(function() {
        $("#nav_rider").addClass("selected");
        
        $("div.fundraisingSummary").each(function(i, el) {
			var total = 0.0;
			var donations = $("#fundraisingTable" + i).find("tbody tr");
			var count = donations.size();
			for(var j = 0; j < count; j++) {
				total += parseFloat(donations.eq(j).find("td.amt").text().replace("$", ""));
			}
			$("#fundraisingTotal" + i).text(total);
        })
        
    });
</script>
<h2>
    <?php echo $riders[0]['Rider']['r_first_name'] . " " . $riders[0]['Rider']['r_last_name']; ?>
</h2>
<?php $i = 0; ?>
<?php foreach($riders as $rider): ?>
<div style="position: relative;">
    <div class="fundraisingSummary" id="fundraisingSummary<?php echo $i ?>" style="position: absolute; right: 8px; top: 8px; text-align: right;">
        <div style="float: left; margin: 0 3px;">
            <p style="margin: 5px 0;">Total <?php echo $rider['Rider']['r_year'] ?> fundraising:</p>
            <h2 style="margin-top: 0;">$<span class="fundraisingTotal"  id="fundraisingTotal<?php echo $i ?>"></span></h2>
        </div>
    </div>
    <h3>
        <?php echo $rider['Rider']['r_year'] ?> Activity:
    </h3>
    <?php if(count($rider['DonationDonor']) > 0) { ?>
        <table id="fundraisingTable<?php echo $i ?>">
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
                            $donor['d_id']
                        )) ?>
                    </td>
                    <td>
                        <?php echo $donor['don_date'] ?>
                    </td>
                    <td class="amt">
                        <?php echo "$" . $donor['don_amt'] ?>
                    </td>
                    <td style="width: 40%;"><?php echo $donor['don_comment'] ?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class='no_donations'>You have not received any donations yet.</div>
    <?php } ?>
</div>
<?php $i++; ?>
<?php endforeach; ?>