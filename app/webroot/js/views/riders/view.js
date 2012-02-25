$(document).ready(function() {
    $("#nav_rider").addClass("active");

    if($("div.no_donations").length > 0) {
        $("#fundraisingSummary").hide();
    } else {
        var total = 0.0;
        var donations = $("input.amt-cents");
        donations.each(function() {
           total += parseInt($(this).val()) / 100;
        });
        $("#fundraisingTotal").text(total);
        
        $("#riderSummary").tablesorter({
            sortList: [[1,1]]
        });
    }
});