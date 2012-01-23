$(document).ready(function() {
    $("#nav_rider").addClass("selected");

    if($("#riderSummary tfoot").length > 0) {
        $("#fundraisingSummary").hide();
    } else {
        var total = 0.0,
            donations = $("input.amt-cents"),
            general = $("input.amt-cents-general");
        
        var count = donations.size();
        donations.each(function() {
           total += parseInt($(this).val()) / 100;
        });
        
        if(count > 0) {
            $("#fundraisingAverage").text(Math.round(total / count));
        }
        
        if(general.length > 0) {
            total += parseInt(general.val()) / 100;
        }
        
        $("#fundraisingTotal").text(total);
        
        $("#riderSummary").tablesorter({
            headers: {
                5: { sorter: false },
                6: { sorter: false }
            },
            sortList: [[1,0]]
        });
    }

    var yearSelector = $("#year")
        .val(thisYear)
        .change(function() {
            var selected = $(this).val();
            if(selected != thisYear) {
                window.location = thisUrl + "&year=" + $(this).val();
            }
        })
        .hide();

    $("#changeYear").click(function() {
        yearSelector.toggle();
        $(this).toggle();
    });

    if(showProgressBars) {
        var progressBars = new ProgressBars();

        $("#showProgressBars").click(function() {
            progressBars.toggle();
        })
    }
});

function ProgressBars() {
    var toggleButton = $("#showProgressBars");

    var table = $("#riderSummary");

    var initialized = false, hidden = true;

    function initialize() {
        table.find("tbody tr").each(function() {
            var row = $(this);
            var amt = parseInt(row.find("input.amt-cents, input.amt-cents-general").val()) / 100;
            if(amt > targetAmt) {
                amt = targetAmt;
            }
            var points = (amt / targetAmt) * 100;
            row.find("div.progressBar").progressbar({ value: points });
        });
        initialized = true;
    }

    function toggle() {
        if(hidden) {
            show();
        } else {
            hide();
        }
    }

    function show() {
        if(!initialized) {
            initialize();
        }
        table.find("td, th").hide();
        table.find("td.progress-bar, th.progress-bar").show();
        toggleButton.text("Hide Progress");
        hidden = false;
    }

    function hide() {
        table.find("td, th").show();
        table.find("td.progress-bar-cell, th.progress-bar-header").hide();
        toggleButton.text("Show Progress");
        hidden = true;
    }

    this.toggle = toggle;
    this.show = show;
    this.hide = hide;
}