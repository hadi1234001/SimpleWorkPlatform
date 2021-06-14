	$(document).ready(function () {
		$('#overview').on('click', function () {
			$(".container").css({
				"display": "none"
			});
			$(".skill").css({
				"display": "block"
			});
			$(".left").css({
				"background": "none"
			});
			$(".right").css({
				"background": "#fff"
			});
			$(".right").css({
				"color": "rgba(13, 221, 218, 0.72)"
			});
			$(".right").css({
				"letter-spacing": "5px"
			});
			$(".left").css({
				"letter-spacing": "2px"
			});

		});
	});
	$(document).ready(function () {
		$('#information').on('click', function () {

			$(".container").css({
				"display": "block"
			});
			$(".skill").css({
				"display": "none"
			});

			$(".left").css({
				"background": "#fff"
			});
			$(".right").css({
				"background": "none"
			});
			$(".left").css({
				"color": "rgba(13, 221, 218, 0.72)"
			});
			$(".left").css({
				"letter-spacing": "5px"
			});
			$(".right").css({
				"letter-spacing": "2px"
			});
		});
	});
