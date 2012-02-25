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
        <style>
            body {
                padding-top: 60px;
            }
        </style>
		<?php
			echo $this->Html->meta('icon');
			echo $this->Html->css('bootstrap.min');
		?>
	</head>
	<body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <?php echo $this->Html->link('Narwhal Tracker', 
                            array(
                                'controller' => 'pages',
                                'action' => 'display'
                            ),
                            array(
                                'class' => 'brand'
                            )
                        );
                    ?>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li id="nav_login">
                                <?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login')); ?>
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
            echo $this->Html->script("jquery-1.6.2.min.js");
			echo $scripts_for_layout;
        ?>
	</body>
</html>