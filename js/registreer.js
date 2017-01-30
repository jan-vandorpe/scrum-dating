$(function() {

    form = $("#registreer");

    $.validator.addMethod("checkPW", function(value, element) {
        return value.match(/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).*$/);
    });

    /*$.validator.addMethod("dateFormat", function(value, element) {
            // put your own logic here, this is just a (crappy) example
            return value.match(/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/);
    },
        "Date - dd-mm-yyy");*/


    $.validator.addMethod("geenCijfer", function(value, element, param) {
        var reg = /[0-9]/;
        if(reg.test(value)){
            return false;
        }else{
            return true;
        }
    }, "geen getallen in dit veld toegelaten");


    form.submit(function (e) {
        e.preventDefault()
    });


    form.validate({
        debug: true,

        errorClass: 'regError',

        rules: {

            email: {
                required: true,
                email: true

            },

            naam: {
                maxlength: 55,
                geenCijfer: true

            },

            voornaam: {
                maxlength: 55,
                geenCijfer: true

            },

            geboorteDatum: {
                //dateFormat: true
            },


            password: {
                maxlength: 60
                // checkPW: true
            },

            pwrepeat: {
                equalTo: "#password"
            },

            postcode : {
                required: true,
                digits: 4,
                minlength: 4,
                maxlength: 4
            },

            stad: {
                geenCijfer: true
            }


        },

        messages: {

            password: {
                required: "dit veld is verplicht",
                maxlength: "een wachtwoord kan maximaal 60 tekens bevatten"
                //checkPW: "min 8 tekens, 1 kleine letter, 1 Hoofdletter, 1 getal en 1 speciaal karakter"
            },

            naam: {
                required: "dit veld is verplicht",
                maxlength: "Een naam kan maximaal 55 tekens bevatten",
                digits: "enkel tekens"
            },

            voornaam: {
                required: "dit veld is verplicht",
                maxlength: "Een voornaam kan maximaal 55 tekens bevatten",
                digits: "enkel tekens"
            },

            stad: {
                required: "dit veld is verplicht"
            },

            email: {
                required: "email is een verplicht veld",
                email: "dit is geen geldig emailadres"

            },

            pwrepeat: {
                required: "dit veld is verplicht",
                equalTo: "Wachtwoorden niet gelijk"
            },

            postcode: {
                required:"dit veld is verplicht",
                digits:"Een postcode bestaat uit 4 cijfers",
                minlength: "Een postcode bestaat uit exact 4 cijfers",
                maxlength: "Een postcode bestaat uit exact 4 cijfers"
            },

            geboorteDatum: {
                required: "dit is een verplicht veld"
                //dateFormat: "dd-mm-yyyy"
            }

        },

        submitHandler: function (form) {
            form.submit();

        }


    });


});// einde window onload





