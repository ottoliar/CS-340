$(document).ready(function() {
    $('#f_brew_delete').hide();
    $('#f_beer_delete').hide();
    $('#form_toggle').change(function(e) {
        if ($('#form_toggle').val() == "Delete brewery") {
            $('#f_brew_delete').show();
        } else {
            $('#f_brew_delete').hide();
        }

        if ($('#form_toggle').val() == "Delete beer") {
            $('#f_beer_delete').show();
        } else {
            $('#f_beer_delete').hide();
        }
    });
    $('#f_brew_delete').submit(function() {
        if ($('#brew_select').val() === "Select brewery...") {
            alert("You did not select a brewery!");
            return false;
        }
    });
    $('#f_beer_delete').submit(function() {
        if ($('#beer_select').val() === "Select beer...") {
            alert("You did not select a beer!");
            return false;
        }
    });
});