function reloadPage() {
  location = location;
}

function preloader() {
  var myVar = setTimeout(showPage, 100);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("wrapper").style.display = "flex";
}