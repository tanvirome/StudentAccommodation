// When the user scrolls down 50px from the top of the document, resize the header's font size
window.onscroll = function() {
	scrollFunction();
};

function scrollFunction() {
	if (document.documentElement.scrollTop || document.documentElement.scrollTop) {
		document.getElementById("header").style.minHeight = "40px";
		document.getElementById("logo").style.height = "40px";
		document.getElementById("logo").style.width = "230px";
		document.getElementById("header_nav").style.fontSize = "14px";
		document.getElementById("header_nav").style.marginTop = "15px";
		document.getElementById("header_nav").style.marginBottom = "10px";
		// document.getElementById("header_a").style.fontSize = "10px";
		// document.getElementById("header_a").style.fontSize = "10px";
		// document.getElementById("separator1").style.fontSize = "14px";
		// document.getElementById("separator2").style.fontSize = "14px";
		// document.getElementById("separator3").style.fontSize = "14px";
		// var elements = document.getElementsByClassName("separator");
		// document.write(elements.length);
		// for (var i = 0; i < elements.length; i++) {
		// 	var element = elements[i];
		// 	element[i].style.fontSize = "16px";
		// }
	} else {
		document.getElementById("header").style.minHeight = "80px";
		document.getElementById("logo").style.height = "70px";
		document.getElementById("logo").style.width = "250px";
		document.getElementById("header_nav").style.fontSize = "18px";
		document.getElementById("header_nav").style.marginTop = "25px";
		document.getElementById("header_nav").style.marginBottom = "21px";
		// document.getElementById("header_a").style.fontSize = "18px";
		// document.getElementById("separator1").style.fontSize = "22px";
	}
}
