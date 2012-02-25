$(document).ready(function() {
    $("#nav_rider").addClass("selected");

    var userManager = new UserManagement();
});

function UserManagement() {
    var fieldset = $("#user_mgmt");

    var userSelect = $("#RiderRUserId");

    function initialize() {
        $("label[for='RiderRUserId']").addClass('existing_user');

        fieldset.find('.existing_user').hide();
        fieldset.find('.new_user').show();

        var options = userSelect.find('option').first().text("Create a new user")

        userSelect.change(function() { toggleRiderUserMethod(); });
    }

    function toggleRiderUserMethod() {
        if(userSelect.val() >= 0) {
            if(userSelect.val() != 0) {
                fieldset.find('.existing_user').show();
            }
            fieldset.find('.new_user').hide();
        } else {
            fieldset.find('.existing_user').hide();
            fieldset.find('.new_user').show();
        }
    }

    function suggestUserName() {
        var first = $("#RiderRFirstName").val();
        var last = $("#RiderRLastName").val();
    }

    initialize();
}