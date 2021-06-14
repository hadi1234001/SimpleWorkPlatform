	$(document).ready(function () {
		$("#send").on("click", function () {
			var number_item_id = document.getElementsByClassName("id").length;

			var number = new Array();
			var textarea = new Array();
			var id = new Array();

			var i;

			for (i = 1; i <= number_item_id; i++) {
				number[i] = $("#" + i + "N").val();
			}

			for (i = 1; i <= number_item_id; i++) {
				textarea[i] = $("#" + i + "T").val();
			}
			for (i = 1; i <= number_item_id; i++) {
				id[i] = $("#" + i + "id").val();
			}

			//filter the array
			var number = number.filter(function (el) {
				return el != '';
			});
			var textarea = textarea.filter(function (el) {
				return el != '';
			});
			var id = id.filter(function (el) {
				return el != '';

			});


			var bool = true;

			for (i = 0; i < number_item_id; i++) {
				if (textarea[i] == null || number[i] == null) {
					alert("There are empty items");
					bool = false;
					break;
				} else if (textarea[i].charCodeAt(0) == 32 || textarea[i].charCodeAt(0) == 9) {
					alert("The beginning of the text must not include a 'Space' or 'Tab'");
					bool = false;
					break;
				} else if (number[i]<=0) {
					alert("The value must be completely greater than zero");
					bool = false;
					break;
				}
			}
			if (bool == true) {
				$.ajax({
					type: "POST",
					url: "add_skill.php",
					data: {
						number: number,
						textarea: textarea,
						id: id,
					},
					success: function (f) {
						if (f == true) {
							alert("Welcome");
							window.location.href = 'project.php';
						} else {
							alert("Error Enter again");
						}
					}
				})
			}
		});
	});
	$(document).ready(function () {
		$("#Exit").on('click', function () {
			alert("you are sure");
			window.location.href = 'delete_account.php';
		});
	});
