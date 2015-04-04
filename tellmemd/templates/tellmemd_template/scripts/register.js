
//jQuery.noConflict();
jQuery(document).ready(function($){
    
    var fname;
    var lname;
    
    $('#jform_profile_first_name').change(function(){
        fname = $(this).val();
    });
    $('#jform_profile_last_name').change(function(){
        lname = $(this).val();
    });
    $('#account-register').click(function(){
        name = fname+' '+lname;
        email = $('#jform_email1').val();
        $('#jform_name').val(name);
        $('#jform_email2').val(email);
    });
});
