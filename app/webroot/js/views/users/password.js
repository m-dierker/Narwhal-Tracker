$(document).ready(function() {
    $("#nav_meta").addClass('active');
    
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
        .keypress(function() { $("span.matchresult").hide(); });

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