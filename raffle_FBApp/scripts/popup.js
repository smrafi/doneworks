// JavaScript Document
//SETTING UP OUR POPUP
//0 means disabled; 1 means enabled;
var popupStatus = 0;

//loading popup with jQuery magic!
function loadPopup() {
    //loads popup only if it is disabled
    if (popupStatus == 0) {
        $("#backgroundPopup").css({"opacity": "0.7"});
        $("#backgroundPopup").fadeIn("slow");
        $("#popupContact").fadeIn("slow");
        popupStatus = 1;
    }
}
//disabling popup with jQuery magic!
function disablePopup() {
    //disables popup only if it is enabled
    if (popupStatus == 1) {
        $("#backgroundPopup").fadeOut("slow");
        $("#popupContact").fadeOut("slow");
        popupStatus = 0;
    }
}
//centering popup
function centerPopup() {
    //request data for centering
    var windowWidth = document.documentElement.clientWidth;
    var windowHeight = document.documentElement.clientHeight;
    var popupHeight = $("#popupContact").height();
    var popupWidth = $("#popupContact").width();
    //centering
    $("#popupContact").css({
        "position": "absolute",
        "top": windowHeight / 2 - popupHeight / 2,
        "left": windowWidth / 2 - popupWidth / 2
    });
    //only need force for IE6

    $("#backgroundPopup").css({
        "height": windowHeight
    });

}

function openit() {

    var aid = $("#album").val();
    //centering with css
    centerPopup();
    //load popup
    loadPopup();

    $("#ajaxMessage").html('Loading....');
    $.ajax({ url: "http://www.archmage.lk/mcd_rafi/photopage.php?aid=" + aid, success: function (result) { $("#ajaxMessage").html(result); }
    });

}

function closeit() {
    disablePopup();
}

function DoAction(small_src, big_src) {
    disablePopup();

    $("#fileup").hide();
    $("#votefile").show();
    $("#votefile").html("<img class=\"thumb\" src=\"" + small_src + "\"><br/><a class=\"cancel\" onClick=\"cancel_image();\">cancel</a>");

    $("#HiddenField1").val(big_src);
    $("#HiddenField2").val(small_src);

}

function cancel_image() {
    $("#votefile").hide();
    $("#fileup").show();
}



//error display area ================

function loadPopup_error() {
    //loads popup only if it is disabled
    if (popupStatus == 0) {
        $("#backgroundPopup_error").css({
            "opacity": "0.7"
        });
        $("#backgroundPopup_error").fadeIn("slow");
        $("#popupContact_error").fadeIn("slow");
        popupStatus = 1;
    }
}

function diserror(error) {
    centerPopup_error();
    loadPopup_error(error);
}

function closeiterror() {
    disablePopup_error();
}
function disablePopup_error() {
    //disables popup only if it is enabled
    if (popupStatus == 1) {
        $("#backgroundPopup_error").fadeOut("slow");
        $("#popupContact_error").fadeOut("slow");

        popupStatus = 0;
    }
}

function centerPopup_error() {
    //request data for centering
    var windowWidth = document.documentElement.clientWidth;
    var windowHeight = document.documentElement.clientHeight;
    var popupHeight = $("#popupContact_error").height();
    var popupWidth = $("#popupContact_error").width();
    //centering
    $("#popupContact_error").css({
        "position": "absolute",
        "top": windowHeight / 2 - popupHeight / 2,
        "left": windowWidth / 2 - popupWidth / 2
    });
    //only need force for IE6

    $("#backgroundPopup_error").css({
        "height": windowHeight
    });

}



//========================================