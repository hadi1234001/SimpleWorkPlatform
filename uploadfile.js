$(document).ready(function () {
		//click function
		upload_file = function () {
			if ($('#file').val() == "") {
				alert('Enter the file');
			} else {
				//FormData: sending HTML forms with or without files
				var fd = new FormData();
				//Returns the file item in the index
				var file = $('#file')[0].files[0];
				//Add a form field with the specified name and value
				var id = $('#id').val();
				fd.append('file', file);
				$.ajax({
					url: 'Message.php?id='+id,
					method: 'POST',
					data: fd,
					//Send data to the server of any kind
					contentType: false,
					//Prevent ajax from processing data sent
					processData: false,
					success: function () {
						$("#file").val('');
						$("#msg").val('');
					}

				});

			}

		};
	});
