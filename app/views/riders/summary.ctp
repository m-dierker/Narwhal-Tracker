<?php echo $this->Html->css("tablesorter-theme/style.css"); ?>
<?php echo $this->Html->script(
        array('views/riders/summary.js', 'jquery.tablesorter.min.js'), 
        array('inline' => false)
    );
?>
<h2>
    <?php echo $riders[0]['Rider']['r_first_name'] . " " . $riders[0]['Rider']['r_last_name']; ?>
</h2>
<?php $i = 0; ?>
<?php foreach($riders as $rider): ?>
<div class="riderYearSummary">
    <div class="row" id="fundraisingSummary<?php echo $i ?>">
        <h3 class="span6">
            <?php echo $rider['Rider']['r_year'] ?> Activity:
        </h3>
        <div class="span2 offset2">
            <p style="margin: 5px 0;">Total personal fundraising:</p>
            <h2 style="margin-top: 0;">$<span class="fundraisingTotal" id="fundraisingTotal<?php echo $i ?>"></span></h2>
        </div>
        <div class="span2">
            <p style="margin: 5px 0;">Total team fundraising:</p>
            <h2 style="margin-top: 0;">$<?php echo $team_totals[$rider['Rider']['r_year']] ?></h2>
        </div>
    </div>
    <?php if(count($rider['DonationDonor']) > 0) { ?>
        <table id="fundraisingTable<?php echo $i ?>" class="fundraisingTable tablesorter table table-striped" style="clear: both;">
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
                        <?php echo "<input type='hidden' value='" . $donor['don_amt'] * 100 ."' class='amt-cents'/>" ?>
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