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
