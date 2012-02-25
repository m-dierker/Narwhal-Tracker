<?php
	echo $this->Session->flash('auth');
	echo $this->Form->create('User', array('action' => 'login'));
	echo $this->Form->inputs(array(
		'legend' => __('Login', true),
		'username',
		'password'
	));
?>
<div class='submit'>
    <button type='submit' class="btn">Login</button>
</div>
<?php    
	echo $this->Form->end();
    echo $this->Html->scriptBlock('$(document).ready(function() { $("#nav_login").addClass("active"); });', array('inline' => false));
?>