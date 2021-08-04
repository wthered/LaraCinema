$( () => {

	$("#search-item").on('change paste keyup', function(e) {
		e.preventDefault();

		let form_data = {
			term: $(this).val(),
		}

		$.post( "/cinema/public/search", form_data )
			.done( data => {
				$("#items").html(data);
			})
			.fail(suck => {
				console.error( suck );
			});

	});

});