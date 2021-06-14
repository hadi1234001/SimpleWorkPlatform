	$(document).ready(function () {
		displayResult();
		$('#send_msg').on('click', function () {
			if ($('#msg').val() == "") {
				alert('Please write message first');
			}else {
				var msg = $('#msg').val();
				var id = $('#id').val();
				$.ajax({
					type: "POST",
					url: "Message.php",
					data: {
						msg: msg,
						id: id,
					},
					success: function () {
						displayResult();
						$('#msg').val('');
					}
				});
			}
		});
	});

	function displayResult() {
		var id = $('#id').val();
		$.ajax({
			url: 'Message.php',
			type: 'POST',
			data: {
				id: id,
			},
			success: function (response) {
				$('#result').html(response);
			}
		});
	}
