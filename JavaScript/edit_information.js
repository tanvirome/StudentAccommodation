// Modal Script
var modal = document.getElementById("myModal");

var btn = document.getElementById("modalBtn");

var span = document.getElementsByClassName("close")[0];
var span1 = document.getElementsByClassName("cancel")[0];

btn.onclick = function() {
	modal.style.display = "block";
};

span.onclick = function() {
	modal.style.display = "none";
};

span1.onclick = function() {
	modal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
// 	if (event.target == modal) {
// 		modal.style.display = "none";
// 	}
// };

// DETAILS

var username = document.getElementById("details1");
var email = document.getElementById("details2");
var information = document.getElementById("details3");
var deleteacc = document.getElementById("details4");

function details1() {
	// email.open = false;
	// information.open = false;
	// deleteacc.open = false;
	if ((email.open = true)) {
		email.open = false;
	}
	if ((information.open = true)) {
		information.open = false;
	}
	if ((deleteacc.open = true)) {
		deleteacc.open = false;
	}
}

function details2() {
	// username.open = false;
	// information.open = false;
	// deleteacc.open = false;
	if ((username.open = true)) {
		username.open = false;
	}
	if ((information.open = true)) {
		information.open = false;
	}
	if ((deleteacc.open = true)) {
		deleteacc.open = false;
	}
}

function details3() {
	// username.open = false;
	// email.open = false;
	// deleteacc.open = false;
	if ((username.open = true)) {
		username.open = false;
	}
	if ((email.open = true)) {
		email.open = false;
	}
	if ((deleteacc.open = true)) {
		deleteacc.open = false;
	}
}

function details4() {
	// username.open = false;
	// email.open = false;
	// information.open = false;
	if ((username.open = true)) {
		username.open = false;
	}
	if ((email.open = true)) {
		email.open = false;
	}
	if ((information.open = true)) {
		information.open = false;
	}
}
