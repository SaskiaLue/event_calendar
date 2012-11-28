$(document).ready(

    function() {
		
		// overlay
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
	
		// validation
		function valid() {
			if ($('input:text').val() == '') {
				$('.error').text("Required field");
				$(this).addClass("input-error");  
				return false;
			} else {
				$('.error').text(""); 
				$(this).removeClass("input-error");  
				return true;
			}
		}
		//On Submitting  
		$('form').submit(function(){  
			if(valid())  
				return true  
			else  
				return false;  
		});
		
    }
);