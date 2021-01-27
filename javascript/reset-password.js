// AJAX function to display results under discord code field //
jQuery(document).ready(function() {
    console.log('Document Ready!');
    jQuery("#password-reset-form").submit(function (event) {
        event.preventDefault();
        var passwordReset = new FormData(this);
        jQuery("#reset-password-email").prop('readonly', true);
        jQuery("#reset-password-submit").prop('disabled', true);
            jQuery.ajax({
                url: '../stage3/php/password-reset.php',
                type: 'POST',
                //dataType: 'json',
                data: passwordReset,
                processData: false,
                contentType: false,
                success: function(data){
                    //alert(data);
                    //console.log('Success');
                    jQuery("#reset-alert").attr('hidden', false);
                },
                fail: function(data) {
                    //console.log('Error');
                    //alert(data);
                    
                },
                error: function(data) {
                    //console.log('Error');
                    //alert(data);
                    jQuery("#reset-alert").attr('hidden', false);
                }
        });
    });
});
  
  