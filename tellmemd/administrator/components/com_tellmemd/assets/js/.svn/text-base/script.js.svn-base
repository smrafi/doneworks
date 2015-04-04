
//Dev Sara



function change_button_state(state,row,status){
  
  if(status=='3'){
       $('#dp-award-doctor'+row).attr("disabled", true);
       $('#dp-award-patient'+row).attr("disabled", true);
       $('#dp-refund-half'+row).attr("disabled", true);
       $('#dp-refund-patient'+row).attr("disabled", true);
       $('#dp-award-doctor'+row).css("cursor", 'text');
       $('#dp-award-doctor'+row).css('opacity','0.2');
       $('#dp-award-patient'+row).css("cursor", 'text');
       $('#dp-award-patient'+row).css('opacity','0.2');
       $('#dp-refund-half'+row).css("cursor", 'text');
       $('#dp-refund-patient'+row).css("cursor", 'text');
       $('#dp-refund-half'+row).css('opacity','0.2');
       $('#dp-refund-patient'+row).css('opacity','0.2');
   
  }
   else{
      if(status=='1' || status=='2'){
       if(state=="Review"){
       $('#dp-award-doctor'+row).attr("disabled", false);
       $('#dp-award-patient'+row).attr("disabled", false);
       $('#dp-refund-half'+row).attr("disabled", true);
       $('#dp-refund-patient'+row).attr("disabled", true);
       $('#dp-refund-half'+row).css("cursor", 'text');
       $('#dp-refund-patient'+row).css("cursor", 'text');
       $('#dp-refund-half'+row).css('opacity','0.2');
       $('#dp-refund-patient'+row).css('opacity','0.2');
   }
   if(state=="Reject"){
       $('#dp-award-doctor'+row).attr("disabled", false);
       $('#dp-award-patient'+row).attr("disabled", false);
       $('#dp-refund-half'+row).attr("disabled", false);
       $('#dp-refund-patient'+row).attr("disabled", true);
       $('#dp-refund-patient'+row).css("cursor", 'text');
       $('#dp-refund-patient'+row).css('opacity','0.2');
   }
   if(state=="Refund"){
       $('#dp-award-doctor'+row).attr("disabled", true);
       $('#dp-award-patient'+row).attr("disabled", true);
       $('#dp-refund-half'+row).attr("disabled", false);
       $('#dp-refund-patient'+row).attr("disabled", false);
       $('#dp-award-doctor'+row).css("cursor", 'text');
       $('#dp-award-doctor'+row).css('opacity','0.2');
       $('#dp-award-patient'+row).css("cursor", 'text');
       $('#dp-award-patient'+row).css('opacity','0.2');
    }
   }   
 }
   
}

function refundHalf(id){
   
    var x=window.confirm("Are you sure you want to refund?")
    if (x){
        $.post('index.php',{
            'option':'com_tellmemd',
            'controller':'report',
            'task':'refundHalf',
            'format':'row',
            'case_id':id,
            'type':'1'
        },function(result){
            if(result)
                return;
        });
        
        return true;
    }
    else
        return false;
    
}

function refundFull(id){
    var x=window.confirm("Are you sure you want to refund?")
    if (x){
        $.post('index.php',{
            'option':'com_tellmemd',
            'controller':'report',
            'task':'refundFull',
            'format':'row',
            'case_id':id,
            'type':'2'
        },function(result){
            if(result)
                return;
        });
        
        return true;
    }
    else
        return false;
    
}