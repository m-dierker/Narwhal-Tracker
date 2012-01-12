<h2>Release History</h2>
<style>
	ul.release_list > li {
		font-weight: bold;
	}
</style>
<ul class="release_list">
<?php foreach($releases as $release): ?>
	<li><?php echo $release['Release']['dev_label']; ?></li>
	<ul>
		<li><?php echo $release['Release']['dev_description']; ?></li>
	</ul>
<?php endforeach; ?>
</ul>
<!--
<?php echo $this->Html->link('See upcoming releases and steps', array('controller' => 'releases', 'action' => 'upcoming')); ?>
-->