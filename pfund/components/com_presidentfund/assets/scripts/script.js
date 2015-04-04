
jQuery(document).ready(function($){
    
    //on start we check this when application form is coming
    if($('#pensioner').is(':checked')){
        $('#served-lasttd').css('display', '');
        $('#served-lasttxt').css('display', '');
    }else{
        $('#served-lasttd').css('display', 'none');
        $('#served-lasttxt').css('display', 'none');
        $('#last_place').val('');
    }
    
    //on start we check weather other relation text box should be shown or not
    if($('#applicant_relation').val() == -1){
        $('#etc_relation').css('display', '');
    }
    else{
        $('#etc_relation').hide();
        $('#etc_relation').val('');
    }
    
    if($('#patient_title').val() == 0){
        $('#othertitle_patient').show();
    }
    else{
        $('#othertitle_patient').hide();
        $('#othertitle_patient').val('');
    }
    
    if($('#applicant_title').val() == 0){
        $('#othertitle_applicant').show();
    }
    else{
        $('#othertitle_applicant').hide();
        $('#othertitle_applicant').val('');
    }
    
    if($('#patient_martial').val() == 0){
        $('#martial_other').show();
    }
    else{
        $('#martial_other').hide();
        $('#martial_other').val('');
    }
    
    $('#newledger').click(function(){
        html = '<tr><td>Ledger Item Name</td><td><input type="text" name="ledger[]" value="" size="50"/></td></tr>';
        $('#ledgertable tbody').append(html);
    });
    
    $('#newbanks').click(function(){
        html = '<tr><td>Bank Name</td><td><input type="text" name="bank_name[]" value="" size="50"/></td></tr>';
        $('#banktable tbody').append(html);
    });
    
    
    $('#bank_id').change(function(){
        bank_id = $(this).val();
        if(bank_id != 0){
            $.post('index.php',
            {
                'option':'com_presidentfund',
                'controller':'openbalancefd',
                'task':'getaccountnum',
                'format':'raw',
                'bank_id':bank_id
            }, function(result){
                $('#account_list').html(result);
            }
        );
        }
        
    });
    
    
    
    $('#pensioner').click(function(){
        if($(this).is(':checked')){
            html = '<input name="last_place" id="last_place" value="" size="50" />';
            $('#served-lasttd').css('display', '');
            $('#served-lasttxt').css('display', '');
        }
        else{
            $('#served-lasttd').css('display', 'none');
            $('#served-lasttxt').css('display', 'none');
            $('#last_place').val('');
        }
    });
    
    $('#applicant_relation').change(function(){
        html = '<input name="etc_relation" id="etc_relation" value="" size="50" />';
        if($(this).val() == -1){
            $('#etc_relation').css('display', '');
        }
        else{
            $('#etc_relation').hide();
            $('#etc_relation').val('');
        }
    });
    
    $('#patient_title').change(function(){
        html = '<input name="othertitle_patient" id="othertitle_patient" value="" size="50" />';
        if($(this).val() == 0){
            $('#othertitle_patient').show();
        }
        else{
            $('#othertitle_patient').hide();
            $('#othertitle_patient').val('');
        }
    });
    
    $('#applicant_title').change(function(){
        html = '<input name="othertitle_applicant" id="othertitle_applicant" value="" size="50" />';
        if($(this).val() == 0){
            $('#othertitle_applicant').show();
        }
        else{
            $('#othertitle_applicant').hide();
            $('#othertitle_applicant').val('');
        }
    });
    
    $('#patient_martial').change(function(){
        html = '<input name="martial_other" id="martial_other" value="" size="50" />';
        if($(this).val() == 0){
            $('#martial_other').show();
        }
        else{
            $('#martial_other').hide();
            $('#martial_other').val('');
        }
    });
    
    $('.income-append a').click(function(){
        html = '<table class="income-data-table">';
        html += $('#income-table table:first-child').html();
        html += '</table>';
        
        $('#income-table').append(html);
    });
    
    $('.source-append a').click(function(){
        html = '<tr>';
        html += $('.other-source-raw').html();
        html += '</tr>';
        $('.finance-table tbody').append(html);
    });
    
    $('#patient_district').change(function(){
        district_id = $(this).val();
        if(district_id != 0){
            $.post('index.php',
            {
                'option':'com_presidentfund',
                'controller':'application',
                'task':'getdsoffice',
                'format':'raw',
                'district_id':district_id
            }, function(result){
                $('#patient_dsoffice').html(result);
            }
        );
        }
        
    });
    
    $('#hospital_id').change(function(){
        hospital_id = $(this).val();
        if(hospital_id != 0){
            $.post('index.php',
            {
                'option':'com_presidentfund',
                'controller':'application',
                'task':'gethospitaladdress',
                'format':'raw',
                'hospital_id':hospital_id
            }, function(result){
                $('#hospital_address').val(result);
            }
        );
        }
    });
    
    ///dv :Asfaran   Related to Income
   $('#in_type').change(function(){type_id = $(this).val(); 
     if(type_id ==2){
         $('.income_bank').css('display','table-row');
          }
     if(type_id !=2){
         $('.income_bank').css('display','none');
          }
    
    });
   
   if($('#in_type').val() == 2){
       $('.income_bank').show();
   }
   else{
       $('.income_bank').css('display','none');
   }
  
  
   
    $('#in_activity').change(function(){activity_id = $(this).val(); 
     if(activity_id ==3){
         $('.income_lottery').css('display','table-row');
          }
     if(activity_id !=3){
         $('.income_lottery').css('display','none');
          }
     if(activity_id ==4 || activity_id ==5){
         $('#income_special').css('display','table-row');
        
          }
     if(activity_id !=4 && activity_id !=5){
         $('#income_special').css('display','none');
        
          }
    });
  
   if($('#in_activity').val() == 3){
       $('.income_lottery').show();
   }
   else{
       $('.income_lottery').css('display','none');
   }
   if($('#in_activity').val() == 4 || $('#in_activity').val() == 5){
        $('#income_special').show();
   }
   if($('#in_activity').val() != 4 && $('#in_activity').val() != 5){
       $('#income_special').css('display','none');
   }
   
   //dev meril
   //appmain ref_no for kandy hospital only
        if($('#ap_type').val() == 4){
            $('#ref_tr').show();   
        }
        else
            {
                $('#ref_tr').hide();
                $('#patient_ref_num').val('');
            }
 
   
      ///dev :Asfaran   Related to ledger
    $('#account_type').change(function(){
        type_id = $(this).val(); 
        $('.type-list').hide();
        $('#list-type-'+type_id).show();
        $('.type-list select').attr('disabled', 'disabled');
        $('#list-type-'+type_id+' select').removeAttr('disabled');
    });
    
 
  
   $('#ledger_activity').change(function(){
        ledger_activity_id = $(this).val();
        if(ledger_activity_id != 0){
            $.post('index.php',
            {
                'option':'com_presidentfund',
                'controller':'ledgeritem',
                'task':'getledgeritemtype',
                'format':'raw',
                'ledger_activity':ledger_activity_id
            }, function(result){
                $('#ledger_typeid').html(result);
            }
        );
        }
        
    });
    
    
    
    //select the diseases according to category
    $('.catid-select').change(function(){
        cat_id = $(this).val();
        $.post('index.php',
        {
            'option':'com_presidentfund',
            'controller':'manageapp',
            'task':'getdisease',
            'format':'raw',
            'cat_id':cat_id
        }, function(result){
            $('#disease_list').html(result);
        }
    );
    });
    
    //change the values according to selected to amount type
    $('#amount_type').change(function(){
        amount_type = $(this).val();
        disease_id = $('#disease_id').val();
        if(amount_type != 0 && amount_type != 'other' && disease_id != 0){
            $.post('index.php',
            {
                'option':'com_presidentfund',
                'controller':'manageapp',
                'task':'getamount',
                'format':'raw',
                'amount_type':amount_type,
                'disease_id':disease_id
            }, function(result){
                $('#grant_amount').val(result);
            }
        );
        }
        else{
            $('#grant_amount').val('');
        }
    });
    
    //Dev Rafi
    //Instant validation to avoid the amount not enter more than we require
    $('#grant_amount').change(function(){
        amount = $(this).val();
        disease_id = $('#disease_id').val();
        amount_type = $('#amount_type').val();
        $('.instant-note').remove();
        if(amount_type != 0 && amount_type != 'other' && disease_id != 0){
            $.post('index.php',
            {
                'option':'com_presidentfund',
                'controller':'manageapp',
                'task':'getamount',
                'format':'raw',
                'amount_type':amount_type,
                'disease_id':disease_id
            }, function(result){
                if(amount > result){
                    html = '<span class="instant-note">* Please enter an amount lesser than '+result+'.</span>';
                    $('#grant_amount').parent('td').append(html);
                    $('#grant_amount').val(result);
                    $('.instant-note').css({'margin-top':'5px', 'display':'block', 'color':'red'});
                    return;
                }
            }
        );
        }
    });
    
    //change the template instantly
    $('.lettertemplate').change(function(){
        template_id = $(this).val();
        if(template_id != 0){
            $('#task').val('getletter');
            $('.submit-form').submit();
        }
    });
    
    //Dev Rafi
    //A validation and instant error display for NIC
    $('#nic_num').keyup(function(){
        $('.instant-error').hide();
        $('.instant-note').hide();
        nic_num = $(this).val();
        app_type = $(this).val();
        numericExpression = /^[0-9]+$/;
        if(!nic_num.match(numericExpression)){
            $('.instant-error').html('* Enter numbers only');
            $('.instant-error').show();
        }
        else if(nic_num.length == 12){
            $.post('index.php',
            {
                'option':'com_presidentfund',
                'controller':'application',
                'task':'getrecords',
                'format':'raw',
                'nic_num':nic_num,
                'app_type':app_type
            }, function(result){
                msg = result+' record';
                if(result == 0 || result > 1)
                    msg += 's';
                msg += ' found!';
                $('.instant-note').html(msg);
                $('.instant-note').show();
            }
        );
        }
    });
    $('#nic_submit').click(function(){
        nic_num = $('#nic_num').val();
        numericExpression = /^[0-9]+$/;
        if(nic_num.match(numericExpression) && nic_num.length == 12){
            return true;
        }
        else{
            $('.instant-error').html('* Enter a correct NIC number');
            $('.instant-error').show();
            return false;
        }
    });
    
    //Dev Rafi
    $('.mknormal_btn').click(function(){
        vars = $(this).val();
        $.post('index.php',
        {
            'option':'com_presidentfund',
            'controller':'special',
            'task':'changeapptype',
            'format':'raw',
            'type_vars':vars
        }, function(result){
            if(result != '0'){
                $('#mknormal'+result).attr('disabled', 'disabled');
                $('#mknormal'+result).addClass('disabled');
                $('#mkreimburs'+result).removeClass('disabled');
                $('#mkreimburs'+result).removeAttr('disabled', '');
                return;
            }
        }
    );
    });
    
    $('.mkreimburs_btn').click(function(){
        vars = $(this).val();
        $.post('index.php',
        {
            'option':'com_presidentfund',
            'controller':'special',
            'task':'changeapptype',
            'format':'raw',
            'type_vars':vars
        }, function(result){
            if(result != '0'){
                $('#mkreimburs'+result).attr('disabled', 'disabled');
                $('#mkreimburs'+result).addClass('disabled');
                $('#mknormal'+result).removeClass('disabled');
                $('#mknormal'+result).removeAttr('disabled', '');
                return;
            }
        }
    );
    });
    
    //Dev Rafi
    $('.commontemplate').change(function(){
        template_id = $(this).val();
        $('#template_id', window.parent.document).val(template_id);
    });
    
     //following are going to be used specifically on front end only
    //Dev Rafi
    $('.save_btn').click(function(){
        $('#task').val('save');
        $('.submit-form').submit();
    });
    
    $('.apply_btn').click(function(){
        $('#task').val('apply');
        $('.submit-form').submit();
    });
    
    $('.cancel_btn').click(function(){
        $('#task').val('cancel');
        $('.submit-form').submit();
    });
    
    $('.new_btn').click(function(){
        $('#task').val('addnew');
        $('.submit-form').submit();
    });
    
    $('.delete_btn').click(function(){
        $('#task').val('remove');
        $('.submit-form').submit();
    });
    
    $('.back_btn').click(function(){
        $('#task').val('backop');
        $('.submit-form').submit();
    });
    
    $('.release_btn').click(function(){
        $('#task').val('release');
        $('.submit-form').submit();
    });
    
    $('.appnew_btn').click(function(){
        $('#task').val('newexistapp');
        $('.submit-form').submit();
    });
    
    $('.print_btn').click(function(){
        window.print();
        return;
    });
    
    //Dev Rafi
    $('.dummy_btn').click(function(){
        $('.submit-form').submit();
        return;
    });
    
    $('#done_btn').click(function(){
        $('#sbox-overlay', window.parent.document).fadeOut();
        $('#sbox-window', window.parent.document).fadeOut();
    });
    
    $('.template_btn').click(function(){
        $('#sbox-window').fadeIn(1000);
    });
    
    $('.bulkprint_btn').click(function(){
        $('#system-message-container').html('');
        selectbox = $('input[name="cid[]"]').serializeArray();
        letterfile_num = $('#letterfile_num').val();
        
        if($('#template_id').val() == 0){
            error_html = '<dl id="system-message"><dt class="error">Error</dt><dd class="error message"><ul><li>Select a template before print.</li></ul></dd></dl>';
            $('#system-message-container').append(error_html);
            return false;
        }
        if(letterfile_num == '' || letterfile_num == 0){
            error_html = '<dl id="system-message"><dt class="error">Error</dt><dd class="error message"><ul><li>Enter a file number before print.</li></ul></dd></dl>';
            $('#system-message-container').append(error_html);
            return false;
        }
        if(selectbox.length == 0){
            error_html = '<dl id="system-message"><dt class="error">Error</dt><dd class="error message"><ul><li>No Application has been selected.</li></ul></dd></dl>';
            $('#system-message-container').append(error_html);
            return false;
        }
        $('#task').val('printletter');
        $('.submit-form').submit();
    });
    
    //Dev Rafi
    $('.upload_btn').click(function(){
        $('#system-message-container').html('');
        selectbox = $('input[name="cid[]"]').serializeArray();
        prfile_reply = $('#prfile_reply').val();
        
        if(prfile_reply == ''){
            error_html = '<dl id="system-message"><dt class="error">Error</dt><dd class="error message"><ul><li>Select a file before continue.</li></ul></dd></dl>';
            $('#system-message-container').append(error_html);
            return false;
        }
        if(selectbox.length == 0){
            error_html = '<dl id="system-message"><dt class="error">Error</dt><dd class="error message"><ul><li>No Application has been selected.</li></ul></dd></dl>';
            $('#system-message-container').append(error_html);
            return false;
        }
        $('#task').val('uploadprfile');
        $('.submit-form').submit();
    });
    
    //Dev Rafi
    $('.generate_btn').click(function(){
        $('#task').val('savehealthmin');
        $('.submit-form').submit();
    });
    
    //Dev Rafi
    $('.recommend_btn').click(function(){
        $('#task').val('recommend');
        $('.submit-form').submit();
    });
    
    $('.amend_btn').click(function(){
        $('#task').val('amend');
        $('.submit-form').submit();
    });
    
    $('.reject_btn').click(function(){
        $('#task').val('reject');
        $('.submit-form').submit();
    });
    
    $('.appview_btn').click(function(){
        $('#task').val('appview');
        $('.submit-form').submit();
    });
    
    //Dev Rafi
    //Translate options
    //for patient name
    $('#patient_fullname').keyup(function(){
        $('.otherlang-name').show();
        entrtxt = $(this).val();
        englishtosinhala(entrtxt, 'otherlang-name', 'patient_fullname');
        englishtotamil(entrtxt, 'otherlang-name', 'patient_fullname');
    });
    
    //for address 1
    $('#patient_add1').keyup(function(){
        $('.otherlang-add1').show();
        entrtxt = $(this).val();
        englishtosinhala(entrtxt, 'otherlang-add1', 'patient_add1', 'patient_add1');
        englishtotamil(entrtxt, 'otherlang-add1', 'patient_add1', 'patient_add1');
    });
    
    //for address 2
    $('#patient_add2').keyup(function(){
        $('.otherlang-add2').show();
        entrtxt = $(this).val();
        englishtosinhala(entrtxt, 'otherlang-add2', 'patient_add2');
        englishtotamil(entrtxt, 'otherlang-add2', 'patient_add2');
    });
    
    //for applicant name
    $('#applicant_fullname').keyup(function(){
        $('.otherlang-applicantname').show();
        entrtxt = $(this).val();
        englishtosinhala(entrtxt, 'otherlang-applicantname', 'applicant_fullname');
        englishtotamil(entrtxt, 'otherlang-applicantname', 'applicant_fullname');
    });
    
    //for applicant address 1
    $('#applicant_add1').keyup(function(){
        $('.otherlang-applicantadd1').show();
        entrtxt = $(this).val();
        englishtosinhala(entrtxt, 'otherlang-applicantadd1', 'applicant_add1');
        englishtotamil(entrtxt, 'otherlang-applicantadd1', 'applicant_add1');
    });
    
    //for applicant address 2
    $('#applicant_add2').keyup(function(){
        $('.otherlang-applicantadd2').show();
        entrtxt = $(this).val();
        englishtosinhala(entrtxt, 'otherlang-applicantadd2', 'applicant_add2');
        englishtotamil(entrtxt, 'otherlang-applicantadd2', 'applicant_add2');
    });
    
    //give the edit functionality
    $('.langedit').click(function(){
        editval = $(this).parent('td').children('span').html();
        inputhtml = '<input type="text" name="wordcorrect" class="langinput" value="'+editval+'" />';
        $(this).parent('td').children('span').html(inputhtml);
        $(this).parent('td').children('a.langedit').hide();
    });
    
    //if the edit is done
    $('.langinput').live('focusout', function(){
        txtval = $(this).val();
        $(this).parent('span').parent('td').children('a.langedit').show();
        $(this).parent('span').html(txtval);
    });
    
    //dev meril for subledger book
    $('.subldgr_btn').click(function(){
        $('#task').val('sub_ledger');
        $('.submit-form').submit();
    });
    
     //dev :asfaran  related to cheque deposit  this same function like get bank accountid >>but we use this to FD related page

      $('#cheque_bank_id').change(function(){
        cheque_bank_id = $(this).val();
        if(cheque_bank_id != 0){
            $.post('index.php',
            {
                'option':'com_presidentfund',
                'controller':'openbalancefd',
                'task':'getaccountnum',
                'format':'raw',
                'bank_id':cheque_bank_id
            }, function(result){
                $('#cheque_bankaccount_id').html(result);
            }
        );
        }
        
    });
    
    //dev meril for list applications by app type
    
//    $('#list_by').change(function(){
//      list_by = $(this).val();
////      alert(list_by);
//        if(list_by){
//            $.post('index.php',
//        {
//           'option':'com_presidentfund',
//                'controller':'application',
//                'task':'applist',
//                'format':'raw',
//                'list_by':list_by
//        }
//    );
//        }
//    });
    
    //dev :asfaran these 4 functions related to  voucher >>select a option to release voucher 
     $('#print_type_cheque').change(function(){
        if($(this).is(':checked')){
             $('.print_type_cheque').show();
        }
        else{
            $('.print_type_cheque').hide();
        }
        
       
    });
    
    $('#print_type_slip').change(function(){
        if($(this).is(':checked')){
            $('.print_type_cheque').hide();
        }
       
    });
    
    
    
     if($('#print_type_slip').is(':checked')){
     $('.print_type_cheque').hide();
   }
   
   
    if($('#print_type_cheque').is(':checked')){
     $('.print_type_cheque').show();
   }
    
    
    
    
   ///dv :Asfaran   battons''
    $('.printvoucher_btn').click(function(){
        $('#task').val('printvoucher');
        $('.submit-form').submit();
    });
   
   $('.acc_ob_btn').click(function(){
        $('#task').val('acc_ob');
        $('.submit-form').submit();
    });
    
    $('.savereciept_btn').click(function(){
        $('#task').val('savereciept');
        $('.submit-form').submit();
    });
    
    $('.medical_voucher_btn').click(function(){
        $('#task').val('medical_voucher');
        $('.submit-form').submit();
    });
    
     $('.medical_released_btn').click(function(){
        $('#task').val('medical_released');
        $('.submit-form').submit();
    });
    
    $('.deposit_btn').click(function(){
        $('#task').val('deposit');
        $('.submit-form').submit();
    });
    
    $('.save_deposit_btn').click(function(){
        $('#task').val('save_deposit');
        $('.submit-form').submit();
    });
    
  
    
    
    //Dev Clinton
    $('.bulkchk input').click(function(){
       checkedid = $(this).attr('id');
       if($(this).is(':checked')){
           $('.magic-num').show();
           $('.'+checkedid+'_cols').show();
       }
       else{
           $('.'+checkedid+'_cols').hide();
       }
   });
   
          ///dv :Asfaran   Related to Income
    $('#income_type').change(function(){
        type_id = $(this).val(); 
        if(type_id==2)
        $('.list-type-bank').show();
       else 
        $('.list-type-bank').hide();
           
    });
   
   $('#contact_id option:first').addClass('jecEditableOption');
   
    $('.journal-append a').click(function(){
        html = '<tr >';
        html += $('#journal-table tr:first-child').html();
        html += '</tr>';
        
        $('#journal-table').append(html);
    });
    
     //dev :asfaran this use to get bank account detail

     $('#bankaccount_id').live("change",function(){
        bankaccount_id = $(this).val();
        if(bankaccount_id != 0){
            $.post('index.php',
            {
                'option':'com_presidentfund',
                'controller':'bankaccount',
                'task':'getaccountdetail',
                'format':'raw',
                'bankaccount_id':bankaccount_id
            }, function(result){
                $('#bankaccount_detail_dev').html(result);
            }
        );
        }
        
        
    });
    
 
    
    
$(".journal_d_data").live('change',function () {
  var str = 0;
 
  $(".journal_d_data").each(function () {
     str +=  Number($(this).val());
  });
  $("#debit_sum").html(str);
});


$(".journal_c_data").live('change',function () {
  var str = 0;
 
  $(".journal_c_data").each(function () {
     str +=  Number($(this).val());
  });
  $("#credit_sum").html(str);
});


    
    

});



//Dev Rafi
//A very special function to route a view to back
function routeback(controller, task){
    if(controller != '')
        jQuery('#controller').val(controller);
    if(task != '')
        jQuery('#task').val(task);
    jQuery('.submit-form').submit();
    return;
}

//Dev asfaran
//A very special function to jquey Auto complete>>>this is comment function 

     function lookup(inputString, con, task) {
    
		if(inputString.length == 0) {
			// Hide the suggestion box.
			jQuery('#suggestions').hide();
		} else {
			jQuery.post('index.php',
                        {
                            'option':'com_presidentfund',
                            'controller':con,
                            'task':task,
                            'format':'raw',
                            'result_id':inputString
                        }, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
      function fill(thisValue) {
		jQuery('#spcombo').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
        
        
 