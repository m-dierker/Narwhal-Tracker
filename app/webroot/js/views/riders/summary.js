$(document).ready(function() {
    $("#nav_rider").addClass("active");

    $("div.riderYearSummary").each(function(i, el) {
        var total = 0.0;
        var donations = $(el).find("input.amt-cents");
        donations.each(function() {
           total += parseInt($(this).val()) / 100;
        });
        $("#fundraisingTotal" + i).text(total);
    })

    $("table.fundraisingTable").tablesorter({
        sortList: [[1,1]]
    });
});