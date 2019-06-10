function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    if (innerWidth > 1200) {
        document.getElementById("main").style.marginLeft = "250px";
    }
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    if (innerWidth > 1200) {
        document.getElementById("main").style.marginLeft = "0";
    }
}
function myAccFunc() {
  var x = document.getElementById("demoAcc");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-green";
  } else {
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className =
    x.previousElementSibling.className.replace(" w3-green", "");
  }
}
