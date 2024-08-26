var $number = $("#number");
var $number2 = $("#number2");
var $email = $("#email");
var $url = $("#url");

var $numberValidationKey = /[0-9]/;
var $number2ValidationKey = /[0-9]{10}/;
var $emailValidationKey = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var $urlValidationKey = /(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/gi;

// Restricts input for the given textbox to the given inputFilter.
function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        textbox.oldValue = "";
        textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            }
        });
    });
}

// Restrict input to digits and '.' by using a regular expression filter.
setInputFilter(document.getElementById("number"), function(value) {
    return /^\d*$/.test(value);
});


//Hide hints
$("span").hide();
$("#validateMSG").hide();

function validateForm() {
    if (canSubmit()) {
        $("#validateMSG").text("Ok!!! well done ☺");
        $("#validateMSG").show();
    } else {
        $("#validateMSG").text("");
        $("#validateMSG").hide();
    }
}

function isNumberValid() {
    if (($number.val().match($numberValidationKey))) {
        //Hide hint if valid
        $number.next().hide();
        return true;
    } else {
        //else show hint
        $number.next().show();
        return false;
    }
}

function isNumber2Valid() {
    if (($number2.val().match($number2ValidationKey)) && $number2.val().length < 11) {
        //Hide hint if valid
        $number2.next().hide();
        return true;
    } else {
        //else show hint
        $number2.next().show();
        return false;
    }
}

function isEmailValid() {
    if ($email.val().match($emailValidationKey)) {
        //Hide hint if valid
        $email.next().hide();
        return true;
    } else {
        //else show hint
        $email.next().show();
        return false;
    }
}

function isUrlValid() {
    if ($url.val().match($urlValidationKey)) {
        //Hide hint if valid
        $url.next().hide();
        return true;
    } else {
        //else show hint
        $url.next().show();
        return false;
    }
}


function canSubmit() {
    if (isNumberValid() == true &
        isNumber2Valid() == true &
        isUrlValid() == true &
        isEmailValid() == true
    ) {
        return true;
    } else {
        $("#validateMSG").text("");
        $("#validateMSG").hide();
        return false;
    }
}


function numberEvent() {
    //Find out if number is valid 
    if (isNumberValid()) {
        //Hide hint if valid
        $number.next().hide();
    } else {
        //else show hint
        $number.next().show();
    }
}

function number2Event() {
    //Find out if number2 is valid 
    if (isNumber2Valid()) {
        //Hide hint if valid
        $number2.next().hide();
    } else {
        //else show hint
        $number2.next().show();
    }
}

function emailEvent() {
    //Find out if email is valid 
    if (isEmailValid()) {
        //Hide hint if valid
        $email.next().hide();
    } else {
        //else show hint
        $email.next().show();
    }
}

function urlEvent() {
    //Find out if url is valid  
    if (isUrlValid()) {
        //Hide hint if valid
        $url.next().hide();
    } else {
        //else show hint
        $url.next().show();
    }
}

// If we want to have AutoHint,we should uncomment these lines
// //When event happens on number input
// $number.focus(numberEvent).keyup(numberEvent).keyup(enableSubmitEvent);

// //When event happens on number2 input
// $number2.focus(number2Event).keyup(number2Event).keyup(enableSubmitEvent);

// //When event happens on phone input
// $email.focus(emailEvent).keyup(emailEvent).keyup(enableSubmitEvent);

// //When event happens on url input
// $url.focus(urlEvent).keyup(urlEvent).keyup(enableSubmitEvent);

// function enableSubmitEvent() {
//     $("#submit").prop(!canSubmit());
// }

// enableSubmitEvent();