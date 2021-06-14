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
				var id_pro = $('#id').val();
				fd.append('file', file);
				$.ajax({
					url: 'UploadProject.php?id_project='+id_pro,
					method: 'POST',
					data: fd,
					//Send data to the server of any kind
					contentType: false,
					//Prevent ajax from processing data sent
					processData: false,
					success: function () {
						$("#file").val('');
						$("#textfile").val('');
						history.go(-1);
						
					}

				});

			}

		};
	});