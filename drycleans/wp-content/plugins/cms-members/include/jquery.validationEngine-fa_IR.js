

(function($) {
	$.fn.validationEngineLanguage = function() {};
	$.validationEngineLanguage = {
		newLang: function() {
			$.validationEngineLanguage.allRules = {"required":{    
						"regex":"none",
						"alertText":"* پر کردن فیلد الزامی است",
						"alertTextCheckboxMultiple":"* انتخاب اجباری است",
						"alertTextCheckboxe":"* تیک زدن اجباری است"},
					"length":{
						"regex":"none",
						"alertText":"* تعداد مجاز کاراکتر بین ",
						"alertText2":" تا  ",
						"alertText3":" "},
					"minCheckbox":{
						"regex":"none",
						"alertText":"* تعداد بیشتری انتخاب کنید"},	
					"confirm":{
						"regex":"none",
						"alertText":"* با هم برابر نیستند"},		
					"telephone":{
						"regex":"/^[0-9\-\(\)\ ]+$/",
						"alertText":"* شماره تلفن اشتباه است"},	
					"email":{
						"regex":"/^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/",
						"alertText":"* ایمیل نامعتبر است"},	
					"date":{
                         "regex":"/^[0-9]{4}\-\[0-9]{1,2}\-\[0-9]{1,2}$/",
                         "alertText":"* تاریخ نامعتبر است شکل مجاز YYYY-MM-DD"},
					"onlyNumber":{
						"regex":"/^[0-9\ ]+$/",
						"alertText":"* فقط اعداد قابل قبولند"},	
					"noSpecialCaracters":{
						"regex":"/^[0-9a-zA-Z]+$/",
						"alertText":"* استفاده از کاراکترهای خاص مثل $! مجاز نیست"},	
					"onlyLetter":{
						"regex":"/^[a-zA-Z\ \']+$/",
						"alertText":"* فقط حروف قابل قبولند"},
					"ajaxUser":{
						"file":"validateUser.php",
						"alertTextOk":"* در دسترس می باشد",	
						"alertTextLoad":"* لطفا چند لحظه...",
						"alertText":"* در دسترس نیست، دوباره تلاش کنید"},	
					"ajaxName":{
						"file":"validateUser.php",
						"alertText":"* در دسترس می باشد",
						"alertTextOk":"* لطفا چند لحظه...",	
						"alertTextLoad":"* در دسترس نیست، دوباره تلاش کنید"}	
				}	
		}
	}
})(jQuery);

$(document).ready(function() {	
	$.validationEngineLanguage.newLang()
});