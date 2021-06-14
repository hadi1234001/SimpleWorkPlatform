function ValidateFrom() {
	var firstname = document.getElementById("firstname");
	var email = document.getElementById("email");
	var password = document.getElementById("password");
	var confirm_password = document.getElementById("confirm_password");
	var email = document.getElementById("email");
	var password = document.getElementById("password");
	var valid = true;

	
	if (firstname.value.length == 0) {
		firstname.className = "wrong-input";
		firstname.nextElementSibling.innerHTML = "firstname can’t be blank";
		valid = false;
	}

	if (email.value.length == 0) {
		email.className = "wrong-input";
		email.nextElementSibling.innerHTML = "email can’t be blank";
		valid = false;
	}


	if (password.value.length < 10) {
		password.className = "wrong-input";
		password.nextElementSibling.innerHTML = "password can’t be less than 10";
		valid = false;
	}

	if (password.value != confirm_password.value) {
		confirm_password.className = "wrong-input";
		confirm_password.nextElementSibling.innerHTML = "Password dose not match";
		valid = false;
	}

	if (email.value.length == 0) {
		email.className = "wrong-input";
		email.nextElementSibling.innerHTML = "email can’t be blank";
		valid = false;
	}

	if (password.value.length < 10) {
		password.className = "wrong-input";
		password.nextElementSibling.innerHTML = "password can’t be less than 10";
		valid = false;
	}
	return valid;
}

const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
