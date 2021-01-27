// AJAX function to display results under discord code field //
jQuery(document).ready(function() {
    console.log('Document Ready!');
    jQuery("#reset-password-form").submit(function (event) {
        event.preventDefault();
        var passwordReset = new FormData(this);
        jQuery("#reset-password").prop('readonly', true);
        jQuery("#reset-password-submit").prop('disabled', true);
            jQuery.ajax({
                url: '../stage3/php/get-password-reset-token.php',
                type: 'POST',
                //dataType: 'json',
                data: passwordReset,
                processData: false,
                contentType: false,
                success: function(data){
                    //alert(data);
                    //console.log('Success');
                    jQuery("#reset-alert-green").attr('hidden', false);
                },
                fail: function(data) {
                    //console.log('Error');
                    //alert(data);
                    
                },
                error: function(data) {
                    //console.log('Error');
                    //alert(data);
                    jQuery("#reset-alert-red").attr('hidden', false);
                }
        });
    });
});
  
  