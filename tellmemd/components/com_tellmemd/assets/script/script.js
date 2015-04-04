
//Dev Rafi

jQuery(document).ready(function($){
    if($('#cat-tab-bar .active').html() != null){
        active_id = $('#cat-tab-bar .active').attr('id');
        active_id = active_id.split('-');
        active_id = active_id[1];

        $.post('index.php',{
            'option':'com_tellmemd',
            'controller':'medical',
            'task':'conditions',
            'format':'row',
            'cat_id':active_id
        },function(result){
            $('.data-tips').html(result);
        });
    }
    
    if($('#surgical-tab-bar .active').html() != null){
        active_id = $('#surgical-tab-bar .active').attr('id');
        active_id = active_id.split('-');
        active_id = active_id[1];

        $.post('index.php',{
            'option':'com_tellmemd',
            'controller':'medical',
            'task':'surgeries',
            'format':'row',
            'cat_id':active_id
        },function(result){
            $('.data-tips').html(result);
        });
    }
    
    $('#cat-tab-bar .cat-tab').click(function(){
        tab_id = $(this).attr('id');
        id_part = tab_id.split('-');
        cat_id = id_part[1];
        
        $.post('index.php',{
            'option':'com_tellmemd',
            'controller':'medical',
            'task':'conditions',
            'format':'row',
            'cat_id':cat_id
        },function(result){
            $('.data-tips').html(result);
        });
        
        $('.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('#surgical-tab-bar .cat-tab').click(function(){
        tab_id = $(this).attr('id');
        id_part = tab_id.split('-');
        cat_id = id_part[1];
        
        $.post('index.php',{
            'option':'com_tellmemd',
            'controller':'medical',
            'task':'surgeries',
            'format':'row',
            'cat_id':cat_id
        },function(result){
            $('.data-tips').html(result);
        });
        
        $('.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('.radio-inner-wrapper').css('display','none');
    if($('#smoke-quit input:radio').is(':checked')){
        $('#smoke-quit .radio-inner-wrapper').css('display','block');
        $('#smoke-yes .radio-inner-wrapper').css('display','none');
    }
    if($('#smoke-yes input:radio').is(':checked')){
        $('#smoke-yes .radio-inner-wrapper').css('display','block');
        $('#smoke-quit .radio-inner-wrapper').css('display','none');
    }
    if($('.drug-yes input:radio').is(':checked')){
        $('.drug-yes .radio-inner-wrapper').css('display','block');
    }
    if($('.smoke-single input:radio').is(':checked')){
        $('#smoke-yes .radio-inner-wrapper').css('display','none');
        $('#smoke-quit .radio-inner-wrapper').css('display','none');
    }
    if($('.drug-single input:radio').is(':checked')){
        $('.drug-yes .radio-inner-wrapper').css('display','none');
    }
    $('#smoke-quit input:radio').change(function(){
        $('#smoke-yes .radio-inner-wrapper').css('display','none');
        $('#smoke-quit .radio-inner-wrapper').css('display','block');
    });
    $('#smoke-yes input:radio').change(function(){
        $('#smoke-quit .radio-inner-wrapper').css('display','none');
        $('#smoke-yes .radio-inner-wrapper').css('display','block');
    });
    $('.smoke-single input:radio').change(function(){
        $('#smoke-yes .radio-inner-wrapper').css('display','none');
        $('#smoke-quit .radio-inner-wrapper').css('display','none');
    });
    $('.drug-yes input:radio').change(function(){
        $('.drug-yes .radio-inner-wrapper').css('display','block');
    });
    $('.drug-single input:radio').change(function(){
        $('.drug-yes .radio-inner-wrapper').css('display','none');
    });
    
    $('#preinput-box input:text').change(function(){
        if($('#medication_name').val() != '' && $('#dose').val() && $('#frequency').val()){
            $('button#medi_button').removeAttr('disabled');
            $('button#medi_button').addClass('activate-button');
        }
        else{
            $('button#medi_button').attr("disabled","disabled");
            $('button#medi_button').removeClass('activate-button');
        }
    });
    
    $('#medi_button').click(function(){
        $('#task').val('addMedication');
        $('#medicationform').submit();
    });
    
    $('#allergy-input input').change(function(){
        if($(this).val() != ''){
            $('button#allergy_button').removeAttr('disabled');
            $('button#allergy_button').addClass('activate-button');
        }
        else{
            $('button#allergy_button').attr("disabled","disabled");
            $('button#allergy_button').removeClass('activate-button');
        }
    });
    
    $('#allergy_button').click(function(){
        $('#task').val('addalergy');
        $('#medicationform').submit();
    });
    
    //script for new case
    $("#tab1 ul.submenu li").click(function(){
        catname = $(this).find("a").attr("catname");
        catindex = $(this).find("a").attr("href");
        catindex = catindex.split('-');
        cat_id = catindex[1];
        $('#cat_id').val(cat_id);
        $('.category').html(catname);
        return false;
    });
    
    $("#tab2 ul.submenu li").click(function(){
        labname = $(this).find("a").attr("labname");
        labindex = $(this).find("a").attr("href");
        labindex = labindex.split('-');
        lab_id = labindex[1];
        $('#lab_id').val(lab_id);
        $('.test-name').html(labname);
        
        $.post('index.php',{
            'option':'com_tellmemd',
            'controller':'patient',
            'task':'templatelink',
            'format':'row',
            'lab_id':lab_id
        },function(result){
            $('#template-download').html(result);
        });
        
        return false;
    });
    
    $("ul.tabs li#second").click(function(){
        $('.right_div').hide();
        $('#right_div_labtest').show();
    });
    
    $("ul.tabs li#first").click(function(){
        $('.right_div').hide();
        $('#right_div_cats').show();
    });
    
    //on start load we add the category id for the first tab
    catname = $("#tab1 ul.submenu li#first_div").find("a").attr("catname");
    catindex = $("#tab1 ul.submenu li#first_div").find("a").attr("href");
    if(catindex){
        catindex = catindex.split('-');
        cat_id = catindex[1];
        $('#cat_id').val(cat_id);
        $('.category').html(catname);
    }
    
    //on start generate template link
    lab_id = $('#lab_id').val();
    $.post('index.php',{
        'option':'com_tellmemd',
        'controller':'patient',
        'task':'templatelink',
        'format':'row',
        'lab_id':lab_id
    },function(result){
        $('#template-download').html(result);
    });
    
    //script for case settings
    $('#left-case-box input').change(function(){
        if($("input[name='answer_medium']:checked").val() && $("input[name='urgency_level']:checked").val() && $("input[name='detail_level']:checked").val()){
            answer_medium = $("input[name='answer_medium']:checked").val();
            urgency_level = $("input[name='urgency_level']:checked").val();
            detail_level = $("input[name='detail_level']:checked").val();
            case_num = $('#case_num').val();
            case_type = $('#case_type').val();
            
            $.post('index.php',{
                'option':'com_tellmemd',
                'controller':'cases',
                'task':'casecalc',
                'format':'row',
                'answer_medium':answer_medium,
                'urgency_level':urgency_level,
                'case_num':case_num,
                'case_type':case_type,
                'detail_level':detail_level
            },function(result){
                price = parseInt(result);
                maxprice = Math.round(price + ((price * 20)/100));
                minprice = Math.round(price - ((price * 20)/100));
                
                $('#suggest-price .count').html('$' + price);
                $('#max-price .count').html('$' + maxprice);
                $('#min-price .count').html('$' + minprice);
                $('#suggest_price').val(price);
                $('#max_price').val(maxprice);
                $('#min_price').val(minprice);
            });
        }
    });
    
    //validate for price input
    $('#price_amount').change(function(){
        price = $('#suggest_price').val();
        maxprice = $('#max_price').val();
        minprice = $('#min_price').val();
        price_value = parseInt($(this).val());
        
        if(price == '' || maxprice == '' || minprice == ''){
            alert('Check the check boxes to determine a price before you continue.');
            $(this).val('');
            return false;
        }
        if(isNaN(price_value)){
            alert('Enter a valid value!');
            $(this).val('');
            return false;
        }
        
        if(price_value < minprice){
            alert('You have to enter at least $' + minprice);
            return false;
        }
        return true;
    });
    
    //validate on form submit
    $('button#case-proceed').click(function(){
        if(!$("input[name='answer_medium']:checked").val() || !$("input[name='urgency_level']:checked").val() || !$("input[name='detail_level']:checked").val()){
            alert('Check all the check boxes to continue.');
            return false;
        }
        if($('#price_amount').val() == ''){
            alert('Enter your price to continue.');
            return false;
        }
        if($('#price_amount').val() < $('#min_price').val()){
            alert('You have to enter at least $' + minprice);
            return false;
        }
        return true;
    });
    
    //doctor side form submit setting
    $('#answered_btn').click(function(){
        $('#task').val('setanswer');
        $('#docviewcaseform').submit();
        return;
    });
});

