<?php echo $this->Html->css("tablesorter-theme/style.css"); ?>
<?php echo $this->Html->script('jquery.tablesorter.min.js'); ?>
<?php echo $this->Html->script('views/rider_summaries/index.js'); ?>
<script type="text/javascript" language="javascript">
    var thisUrl = "<?php echo $this->Html->url(array("controller" => "rider_summaries", "action" => "index")); ?>";
    var thisYear = <?php echo $currentYear; ?>;
    var showProgressBars = <?php echo isset($target) ? "true" : "false" ?>;
    var targetAmt = <?php echo isset($target['Rules']['rule_amt']) ? $target['Rules']['rule_amt'] : 0; ?>;
</script>
<style type="text/css">
    .amt {
        text-align: right;
    }
</style>
<ul class='actions'>
    <li>
        <?php echo $this->Html->link('Add a rider', array(
            'controller' => 'riders',
            'action' => 'add'
        )) ?>
    </li>
</ul>
<div id="fundraisingSummary" style="position: absolute; right: 8px; top: 8px; text-align: right;">
	<div style="float: left; margin: 0 3px;">
		<p style="margin: 5px 0;">Total fundraising for <?php echo $currentYear; ?></p>
		<h2 style="margin-top: 0;">$<span id="fundraisingTotal"></span></h2>
	</div>
	<div style="float: left; margin: 0 3px;">
		<p style="margin: 5px 0">Average per rider</p>
		<h2 style="margin-top: 0;">$<span id="fundraisingAverage"></span></h2>
	</div>
</div>
<h2>
    <select id="year">
    <?php foreach($valid_years as $year): ?>
        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
    <?php endforeach; ?>
    </select>
    <a href='#' title="click here to see another year's data" id="changeYear"><?php echo $currentYear; ?></a> Team Summary
<?php if(isset($target['Rules']['rule_amt'])) { ?>
    - <a id='showProgressBars' href='#'>See Progress</a>
<?php } ?>
</h2>
<table id="riderSummary" class="tablesorter">
	<thead>
		<tr>
			<th class='progress-bar'>First Name</th>
			<th class='progress-bar'>Last Name</th>
			<th class='progress-bar'>Amount Raised</th>
        <?php if(isset($target)) { ?>
            <th>Amount Remaining</th>
        <?php } ?>
			<th># Unique Donations</th>
			<th></th>
            <th style="display:none;" class='progress-bar progress-bar-header'></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($riders as $rider): ?>
		<tr>
			<td class='progress-bar'><?php echo $rider['RiderSummary']['r_first_name']; ?></td>
			<td class='progress-bar'><?php echo $rider['RiderSummary']['r_last_name']; ?></td>
			<td class="amt total progress-bar">$
            <?php if($rider['RiderSummary']['don_total'] == null) {
                    echo '0.00';
                } else {
                    echo $rider['RiderSummary']['don_total'];
                    echo "<input type='hidden' value='" . $rider['RiderSummary']['don_total'] * 100 ."' class='amt-cents'/>"; 
                }
            ?>
			</td>
        <?php if(isset($target)) { ?>
            <td class="amt">$
            <?php if($rider['RiderSummary']['don_total'] == null) {
                    echo $target['Rules']['rule_amt'];
                } else if($rider['RiderSummary']['don_total'] >= $target['Rules']['rule_amt']) {
                    echo "0.00";
                } else {
                    echo number_format($target['Rules']['rule_amt'] - $rider['RiderSummary']['don_total'],2,'.','');
                }
            ?>
            </td>
        <?php } ?>
			<td class="amt">
            <?php if($rider['RiderSummary']['don_total'] == null) {
                    echo '0';
                } else {
                    echo $rider['RiderSummary']['don_count']; 
                }
            ?>
			</td>
			<td>
				<ul class='rider-actions'>
                    <li style="display: inline;">
                        <?php echo $this->Html->link('View Donations', array('controller' => 'riders', 'action' => 'view', $rider['RiderSummary']['r_id'])) ?>
                    </li>
                    <li style="display: inline;">
                        <?php echo $this->Html->link('Edit Info', array('controller' => 'riders', 'action' => 'edit', $rider['RiderSummary']['r_id'])) ?>
                    </li>
				</ul>
			</td>
            <td style="display:none; width: 61.6%;" class="progress-bar progress-bar-cell">
                <div class="progressBar"></div>
            </td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	<?php if(count($riders) == 0) { ?>
	<tfoot>
		<tr>
			<td colspan='6'>
				There are no riders for this year.
				<?php echo $this->Html->link('Add One!', array('controller' => 'riders', 'action' => 'add')); ?>
			</td>
		</tr>
	<tfoot>
	<?php } ?>
</table>