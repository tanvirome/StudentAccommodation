var modal = document.getElementById("myModal");

// var btn = document.getElementById("modalBtn");

var okay_btn = document.getElementsByClassName("okay_btn")[0];
// var span1 = document.getElementsByClassName("cancel")[0];

modal.style.display = "block";

okay_btn.onclick = function() {
	modal.style.display = "none";
};

// span1.onclick = function() {
// 	modal.style.display = "none";
// };
