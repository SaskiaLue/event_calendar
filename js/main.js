// overlay
$(document).ready(
    function() {
        $('#add_user').click(
            function() {
                $('#overlay').show();
            }
        );
 
         $('#close').click(
            function() {
                $('#overlay').hide();
            }
        );  
    }
);