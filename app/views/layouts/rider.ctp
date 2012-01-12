<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			Narwhal Tracker: 
			<?php echo $title_for_layout; ?>
		</title>
		<?php
			echo $this->Html->meta('icon');
			//echo $this->Html->css('cake.generic');
			echo $this->Html->css('generic');
            echo $this->Html->css('dot-luv/jquery-ui-1.8.16.custom');
			echo $this->Html->script('jquery-1.6.2.min');
			echo $this->Html->script('jquery-ui-1.8.16.custom.min');
			echo $scripts_for_layout;
		?>
	</head>
	<body>
		<div id="container" class="internal">
			<div id="header">
				<h1>Narwhal Tracker</h1>
                <div id="userThingy">
                    <?php echo $this->Session->read('Auth.User.username'); ?>!
                    <ul class="actions">
                        <li>
                            <?php echo $this->Html->link('Change password', array('controller' => 'users', 'action' => 'password')); ?>
                        </li>
                    </ul>
                </div>
			</div>
			<ul id="nav">
				<li id="nav_rider">
					<?php echo $this->Html->link('My Summary', array('controller' => 'riders', 'action' => 'index')); ?>
				</li>
				<li id="nav_logout">
					<?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?>
				</li>
			</ul>
			<div id="content" style="position: relative;">
				<?php echo $this->Session->flash(); ?>
				<?php echo $content_for_layout; ?>
			</div>
			<div id="footer">
				<?php echo $this->Html->link(
						$this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
						'http://www.cakephp.org/',
						array('target' => '_blank', 'escape' => false)
					);
				?>
			</div>
		</div>
	</body>
</html>