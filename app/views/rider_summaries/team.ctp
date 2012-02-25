<?php echo $this->Html->css("tablesorter-theme/style.css"); ?>
<?php echo $this->Html->script(
        array('views/rider_summaries/team.js', 'jquery.tablesorter.min.js'), 
        array('inline' => false)
    ); 
?>
<?php if(isset($rider_list)) { ?>
<ul class='nav nav-pills'>
    <li>
        <?php echo $this->Html->link('Add a rider', array(
            'controller' => 'riders',
            'action' => 'add'
        )) ?>
    </li>
</ul>
<?php } ?>
<div class="row">
    <div class="span4">
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
    <div class="span8">
        <h2>Roster</h2>
        <table class="table table-striped tablesorter">
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
                            <li style="display: inline;">
                                <?php echo $this->Html->link('Delete Rider', array('controller' => 'riders', 'action' => 'delete', $rider['RiderSummary']['r_id'])) ?>
                            </li>
                        </ul>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php } ?>
</div>