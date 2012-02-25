$(document).ready(function() {
    $("#UserPassword")
        .passStrength({
            userid: "#UserUsername"
        })
        .css("float", "left");

    $("span.testresult").css("float", "left");


    $("#saveUser").click(function() {
        if($(".shortPass, .badPass").length > 0) {
            alert("Please use a stronger password.");
            return false;
        }
        return true;
    })
});