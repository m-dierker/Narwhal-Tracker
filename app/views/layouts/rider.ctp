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
			Narwhal Tracker: <?php echo $title_for_layout; ?>
		</title>
		<?php
			echo $this->Html->meta('icon');
			echo $this->Html->css('bootstrap.min');
			echo $this->Html->css('jquery-bootstrap/jquery-ui-1.8.16.custom.css');
		?>
	</head>
	<body>
        <div class="navbar">
			<div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Narwhal Tracker</a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li id="nav_rider">
                                <?php echo $this->Html->link('My Summary', array('controller' => 'riders', 'action' => 'index')); ?>
                            </li>
                        </ul>
                        <ul class="nav pull-right">
                            <li class="dropdown" id="nav_meta">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Manage my Account">
                                    Hello, <?php echo $this->Session->read('Auth.User.username'); ?>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <?php echo $this->Html->link('Change password', array('controller' => 'users', 'action' => 'password')); ?>
                                    </li>
                                    <li id="nav_logout">
                                        <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
			</div>
        </div>
        <div class="container">
            <?php echo $this->Session->flash(); ?>
            <?php echo $content_for_layout; ?>
        </div>
        <?php
			echo $this->Html->script('jquery-1.7.1.min');
            echo $this->Html->script("bootstrap.min.js");
            echo $scripts_for_layout;
        ?>
	</body>
</html>