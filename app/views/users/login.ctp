<?php
	echo $this->Session->flash('auth');
	echo $this->Form->create('User', array('action' => 'login'));
	echo $this->Form->inputs(array(
		'legend' => __('Login', true),
		'username',
		'password'
	));
	echo $this->Form->end('Login');
?>
<script type="text/javascript" language="javascript">
	$(document).ready(function() {
		$("#nav_login").addClass('selected');
	});
</script>