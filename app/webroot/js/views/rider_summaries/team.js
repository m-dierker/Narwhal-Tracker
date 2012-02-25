$(document).ready(function() {
    $("#nav_rider").addClass("active");

    var count = parseInt($("#teamCount").text());

    if(count > 0) {
        var total = parseFloat($("#fundraisingTotal").text());
        $("#fundraisingAverage").text(Math.round(total/count));
    }
    
    $(".tablesorter").tablesorter({
        headers: {
            3: { sorter: false }
        },
        sortList: [[1,0]]
    });
});