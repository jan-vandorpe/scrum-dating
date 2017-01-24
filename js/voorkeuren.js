$(function() {

	form = $("#voorkeurForm");

	$(".default").attr('name', 'chzn-search');


	form.submit(function (e) {
		e.preventDefault()
	});


	form.validate({
		debug: true,

		rules: {

			lengte: {
				digits: true,
				minlength: 2,
				maxlength: 3,
				max: 272,
				min: 54

			}
		/*	,

			geboortedatum: {
				dateISO: true
			}*/


		},

		messages: {

			lengte: {
				digits: "Een lengte bestaat enkel uit getallen",
				minlength: "Het getal moet minstens uit 2 getallen bestaan",
				maxlength: "Het getal mag maximum uit 3 getallen bestaan",
				max: "Lengte kan niet hoger dan 272cm zijn",
				min: "Lengte kan niet kleiner dan 54cm zijn"

			}
			/*,

			geboortedatum:{
				dateISO: "datum moet in het YYYY-MM-DD formaat"
			}*/


		},

		submitHandler: function (form) {
			form.submit();

		}


	});


});// einde window onload

	
