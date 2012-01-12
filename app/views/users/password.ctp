<script type="text/javascript" language="javascript">
	$(document).ready(function() {
        var current = $("#UserPassword")
            .after(
                $("<span/>")
                    .text("Please enter your current password!")
                    .addClass("currentresult")
                    .addClass('badPass')
                    .hide()
            )
            .blur(function() {
                if($(this).val() == "") {
                    $("span.currentresult").show();
                }
            })
            .focus(function() { $("span.currentresult").hide(); })
        
        var newPass = $("#UserNewPassword")
            .passStrength({
                userid: "#UserUsername"
            })
            .css("float", "left")
            .keypress(function() { $("span.matchresult").hide(); });

        $("span.testresult").css("float", "left");
        
        $("#UserNewPassword1")
            .after(
                $("<span/>")
                    .text("Your passwords don't match")
                    .addClass("matchresult")
                    .addClass('badPass')
                    .hide()
            )
            .blur(function(){
                if($(this).val() != $("#UserNewPassword").val()) {
                    $('span.matchresult').show();
                }
            })
            .focus(function() { $("span.matchresult").hide(); });
        
        $("#savePassword").click(function() {
            if($(".shortPass, .badPass:visible").length > 0) {
                alert("Please use a stronger password and make sure your passwords match");
                return false;
            }
            return true;
        });
    });
</script>
<style type="text/css">
    .testresult, .matchresult, .currentresult {
        float: left;
        display: block;
        margin: 3px;
        font-weight: bold;
    }
    
    .shortPass
    {
        color: #C00;
    }
    
    .badPass
    {
        color: #c60;
    }
    
    .goodPass
    {
        color: #cb0;
    }

    .strongPass
    {
        color: #6c0;
    }
</style>
<?php echo $this->Html->script('password_strength_plugin.min.js'); ?><h2>Change your password</h2>
<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
	<?php
        echo $this->Form->input('password', array('value' => '', 'label' => 'Current Password'));
        echo $this->Form->input('new_password', array(
            'type' => 'password', 'label' => 'New Password', 'class' => 'new-pass'
        ));
        echo $this->Form->input('new_password1', array(
            'type' => 'password', 'label' => 'Retype Password', 'class' => 'new-pass'
        ));
        echo $this->Form->hidden('username');
	?>
	</fieldset>
	<div class='submit'>
        <button type='submit' id="savePassword">Save Changes</button>
        <?php echo $this->Html->link('Cancel', array(
            'action' => 'index'
        )) ?>
	</div>
<?php echo $this->Form->end();?>
</div>