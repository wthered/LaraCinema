$( () => {
	let film_date_one = $( "#film_date_one");
	let film_date_two = $( "#film_date_two");

	const options_one = {
		dateFormat: 'yy-mm-dd', //format of the date
		changeYear: true, // you can change the year as you need
		changeMonth: true, // you can change the months as you need
		todayHighlight: true,
		autoclose: true,
		yearRange: "1930:2029", // the starting to end of year range
		setDate: new Date(1970, 1, 1),
		maxDate: new Date(),
	};

	const options_two = {
		dateFormat: 'yy-mm-dd', //format of the date
		changeYear: true, // you can change the year as you need
		changeMonth: true, // you can change the months as you need
		todayHighlight: true,
		autoclose: true,
		yearRange: "1930:2029", // the starting to end of year range
		setDate: new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()),
		maxDate: 0,
	};

	film_date_one.datepicker(options_one);
	film_date_two.datepicker(options_two);

	film_date_one.change(function() {
		film_date_two.datepicker('option', 'minDate', new Date(film_date_one.val()));
	});

	film_date_two.change(function() {
		film_date_one.datepicker('option', 'maxDate', new Date(film_date_two.val()));
	});

	$("#btn-date-range").on('click', function() {
		console.log({
			'minDate': film_date_one.val(),
			'maxDate': film_date_two.val()
		});
	});
});
