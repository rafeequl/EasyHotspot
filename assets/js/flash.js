jQuery.noConflict();
jQuery(document).ready(function($) {
    $("#flashMessage").show("normal",
        function()
        {
            $("#flashMessage").fadeOut(10000);
        }
        );
}); 