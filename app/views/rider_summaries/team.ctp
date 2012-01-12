<script type="text/javascript" language="javascript">
	$(document).ready(function() {
        $("#nav_rider").addClass("selected");
        
        var count = parseInt($("#teamCount").text());
        
        if(count > 0) {
            var total = parseFloat($("#fundraisingTotal").text());
            $("#fundraisingAverage").text(Math.round(total/count));
        }
	});
</script>
<?php if(isset($rider_list)) { ?>
<ul class='actions'>
    <li>
        <?php echo $this->Html->link('Add a rider', array(
            'controller' => 'riders',
            'action' => 'add'
        )) ?>
    </li>
</ul>
<?php } ?>
<div style="float: left; margin-right: 19px;">
    <h2><?php echo $currentYear; ?> Team Summary</h2>

    <h3><span id="teamCount"><?php echo $rider_count; ?></span> Riders</h3>
    <p>Total fundraising:</p>
    <h3>$<span id="fundraisingTotal"><?php echo isset($team_total[0][0]['total']) ? $team_total[0][0]['total'] : 0; ?></span></h3>
    <p>Average per rider:</p>
    <h3>$<span id="fundraisingAverage">0</span></h3>
    <p>Unassigned fundraising:</p>
    <h3>$<span id="unassigned"><?php echo count($unassigned) > 0 ? $unassigned[0]['RiderSummary']['don_total'] : 0; ?></span></h3>
</div>
<?php if(isset($rider_list) && $rider_count > 0) { ?>
<div>
    <h2>Roster</h2>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($rider_list as $rider): ?>
            <tr>
                <td><?php echo $rider['RiderSummary']['r_first_name']; ?></td>
                <td><?php echo $rider['RiderSummary']['r_last_name']; ?></td>
                <td><?php echo $rider['RiderSummary']['r_email']; ?></td>
                <td>
                    <ul>
                        <li style="display: inline;">
                            <?php echo $this->Html->link('Edit Info', array('controller' => 'riders', 'action' => 'edit', $rider['RiderSummary']['r_id'])) ?>
                        </li>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php } ?>