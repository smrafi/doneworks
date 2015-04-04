
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
        html = '<tr>';
        html += $('#income-table tbody tr:first-child').html();
        html += '</tr>';
        $('#income-table tbody').append(html);
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
    $('#income_type').change(function(){
        type_id = $(this).val(); 
        if(type_id==2)
        $('.list-type-bank').show();
       else 
        $('.list-type-bank').hide();
           
    });
 
   
     ///dev :Asfaran   Related to ledger
    $('#account_type').change(function(){
        type_id = $(this).val(); 
        $('.type-list').hide();
        $('#list-type-'+type_id).show();
        $('.type-list select').attr('disabled', 'disabled');
        $('#list-type-'+type_id+' select').removeAttr('disabled');
    });
   
  ///dev :Asfaran   Related to voucher 
   $('#ledger_check').change(function(){
       if($(this).is(':checked')){
         $('#ledger_typeid').removeAttr('disabled');
         $('#ledgertype_view').show();
         ledger_activity_id=$('#ledger_activity').val();
         
          
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
        
          
       }
       else{
           $('#ledger_typeid').attr('disabled', 'disabled');
           $('#ledgertype_view').hide();
       }
   });
    
   ///dv :Asfaran    getting number of ledger item Type Related to ledger item
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
    
    //Dev Rafi--meril
    
    $('#template_id').change(function(){
        template_id = $(this).val();
        if(template_id != 0){
            $('#task').val('getletter');
            $('.submit-form').submit();
        }
    });
    
    //A validation and instant error display for NIC
    $('#nic_num').keyup(function(){
        $('.instant-error').hide();
        $('.instant-note').hide();
        nic_num = $(this).val();
        numericExpression = /^[0-9]+$/;
        if(!nic_num.match(numericExpression)){
            $('.instant-error').html('* Enter numbers only');
            $('.instant-error').show();
        }
        else if(nic_num.length == 10){
            $.post('index.php',
            {
                'option':'com_presidentfund',
                'controller':'application',
                'task':'getrecords',
                'format':'raw',
                'nic_num':nic_num
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
        if(nic_num.match(numericExpression) && nic_num.length == 10){
            return true;
        }
        else{
            $('.instant-error').html('* Enter a correct NIC number');
            $('.instant-error').show();
            return false;
        }
    });
    
     
});