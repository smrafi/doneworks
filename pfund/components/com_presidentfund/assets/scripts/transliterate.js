
google.load("language", "1");

//Dev Rafi
//A function to transliterate english to Tamil
function englishtotamil(words, txtclass, inputid){
    wordarray = words.split(' ');
    google.language.transliterate(wordarray, 'en', 'ta', function(result){
        finaltxt = '';
        for(x = 0; x<result.transliterations.length; x++){
            finaltxt += result.transliterations[x].transliteratedWords[x]+' ';
        }
        editlink = '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="langedit">+ Edit</a>';
        jQuery('.'+txtclass+' td.tamiltxt span').html(finaltxt);
        if(inputid != '')
            jQuery('#'+inputid+'_ta').val(finaltxt);
    });
}

//function to transliterate English to Sinhala
function englishtosinhala(words, txtclass, inputid){
    wordarray = words.split(' ');
    google.language.transliterate(wordarray, 'en', 'si', function(result){
        finaltxt = '';
        for(x = 0; x<result.transliterations.length; x++){
            finaltxt += result.transliterations[x].transliteratedWords[x]+' ';
        }
        editlink = '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="langedit">+ Edit</a>';
        jQuery('.'+txtclass+' td.sinhalatxt span').html(finaltxt);
        if(inputid != '')
            jQuery('#'+inputid+'_si').val(finaltxt);
    });
}

