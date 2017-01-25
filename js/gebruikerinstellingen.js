$(function() {

    form = $("#wwPW");

    form.submit(function (e) {
        e.preventDefault()
    });






    form.validate({
        debug: true,

        rules: {



            nieuwWW2: {
                equalTo: "#nieuwWW"
            }



        },

        messages: {

            nieuwWW2: "wachtwoord niet identiek"


        },

        submitHandler: function (form) {
            form.submit();

        }


    });


});// einde window onload


