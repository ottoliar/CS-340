$(document).ready(function() {
    $('#f_brew_add').hide();
    $('#f_beer_add').hide();
    $('#form_toggle').change(function(e) {
        if ($('#form_toggle').val() == "Add brewery") {
            $('#f_brew_add').show();
        } else {
            $('#f_brew_add').hide();
        }

        if ($('#form_toggle').val() == "Add beer") {
            $('#f_beer_add').show();
        } else {
            $('#f_beer_add').hide();
        }
    });
    $('#f_brew_add').submit(function() {
        if ($.trim($('#brew_name').val()) === "" || $.trim($('#brew_city').val()) === ""
        || $.trim($('#brew_state').val()) === "" || $('#brew_amenities').val() === null) {
            alert("You did not fill out all fields");
            return false;
        }
    });
    $('#f_beer_add').submit(function() {
        if ($.trim($('#beer_name').val()) === "" || $.trim($('#beer_style').val()) === ""
        || $('#beer_type').val() === "Select Type..." || $('#beer_found_at').val() === null) {
            alert("You did not fill out all fields");
            return false;
        }
    });
});