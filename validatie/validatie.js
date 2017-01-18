/*
TODO:
-Controleren of e-mail een geldig email is met regular expressions.
-Kijken of de wachtwoorden aan een minimum lengte voldoen en een max lengte
-Ook of ze letters symbolen en nummers hebben.
-Wachtwoord velden moeten overeenkomen.
-Naam en voornaam mogen geen nummers hebben.
-postcode max 4 nummers
-stad geen letters
-geboortedatum niet minder dan 18 jaar.
-in de html dit veranderen
-regular exp geboortedatum
DONE:
-Toevoegen required voor alle velden.
*/



//GLOBAL


var oFouten = {
    required: {
        /* enkel voor vereiste velden dus alles */
        msg: "Dit is een verplicht veld.",
        test: function (elem) {
            return elem.value != "";
        }
    },
    aantal: {
        msg: "getal verwacht",
        test: function (elem) {
            //aantal test enkel de inhoud als getal als er een inhoud is
            if (elem.value != "") {
                return !isNaN(elem.value) && elem.value > 0;
            } else {
                return true;
            }
        }
    },
    datum: {
        msg: "Datum is ongeldig (dd/mm/yyyy)",
        test: function (elem) {
            // dd/mm/yyyy
            var re_datum = /^(\d{4})\-([0,1][0-9]|1[0,1,2])\-([0,1,2][0-9]|3[0,1])$/;
            if (elem.value != "") {
                return re_datum.test(elem.value);
            } else {
                return false;
            }

        }
    },
    leeftijd: {
        msg: "U moet 18 jaar of ouder zijn.",
        test: function (elem) {


            if (elem.value != "") {
                var meerderjarig = 18;
                var geboortedatum = new Date();
                var verschil = new Number();
                //vandaag
                var vandaag = new Date();

                geboortedatum = elem.value;
                var arrD1 = geboortedatum.split('-');
                var D1 = new Date(parseInt(arrD1[0]), parseInt(arrD1[1]), parseInt(arrD1[2]));

                verschil = vandaag.getFullYear() - D1.getFullYear();
                return (meerderjarig <= verschil);
            } else {
                return false;
            }

        }
    },
    postcode:{
        msg:"Een postcode bestaat uit vier nummers.",
        test:function (elem) {
            if(elem.value != ""){
                var rePostcode =/^\d{4}$/;
                return rePostcode.test(elem.value);
            }
            else{
                return false;
            }
        }
    }
}


window.onload = function () {

    //DOM referenties
    var eFrmRegistratie = document.frmRegistratie;
    // Er is altijd een geslacht geselecteerd
    var eGeslacht = document.frmRegistratie.geslacht;
    var eVGeslacht = document.frmRegistratie.Vgeslacht;
    //
    var eEMail = document.frmRegistratie.email;
    var eWachtwoord = document.frmRegistratie.password;
    var eWachtwoordHerhaald = document.frmRegistratie.pwrepeat;
    var eNaam = document.frmRegistratie.naam;
    var eVoornaam = document.frmRegistratie.voornaam;
    var ePostcode = document.frmRegistratie.postcode;
    var eStad = document.frmRegistratie.stad;
    var eGeboortedatum = document.frmRegistratie.geboortedatum;

    eFrmRegistratie.addEventListener('submit', function (e) {
        e.preventDefault();
        var bValid = valideer(this);
        console.log('formulier' + this.name + ' valideert ' + bValid);
        if (bValid == true) this.submit();
    })


}

//functies    
//hoofdcontroleur
function valideer(frm) {
    var bValid = true;

    //lus doorheen alle form elementen van het formulier
    for (var i = 0; i < frm.elements.length; i++) {
        //verwijder vorige foutboodschap
        hideErrors(frm.elements[i]);
        //valideer veld
        var bVeld = valideerVeld(frm.elements[i]);
        console.log("het element %s met name %s valideert %s", frm.elements[i].nodeName, frm.elements[i].name, bVeld);
        if (bVeld == false) {
            bValid = false;
        }
    }
    return bValid;
}

function valideerVeld(elem) {
    //valideert één veld volgens zijn class

    var aFoutBoodschappen = [];

    for (var fout in oFouten) {
        var re = new RegExp("(^|\\s)" + fout + "(\\s|$)"); //regex
        //fouten class aanwezig?
        if (re.test(elem.className)) {
            var bTest = oFouten[fout].test(elem);
            console.log("het element %s met name %s wordt gevalideerd voor %s:%s",
                elem.nodeName, elem.name, fout, bTest);
            if (bTest === false) {
                aFoutBoodschappen.push(oFouten[fout].msg);
            }
        }
    }
    if (aFoutBoodschappen.length > 0) {
        showErrors(elem, aFoutBoodschappen);
    }
    return !(aFoutBoodschappen.length > 0);
}

function showErrors(elem, aErrors) {
    //toont alle fouten voor één element
    /*
    @elem element,te valideren veld
    @aErrors, array,fouten voor dit element
     */
    var eBroertje = elem.nextSibling;
    if (!eBroertje || !(eBroertje.nodeName == "ul" && eBroertje.className == "fouten")) {
        eBroertje = document.createElement('ul');
        eBroertje.className = "fouten";
        elem.parentNode.insertBefore(eBroertje, elem.nextSibling);
    }
    //plaats alle foutberichten erin
    for (var i = 0; i < aErrors.length; i++) {
        var eLi = document.createElement('li');
        eLi.innerHTML = aErrors[i];
        eBroertje.appendChild(eLi);
    }
}

function hideErrors(elem) {
    /*
    verwijdert alle fouten voor één element
    @elem element,te valideren veld
     */
    var eBroertje = elem.nextSibling;
    if (eBroertje && eBroertje.nodeName == "UL" && eBroertje.className == "fouten") {
        elem.parentNode.removeChild(eBroertje);
    }
}